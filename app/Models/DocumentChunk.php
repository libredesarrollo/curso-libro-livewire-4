<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un fragmento (chunk) de documento almacenado en la base de datos vectorial.
 *
 * Este modelo se usa en el sistema RAG para almacenar texto junto con su embedding vectorial.
 * Permite realizar búsquedas de similitud para recuperar contenido relevante.
 *
 * Estructura de la tabla:
 * - id: Identificador único
 * - source: Archivo fuente del que proviene el chunk
 * - heading: Encabezado o sección del documento
 * - chunk_text: Contenido textual del chunk
 * - metadata: Datos adicionales en formato JSON
 * - embedding: Vector de 1536 dimensiones generado por IA
 * - timestamps: created_at y updated_at
 *
 * Casts:
 * - metadata: Se convierte automáticamente de JSON a array PHP
 * - embedding: Se convierte automáticamente de JSON a array PHP (vector de floats)
 */
class DocumentChunk extends Model
{
    /**
     * Atributos que pueden ser asignados masivamente.
     * Estos campos se pueden establecer al crear o actualizar registros.
     */
    protected $fillable = [
        'source',      // Archivo fuente (ej: 'pokemon-guide.md')
        'heading',     // Encabezado de la sección
        'chunk_text',  // Contenido textual del chunk
        'metadata',    // Datos adicionales en JSON
        'embedding',   // Vector de embedding (array de floats)
    ];

    /**
     * Casts de atributos a tipos específicos.
     *
     * Estos cast permiten acceder a los atributos como tipos PHP nativos:
     * - metadata: Se accede como array PHP en lugar de string JSON
     * - embedding: Se accede como array de floats para operaciones vectoriales
     */
    protected $casts = [
        'metadata' => 'array',   // Convierte JSON a array automáticamente
        'embedding' => 'array',  // Convierte el vector a array de floats
    ];
}
