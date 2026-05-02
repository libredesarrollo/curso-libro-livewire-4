<?php

namespace App\Ai\Agents;

use App\Ai\Middleware\RetrieveContext;
use Illuminate\Support\Collection;
use Laravel\Ai\Attributes\MaxTokens;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Attributes\Temperature;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasMiddleware;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Promptable;
use Stringable;

/**
 * Agente de IA especializado en responder preguntas sobre Pokémon.
 *
 * Este agente implementa el patrón RAG (Retrieval-Augmented Generation):
 * - Utiliza middleware para recuperar contexto relevante de la base de datos vectorial
 * - Responde basándose únicamente en la información del documento ingestado
 * - No inventa información ni proporciona datos fuera del contexto
 *
 * Atributos de configuración:
 * - Temperature 0.0: Respuestas determinísticas, sin aleatoriedad
 * - MaxTokens 2048: Límite de tokens en la respuesta
 */
#[Provider(Lab::Ollama)]
#[Temperature(0.0)] // Temperatura 0 para respuestas más precisas y deterministas
#[MaxTokens(2048)] // Límite de tokens en la respuesta
class PokemonAgent implements Agent, HasMiddleware
{
    use Promptable;  // Trait que proporciona métodos para construir prompts

    /**
     * Colección de chunks recuperados por el middleware de contexto.
     * Estos chunks contienen la información relevante del documento
     * que el agente usará para responder preguntas.
     */
    protected Collection $chunks;

    /**
     * Constructor del agente.
     * Inicializa la colección de chunks como vacía.
     */
    public function __construct()
    {
        $this->chunks = collect();
    }

    /**
     * Método llamado por el middleware para pasar los chunks recuperados.
     *
     * Este método es invocado por el RetrieveContext middleware después
     * de realizar la búsqueda vectorial y recuperar los chunks relevantes.
     *
     * @param  Collection  $chunks  Colección de objetos DocumentChunk con información del documento
     */
    public function withChunks(Collection $chunks): void
    {
        $this->chunks = $chunks;
    }

    /**
     * Define los middleware que se ejecutarán antes de que el agente procese el prompt.
     *
     * El middleware RetrieveContext se encarga de:
     * 1. Buscar chunks similares al prompt del usuario
     * 2. Pasarlos al agente mediante withChunks()
     * 3. El agente los incluye en sus instrucciones
     *
     * @return array Array de instancias de middleware
     */
    public function middleware(): array
    {
        return [
            // Middleware que recupera contexto relevante antes de generar respuesta
            // minSimilarity: 0.3 (30% de similitud mínima para incluir chunk)
            // limit: 10 (máximo de 10 chunks recuperados)
            new RetrieveContext(minSimilarity: 0.3, limit: 10),
        ];
    }

    /**
     * Define las instrucciones del sistema (system prompt) del agente.
     *
     * Las instrucciones se generan desde una plantilla Blade que incluye
     * los chunks recuperados como contexto. Esto permite que el agente
     * responda usando únicamente información del documento ingestado.
     *
     * El template 'pokemon-rag.blade.php' incluye:
     * - Instrucciones sobre cómo usar el contexto
     * - Los chunks recuperados formateados como contexto
     * - Reglas sobre honesty (no inventar información)
     *
     * @return Stringable|string Las instrucciones del agente en formato string
     */
    public function instructions(): Stringable|string
    {
        // Renderizar la plantilla Blade con los chunks recuperados como
        // Esto permite que las instrucciones incluyan el contexto relevante
        return view('prompts.pokemon-rag', ['chunks' => $this->chunks])->render();
    }
}
