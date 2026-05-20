<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

new class extends Component {
    // 1. Estado reactivo público del componente
    public string $search = '';

    // Lista estática de tareas iniciales para el ejemplo
    public array $todos = [['id' => 1, 'task' => 'Aprender sintaxis básica de Livewire 4', 'completed' => true], ['id' => 2, 'task' => 'Comprender el ciclo de vida del componente', 'completed' => true], ['id' => 3, 'task' => 'Dominar Propiedades Computadas (#[Computed])', 'completed' => false], ['id' => 4, 'task' => 'Implementar carga diferida (Lazy Loading)', 'completed' => false], ['id' => 5, 'task' => 'Desplegar la aplicación en producción', 'completed' => false]];

    // Variables de control para demostrar didácticamente el almacenamiento en caché (caching)
    public int $filteredExecutionCount = 0;
    public int $statsExecutionCount = 0;

    /**
     * PROPIEDAD COMPUTADA: filteredTodos
     *
     * En Livewire 4, las propiedades computadas se marcan con el atributo #[Computed].
     *
     * ¿Por qué usarlas?
     * 1. Rendimiento: Se calculan bajo demanda (lazy evaluation) y su resultado se almacena
     *    en caché para la duración de la petición actual (petición HTTP o actualización de Livewire).
     * 2. Orden: Mantienen el método render() o el HTML limpio de consultas y filtros complejos.
     *
     * Acceso en la vista: $this->filteredTodos (como si fuera una propiedad pública, sin paréntesis).
     */
    #[Computed]
    public function filteredTodos(): array
    {
        // Incrementamos el contador para demostrar cuántas veces se ejecuta realmente el método.
        $this->filteredExecutionCount++;

        // Si el buscador está vacío, retornamos todas las tareas
        if (empty($this->search)) {
            return $this->todos;
        }

        // Filtramos las tareas según el término de búsqueda
        return array_filter($this->todos, function ($todo) {
            return str_contains(strtolower($todo['task']), strtolower($this->search));
        });
    }

    /**
     * PROPIEDAD COMPUTADA: stats
     *
     * Las propiedades computadas pueden depender de otras propiedades computadas.
     * Aquí accedemos a $this->filteredTodos. Gracias al almacenamiento en caché,
     * no se vuelve a ejecutar la lógica de filtrado de filteredTodos(), sino que se
     * reutiliza el resultado ya calculado anteriormente.
     */
    #[Computed]
    public function stats(): array
    {
        // Incrementamos el contador para demostrar el número de ejecuciones
        $this->statsExecutionCount++;

        // Accedemos a la propiedad computada filteredTodos
        $filtered = $this->filteredTodos;

        $total = count($filtered);
        $completed = count(array_filter($filtered, fn($todo) => $todo['completed']));
        $pending = $total - $completed;
        $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;

        return [
            'total' => $total,
            'completed' => $completed,
            'pending' => $pending,
            'percentage' => $percentage,
        ];
    }

    /**
     * Acción para alternar el estado completado de una tarea
     */
    public function toggleTodo(int $id): void
    {
        foreach ($this->todos as &$todo) {
            if ($todo['id'] === $id) {
                $todo['completed'] = !$todo['completed'];
                break;
            }
        }
    }
};
?>

