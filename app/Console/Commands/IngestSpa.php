<?php

namespace App\Console\Commands;

use App\Models\DocumentChunk;
use App\Services\DefinitionExtractor;
use BenBjurstrom\MarkdownObject\Build\MarkdownObjectBuilder;
use BenBjurstrom\MarkdownObject\Tokenizer\TikTokenizer;
use Illuminate\Console\Command;
use Laravel\Ai\Embeddings;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Parser\MarkdownParser;
use Symfony\Component\Finder\Finder;

class IngestSpa extends Command
{
    protected $signature = 'rag:ingest {path}';

    protected $description = 'Ingest a markdown SPA into the vector store';

    public function handle(
        MarkdownObjectBuilder $builder,
        DefinitionExtractor $extractor,
    ): void {
        $files = Finder::create()
            ->files()
            ->name('*.md')
            ->in($this->argument('path'));

        $tokenizer = TikTokenizer::forModel('text-embedding-3-small');

        foreach ($files as $file) {
            $markdown = $file->getContents();
            $definitions = $extractor->extract($markdown);

            $this->info('Extracted '.count($definitions).' definitions');

            $document = new MarkdownParser(
                (new CommonMarkConverter)->getEnvironment(),
            )->parse($markdown);

            $chunks = $builder
                ->build($document, $file->getRelativePathname(), $markdown, $tokenizer)
                ->toMarkdownChunks(target: 512, hardCap: 1024, tok: $tokenizer);

            if (empty($chunks)) {
                continue;
            }

            $chunkCollection = collect($chunks)->map(fn ($chunk) => [
                'text' => trim($chunk->markdown),
                'heading' => implode(' > ', $chunk->breadcrumb),
            ])->filter(fn ($chunk) => $chunk['text'] !== '')->values();

            // Enrich chunks with relevant definitions
            $enrichedTexts = $chunkCollection->map(
                fn ($chunk) => $extractor->enrichChunk($chunk['text'], $definitions),
            )->toArray();

            $response = Embeddings::for($enrichedTexts)->generate();

            $chunkCollection->each(fn ($chunk, $index) => DocumentChunk::create([
                'source' => $file->getRelativePathname(),
                'chunk_text' => $enrichedTexts[$index],
                'metadata' => [
                    'heading' => $chunk['heading'],
                    'hash' => hash('sha256', $chunk['text']),
                ],
                'embedding' => $response->embeddings[$index],
            ]));

            $this->info("Ingested {$chunkCollection->count()} chunks from {$file->getRelativePathname()}");
        }
    }
}

// php artisan rag:ingest storage/app/documents