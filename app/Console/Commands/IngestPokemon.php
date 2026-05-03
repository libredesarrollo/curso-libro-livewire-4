<?php

namespace App\Console\Commands;

use App\Models\DocumentChunk;
use Illuminate\Console\Command;
use Laravel\Ai\Embeddings;
use League\CommonMark\CommonMarkConverter;

/**
 * Comando Artisan para ingestar el archivo Markdown de Pokémon en la base de datos vectorial.
 *
 * Este comando:
 * 1. Lee el archivo pokemon-guide.md desde storage/data/
 * 2. Divide el contenido en chunks basándose en los encabezados (##)
 * 3. Genera embeddings para cada chunk usando el Laravel AI SDK
 * 4. Guarda los chunks en la tabla document_chunks con sus vectores
 *
 * Uso: php artisan rag:ingest:pokemon
 */
class IngestPokemon extends Command
{
    // Firma del comando para invocarlo desde Artisan
    protected $signature = 'rag:ingest:pokemon';

    // Descripción que aparece en php artisan list
    protected $description = 'Ingest Pokémon guide markdown into the vector store';

    /**
     * Método principal que ejecuta el proceso de ingestión.
     *
     * Flujo:
     * 1. Lee el archivo markdown
     * 2. Lo divide en chunks por encabezados
     * 3. Genera embeddings para todos los chunks
     * 4. Guarda cada chunk en la base de datos
     */
    public function handle(): void
    {
        // Ruta completa al archivo markdown de Pokémon
        $filePath = storage_path('data/pokemon-guide.md');

        // Verificar que el archivo existe antes de continuar
        if (! file_exists($filePath)) {
            $this->error("File not found: {$filePath}");

            return;
        }

        // Leer todo el contenido del archivo markdown
        $markdown = file_get_contents($filePath);

        // Dividir el markdown en chunks basándose en los encabezados
        $chunks = $this->chunkByHeadings($markdown);

        // Mostrar información sobre la cantidad de chunks encontrados
        $this->info('Found '.count($chunks).' chunks to process');

        // Extraer solo los textos de los chunks para generar embeddings
        $texts = array_column($chunks, 'text');

        // Generar embeddings usando el Laravel AI SDK (OpenAI por defecto)
        // Esto convierte cada texto en un vector de 1536 dimensiones
        $response = Embeddings::for($texts)->generate();

        // Iterar sobre cada chunk y guardarlo en la base de datos
        foreach ($chunks as $index => $chunk) {
            DocumentChunk::create([
                'source' => 'pokemon-guide.md',           // Identificador del documento fuente
                'heading' => $chunk['heading'],           // Encabezado del chunk
                'chunk_text' => $chunk['text'],           // Contenido del chunk
                'metadata' => [
                    // Metadatos adicionales en formato JSON
                    'heading' => $chunk['heading'],
                ],
                // El vector de embedding generado por la IA
                'embedding' => $response->embeddings[$index],
            ]);
        }

        // Mensaje de éxito al finalizar
        $this->info('Successfully ingested '.count($chunks).' chunks');
    }

    /**
     * Divide el contenido Markdown en chunks basándose en los encabezados.
     *
     * Cada sección marcada con ##, ###, etc. se convierte en un chunk separado.
     * Esto permite que el RAG recupere secciones específicas relacionadas con la consulta.
     *
     * @param  string  $markdown  Contenido completo del archivo markdown
     * @return array Array de chunks con 'heading' y 'text'
     */
    private function chunkByHeadings(string $markdown): array
    {
        // Dividir el markdown en líneas individuales
        $lines = explode("\n", $markdown);
        $chunks = [];

        // Variables para construir el chunk actual
        $currentHeading = 'Introduction';  // heading por defecto para el primer chunk
        $currentContent = [];               // contenido acumulado del chunk actual

        // Iterar sobre cada línea del markdown
        foreach ($lines as $line) {
            // Detectar si la línea es un encabezado (#, ##, ###, etc.)
            if (preg_match('/^(#{1,6})\s+(.+)$/', $line, $matches)) {
                // Si hay contenido acumulado, guardar el chunk anterior
                if (! empty($currentContent)) {
                    $text = trim(implode("\n", $currentContent));
                    // Solo guardar chunks con contenido suficiente (> 50 caracteres)
                    if (strlen($text) > 50) {
                        $chunks[] = [
                            'heading' => $currentHeading,
                            'text' => $text,
                        ];
                    }
                }

                // Actualizar el heading actual con el nuevo encabezado
                $currentHeading = $matches[2];
                // Reiniciar el contenido para el nuevo chunk
                $currentContent = [];
            } else {
                // Agregar la línea al contenido actual del chunk
                $currentContent[] = $line;
            }
        }

        // Guardar el último chunk restante (si existe contenido)
        if (! empty($currentContent)) {
            $text = trim(implode("\n", $currentContent));
            if (strlen($text) > 50) {
                $chunks[] = [
                    'heading' => $currentHeading,
                    'text' => $text,
                ];
            }
        }

        // Devolver todos los chunks encontrados
        return $chunks;
    }
}
// php artisan rag:ingest:pokemon 