<div
    class="max-w-3xl mx-auto my-8 p-6 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl shadow-sm space-y-6">

    <!-- Encabezado simple -->
    <div class="border-b border-zinc-100 dark:border-zinc-800 pb-4">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
            Propiedades Computadas en Livewire 4
        </h1>
        <p class="text-sm text-zinc-500 mt-1">
            Ejemplo práctico enfocado en el uso de <code
                class="bg-zinc-100 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">#[Computed]</code>
            y el almacenamiento en caché.
        </p>
    </div>

    <!-- Buscador (Actualiza el estado reactivo) -->
    <div class="space-y-2">
        <label for="search" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
            Buscar tarea:
        </label>
        <!-- wire:model.live actualiza el componente en tiempo real al escribir -->
        <input type="text" id="search" wire:model.live="search" placeholder="Ej. Aprender..."
            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
    </div>

    <!-- 1. Estadísticas (Usa la propiedad computada $this->stats) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-zinc-50 dark:bg-zinc-800/50 rounded-lg">
        <div class="text-center">
            <span class="block text-xs font-medium text-zinc-500 uppercase">Filtradas</span>
            <span class="text-xl font-bold text-zinc-800 dark:text-white">{{ $this->stats['total'] }}</span>
        </div>
        <div class="text-center">
            <span class="block text-xs font-medium text-zinc-500 uppercase">Completadas</span>
            <span
                class="text-xl font-bold text-emerald-600 dark:text-emerald-400">{{ $this->stats['completed'] }}</span>
        </div>
        <div class="text-center">
            <span class="block text-xs font-medium text-zinc-500 uppercase">Pendientes</span>
            <span class="text-xl font-bold text-amber-600 dark:text-amber-400">{{ $this->stats['pending'] }}</span>
        </div>
        <div class="text-center">
            <span class="block text-xs font-medium text-zinc-500 uppercase">Progreso</span>
            <span
                class="text-xl font-bold text-indigo-600 dark:text-indigo-400">{{ $this->stats['percentage'] }}%</span>
        </div>
    </div>

    <!-- 2. Listado de tareas (Usa la propiedad computada $this->filteredTodos) -->
    <div class="space-y-3">
        <h3 class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Lista de Tareas</h3>

        <ul
            class="divide-y divide-zinc-100 dark:divide-zinc-800 border border-zinc-100 dark:border-zinc-800 rounded-lg overflow-hidden">
            @if(count($this->filteredTodos) === 0)
                <li class="p-4 text-center text-sm text-zinc-500">
                    No se encontraron tareas con "{{ $search }}".
                </li>
            @else
                @foreach ($this->filteredTodos as $todo)
                    <!-- Es buena práctica definir wire:key en loops de Livewire -->
                    <li wire:key="todo-{{ $todo['id'] }}"
                        class="flex items-center justify-between p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/30">
                        <span
                            class="{{ $todo['completed'] ? 'line-through text-zinc-400 dark:text-zinc-500' : 'text-zinc-700 dark:text-zinc-300' }}">
                            {{ $todo['task'] }}
                        </span>
                        <button wire:click="toggleTodo({{ $todo['id'] }})"
                            class="px-3 py-1 text-xs font-medium rounded-full {{ $todo['completed'] ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300' }}">
                            {{ $todo['completed'] ? 'Completada' : 'Marcar completada' }}
                        </button>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

    <!-- 3. Demostración de Almacenamiento en Caché (Para el Curso) -->
    <div
        class="p-4 border border-indigo-100 dark:border-indigo-900/50 bg-indigo-50/30 dark:bg-indigo-950/20 rounded-lg space-y-3">
        <h3 class="text-sm font-bold text-indigo-900 dark:text-indigo-300 flex items-center gap-2">
            <span>💡</span> Guía de Aprendizaje: Cache & Ejecuciones
        </h3>
        <p class="text-xs text-indigo-950/70 dark:text-indigo-300/70 leading-relaxed">
            En esta petición del servidor, las funciones de las propiedades computadas se han ejecutado exactamente
            estas veces:
        </p>
        <div class="grid grid-cols-2 gap-4 text-xs font-mono">
            <div class="bg-indigo-100/50 dark:bg-indigo-950/50 p-2 rounded">
                <span class="block text-zinc-500">filteredTodos()</span>
                <span class="font-bold text-indigo-700 dark:text-indigo-300">Ejecutado:
                    {{ $this->filteredExecutionCount }} vez/veces</span>
            </div>
            <div class="bg-indigo-100/50 dark:bg-indigo-950/50 p-2 rounded">
                <span class="block text-zinc-500">stats()</span>
                <span class="font-bold text-indigo-700 dark:text-indigo-300">Ejecutado:
                    {{ $this->statsExecutionCount }} vez/veces</span>
            </div>
        </div>
        <div class="text-[11px] text-zinc-500 leading-relaxed space-y-1">
            <p><strong>Observa en el código HTML de la vista:</strong></p>
            <ul class="list-disc list-inside space-y-1">
                <li>Usamos <code
                        class="bg-zinc-100 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">$this->stats[...]</code>
                    4 veces para mostrar los contadores.</li>
                <li>Llamamos a <code
                        class="bg-zinc-100 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">$this->filteredTodos</code>
                    para el loop <code
                        class="bg-zinc-100 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">@@foreach</code>.
                </li>
                <li>Y dentro del método <code
                        class="bg-zinc-100 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">stats()</code>
                    se accede a <code
                        class="bg-zinc-100 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">$this->filteredTodos</code>.
                </li>
            </ul>
            <p class="mt-2 text-indigo-800 dark:text-indigo-400 font-medium">
                ¡A pesar de acceder a ellas múltiples veces, el número de ejecuciones siempre es 1 por cada render!
            </p>
        </div>
    </div>
</div>
