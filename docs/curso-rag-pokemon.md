# Curso: Sistema RAG con Laravel AI SDK

Este documento contiene la explicación completa del proyecto de Retrieval-Augmented Generation (RAG) para un chatbot de Pokémon.

---

## 1. Introducción al RAG

### ¿Qué es RAG?

**RAG (Retrieval-Augmented Generation)** es una técnica que combina:
- **Recuperación**: Buscar información relevante en una base de datos
- **Generación**: Usar un modelo de IA para generar respuestas

### ¿Por qué usar RAG?

| Sin RAG | Con RAG |
|---------|---------|
| El modelo responde con conocimiento general | El modelo responde solo con info del documento |
| Puede inventar datos (alucinaciones) | Solo usa datos reales del documento |
| No cita fuentes | Tiene contexto preciso |

---

## 2. Arquitectura del Proyecto

### Estructura General

```
┌─────────────────────────────────────────────────────────────────┐
│                        USUARIO                                   │
│                      (Chat UI)                                  │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                    POKEMON AGENT                                │
│  (app/Ai/Agents/PokemonAgent.php)                                │
│  - Define instrucciones del sistema                              │
│  - Usa middleware para recuperar contexto                       │
└─────────────────────┬───────────────────────────────────────────┘
                      │
          ┌───────────┴────────────┐
          ▼                         ▼
┌─────────────────────┐   ┌─────────────────────────┐
│   MIDDLEWARE        │   │   BLADE PROMPT          │
│ RetrieveContext     │   │ pokemon-rag.blade.php   │
│                     │   │                         │
│ - Recibe pregunta   │   │ - instructions()        │
│ - Busca en vectorDB │   │ - Renderiza chunks      │
│ - Recupera chunks   │   │ - Envía al modelo       │
└─────────┬───────────┘   └─────────────────────────┘
          │
          ▼
┌─────────────────────────────────────────────────────────────────┐
│               BASE DE DATOS VECTORIAL (pgvector)                │
│                    document_chunks                              │
│  - source, heading, chunk_text                                   │
│  - embedding (768 dimensiones)                                  │
└─────────────────────────────────────────────────────────────────┘
```

---

## 3. Componentes del Proyecto

### 3.1 Modelo DocumentChunk

**Ubicación**: `app/Models/DocumentChunk.php`

Representa un fragmento de documento almacenado en la base de datos vectorial.

```php
class DocumentChunk extends Model
{
    protected $fillable = [
        'source',      // Archivo fuente (ej: 'pokemon-guide.md')
        'heading',     // Encabezado de la sección
        'chunk_text',  // Contenido textual del chunk
        'metadata',    // Datos adicionales en JSON
        'embedding',   // Vector de embedding (array de floats)
    ];

    protected $casts = [
        'metadata' => 'array',   // Convierte JSON a array automáticamente
        'embedding' => 'array',  // Convierte el vector a array de floats
    ];
}
```

**Estructura de la tabla**:

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | Identificador único |
| source | varchar | Archivo origen |
| heading | varchar | Título de la sección |
| chunk_text | text | Contenido del chunk |
| metadata | json | Datos adicionales |
| embedding | vector(768) | Vector numérico |
| timestamps | timestamps | created_at, updated_at |

---

### 3.2 Comando de Ingestión

**Ubicación**: `app/Console/Commands/IngestPokemon.php`

Este comando ingesta el archivo Markdown a la base de datos vectorial.

**Comando**: `php artisan rag:ingest:pokemon`

**Flujo del comando**:

```
1. Lee el archivo markdown (storage/data/pokemon-guide.md)
       ↓
2. Divide el contenido en chunks por encabezados (##)
       ↓
3. Genera embeddings usando Laravel AI SDK
   - Provider: Ollama
   - Modelo: nomic-embed-text
   - Dimensiones: 768
       ↓
4. Guarda cada chunk en la tabla document_chunks
```

**Método chunkByHeadings**:

