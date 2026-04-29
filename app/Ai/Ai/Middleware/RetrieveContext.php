<?php

namespace App\Ai\Middleware;

use App\Models\DocumentChunk;
use Closure;
use Laravel\Ai\Prompts\AgentPrompt;

class RetrieveContext
{
    public function __construct(
        private float $minSimilarity = 0.3,
        private int $limit = 10
    ) {}

    public function handle(AgentPrompt $prompt, Closure $next)
    {
        $chunks = DocumentChunk::whereVectorSimilarTo(
            'embedding',
            $prompt->prompt,
            $this->minSimilarity
        )->limit($this->limit)->get();
        $prompt->agent->withChunks($chunks);

        return $next($prompt);
    }
}