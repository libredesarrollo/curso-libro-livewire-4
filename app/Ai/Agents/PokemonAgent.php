<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Collection;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Promptable;
use Stringable;

/**
 * Agente para generar lista de Pokemon con schema estructurado.
 *
 * Schema devuelto:
 *   - pokemones: array de objetos
 *   - nombre: string
 *   - tipo: enum (fuego, agua, electrico, planta, normal, volador, psiquico)
 *   - tamano: integer (10-500 cm)
 */

// php artisan make:agent SimpleAgent --structured
// #[Provider(Lab::Anthropic)]
#[Model('gemma-3-12b-it-IQ4_XS')]
class PokemonAgent implements Agent // , HasStructuredOutput
{
    use Promptable;

    protected Collection $chunks;

    public function __construct()
    {
        $this->chunks = collect();
    }

    public function instructions(): Stringable|string
    {
        return 'Eres un experto en Pokemon. Generas listas de Pokemon realistas en formato JSON exacto.';
    }

    // public function schema(JsonSchema $schema): array
    // {
    //     return [
    //         'pokemones' => $schema->array()->items(
    //             $schema->object([
    //                 'nombre' => $schema->string()->required(),

    //             ])
    //         )->required(),
    //     ];
    // }

    public function withChunks(Collection $chunks): void
    {
        $this->chunks = $chunks;
    }

    // public function schema(JsonSchema $schema): array
    // {
    //     return [
    //         'pokemones' => $schema->array()->items(
    //             $schema->object([
    //                 'nombre' => $schema->string()->required(),
    //                 'tipo' => $schema->string()->enum([
    //                     'fuego',
    //                     'agua',
    //                     'electrico',
    //                     'planta',
    //                     'normal',
    //                     'volador',
    //                     'psiquico',
    //                     'roca',
    //                     'tierra',
    //                 ])->required(),
    //                 'tamano' => $schema->integer()->min(10)->max(500)->required(),
    //             ])
    //         )->required(),
    //     ];
    // }
}