```php
private function chunkByHeadings(string $markdown): array
{
    // Divide el markdown por encabezados
    // Cada sección ## → un chunk separado
    // Permite recuperación precisa por tema
}
```

---

### 3.3 Middleware RetrieveContext

**Ubicación**: `app/Ai/Middleware/RetrieveContext.php`

Es el **encargado de buscar** información relevante antes de que el modelo responda.

```php
class RetrieveContext
{
    public function __construct(
        private float $minSimilarity = 0.3,
        private int $limit = 10,
    ) {}

    public function handle(AgentPrompt $prompt, Closure $next)
    {
        // 1. Recibe la pregunta del usuario
        // 2. Busca chunks similares en la BD vectorial
        // 3. Pasa los chunks al agente
        // 4. Continúa con el siguiente paso
        
        return $next($prompt);
    }
}
```

**Parámetros del middleware**:

| Parámetro | Valor | Descripción |
|-----------|-------|-------------|
| minSimilarity | 0.3 | 30% mínimo de similitud |
| limit | 10 | Máximo 10 chunks |

---

### 3.4 PokemonAgent

**Ubicación**: `app/Ai/Agents/PokemonAgent.php`

El agente que orquesta todo el proceso.

```php
#[Provider(Lab::Ollama)]
#[Temperature(0.0)]
#[MaxTokens(2048)]
class PokemonAgent implements Agent, HasMiddleware
{
    use Promptable;

    protected Collection $chunks;

    public function middleware(): array
    {
        return [
            new RetrieveContext(minSimilarity: 0.3, limit: 10),
        ];
    }

    public function instructions(): Stringable|string
    {
        return view('prompts.pokemon-rag', ['chunks' => $this->chunks])->render();
    }
}
```

**Atributos del agente**:

| Atributo | Valor | Propósito |
|----------|-------|-----------|
| Provider | Ollama | Usar modelo local |
| Temperature | 0.0 | Respuestas determinísticas |
| MaxTokens | 2048 | Límite de respuesta |

---

### 3.5 Plantilla de Prompt

**Ubicación**: `resources/views/prompts/pokemon-rag.blade.php`

Genera las instrucciones del sistema con el contexto recuperado.

```blade
You are a helpful Pokémon assistant. Your task is to answer the user's question about Pokémon using ONLY the provided context from the Pokémon guide.

Answer based on the retrieved context. If the context does not contain enough information to answer the question, say so honestly.

## Context:
@foreach ($chunks as $index => $chunk)
---
Source {{ $index }} ({{ $chunk->heading ?? 'Untitled' }}):
{{ $chunk->chunk_text }}
@endforeach
```

---

## 4. Flujo Completo: Ingestión

### Fase 1: Preparación de Datos (Una sola vez)

```
┌────────────────────────────────────────────────────────────────┐
│  php artisan rag:ingest:pokemon                                │
├────────────────────────────────────────────────────────────────┤
│                                                                │
│  ┌──────────────────┐    ┌──────────────────┐                  │
│  │ Markdown File    │    │ CommonMark       │                  │
│  │ pokemon-guide.md │───▶│ Parser           │                  │
│  └──────────────────┘    └────────┬─────────┘                  │
│                                   │                             │
│                                   ▼                             │
│                          ┌──────────────────┐                   │
│                          │ chunkByHeadings │                   │
│                          │ (Dividir por ##) │                   │
│                          └────────┬─────────┘                  │
│                                   │                             │
│                                   ▼                             │
│                    ┌─────────────────────────────┐              │
│                    │  Laravel AI SDK             │              │
│                    │  Embeddings::for(texts)     │              │
│                    │  → nomic-embed-text         │              │
│                    │  (768 dimensiones)          │              │
│                    └────────────┬────────────────┘              │
│                                   │                             │
│                                   ▼                             │
│                    ┌─────────────────────────────┐              │
│                    │  Guardar en PostgreSQL     │              │
│                    │  with pgvector              │              │
│                    │  DocumentChunk model        │              │
│                    └─────────────────────────────┘              │
│                                                                │
└────────────────────────────────────────────────────────────────┘
```

---

## 5. Flujo Completo: Consulta

### Fase 2: Pregunta del Usuario (Cada vez)

```
┌────────────────────────────────────────────────────────────────┐
│  Usuario pregunta: "¿Cómo evoluciona Eevee?"                  │
├────────────────────────────────────────────────────────────────┤
│                                                                │
│  ┌─────────────────┐                                          │
│  │ PokemonAgent    │                                          │
│  │ ::make()        │                                          │
│  │ ->stream()      │                                          │
│  └────────┬────────┘                                          │
│           │                                                   │
│           ▼                                                   │
│  ┌──────────────────────────────────────────────┐             │
│  │ MIDDLEWARE: RetrieveContext                  │             │
│  │                                              │             │
│  │ 1. Recibe $prompt (pregunta usuario)         │             │
│  │ 2. whereVectorSimilarTo('embedding',         │             │
│  │     $prompt->prompt, minSimilarity: 0.3)    │             │
│  │ 3. Recupera chunks más similares             │             │
│  │ 4. $prompt->agent->withChunks($chunks)       │             │
│  └────────────┬─────────────────────────────────┘             │
│               │                                                 │
│               ▼                                                 │
│  ┌──────────────────────────────────────────────┐             │
│  │ instructions() → pokemon-rag.blade.php       │             │
│  │                                              │             │
│  │ Renderiza:                                   │             │
│  │ "You are a helpful Pokémon assistant..."    │             │
│  │                                              │             │
│  │ ## Context:                                  │             │
│  │ --- Source 0 (Evolution Mechanics):          │             │
│  │ Eevee puede evolucionar a Vaporeon...       │             │
│  │ --- Source 1 (...):                         │             │
│  └────────────┬─────────────────────────────────┘             │
│               │                                                 │
│               ▼                                                 │
│  ┌──────────────────────────────────────────────┐             │
│  │ Ollama (gemma3:1b)                           │             │
│  │                                              │             │
│  │ Prompt completo con contexto + pregunta      │             │
│  │                                              │             │
│  │ Modelo responde usando SOLO el contexto      │             │
│  └──────────────────────────────────────────────┘             │
│                                                                │
└────────────────────────────────────────────────────────────────┘
```

---

## 6. Parámetros del Middleware Explicados

### minSimilarity (0.3)

Define qué tan "parecida" debe ser la pregunta al chunk para incluirlo.

```
Pregunta: "¿Cómo evoluciona Eevee?"

Chunk A: "Eevee evoluciona con stones"     → 85% similar ✓ (incluido)
Chunk B: "Charmander evoluciona a lvl 16"  → 25% similar ✗ (excluido)
Chunk C: "Tipos de Pokémon"               → 10% similar ✗ (excluido)
```

**Ajustes recomendados**:

| Valor | Efecto |
|-------|--------|
| 0.1 | Incluye mucho ruido, puede incluir info no relevante |
| 0.3 | Balance bueno (**recomendado**) |
| 0.7 | Solo chunks muy similares, puede perder contexto |

---

### limit (10)

Define cuántos chunks máximos se recuperan para el contexto.

```
limit: 3    → Solo 3 chunks (más rápido, menos contexto)
limit: 10   → 10 chunks (balance) ← Recomendado
limit: 50   → Muchos chunks (más lento, puede saturar)
```

**Ejemplo práctico**:

| Pregunta | Chunks recuperados |
|----------|-------------------|
| "¿Tipos de fuego?" | 1 chunk muy relevante |
| "¿Cómo evolucionar?" | 5 chunks (stones, level, regional) |
| "¿Competición?" | 2 chunks (tiers, EV training) |

---

## 7. Configuración de Ollama

### Providers en config/ai.php

```php
'ollama' => [
    'driver' => 'ollama',
    'key' => env('OLLAMA_API_KEY', ''),
    'url' => env('OLLAMA_URL', 'http://localhost:11434'),
    'model' => 'gemma3:1b',
    'models' => [
        'text' => [
            'default' => 'gemma3:1b',
        ],
        'embeddings' => [
            'default' => 'nomic-embed-text:latest',
            'dimensions' => 768,
        ],
    ],
],
```

### Modelos utilizados

| Propósito | Modelo | Dimensiones |
|-----------|--------|-------------|
| Embeddings (buscar) | nomic-embed-text | 768 |
| Chat (responder) | gemma3:1b | N/A |

---

## 8. Base de Datos Vectorial

### Requisitos

- **PostgreSQL** con extensión **pgvector**
- La extensión permite almacenar vectores y hacer búsquedas de similitud

### Creación de tabla

```php
Schema::ensureVectorExtensionExists();

Schema::create('document_chunks', function (Blueprint $table) {
    $table->id();
    $table->string('source');
    $table->string('heading')->nullable();
    $table->text('chunk_text');
    $table->json('metadata')->nullable();
    $table->vector('embedding', dimensions: 768)->index();
    $table->timestamps();
});
```

### Búsqueda de similitud

```php
// Encontrar chunks similares a una pregunta
$chunks = DocumentChunk::query()
    ->whereVectorSimilarTo(
        'embedding',           // columna con vectores
        $pregunta,             // texto a buscar (se convierte a vector)
        0.3                    // umbral de similitud
    )
    ->limit(10)
    ->get();
```

---

## 9. Ejemplo de Conversación

### Pregunta: "¿Cómo evoluciona Eevee?"

**1. Middleware busca chunks similares:**

- "Evolution Mechanics" (90% similar)
- "Evolution Stones" (75% similar)

**2. Prompt con contexto:**

```
You are a helpful Pokémon assistant. Your task is to answer 
using ONLY the provided context.

## Context:
--- Source 0 (Evolution Mechanics):
Eevee puede evolucionar a Vaporeon (Water Stone), Jolteon 
(Thunder Stone), Flareon (Fire Stone)...

--- Source 1 (Evolution Stones):
Fire Stone: Vulpix → Ninetales, Eevee → Flareon
Water Stone: Eevee → Vaporeon
```

**3. Modelo responde:**

"Eevee tiene 8 evoluciones diferentes dependiendo de la piedra..."
(Ahora el modelo tiene información real del documento)

---

## 10. Ventajas del Enfoque

- ✅ **Sin API externa costosa** - Usa Ollama local
- ✅ **Respuestas basadas en documentos** - No inventa datos
- ✅ **Honesto** - Indica cuando no tiene información
- ✅ **Escalable** - Agregando más documentos al markdown
- ✅ **Controlado** - El middleware filtra el contexto

---

## 11. Resumen de Archivos

| Archivo | Propósito |
|---------|-----------|
| `storage/data/pokemon-guide.md` | Documento fuente con información |
| `database/migrations/...document_chunks.php` | Tabla con vectores |
| `app/Models/DocumentChunk.php` | Modelo Eloquent |
| `app/Console/Commands/IngestPokemon.php` | Comando de ingestión |
| `app/Ai/Middleware/RetrieveContext.php` | Búsqueda de contexto |
| `app/Ai/Agents/PokemonAgent.php` | Agente con instrucciones |
| `resources/views/prompts/pokemon-rag.blade.php` | Plantilla de prompt |
| `resources/views/pages/ia/⚡chat.blade.php` | Interfaz de chat |
| `config/ai.php` | Configuración de providers |

---

## 12. Comandos Útiles

```bash
# Ingestar documento
php artisan rag:ingest:pokemon

# Ver chunks en BD
php artisan tinker --execute="App\Models\DocumentChunk::count()"

# Probar búsqueda vectorial
php artisan tinker --execute="App\Models\DocumentChunk::query()->whereVectorSimilarTo('embedding', 'tipos fuego', 0.3)->get()"

# Probar agente
php artisan tinker --execute="echo App\Ai\Agents\PokemonAgent::make()->prompt('pregunta')->text"
```

---

*Documento generado para el curso de Laravel AI SDK - RAG System*