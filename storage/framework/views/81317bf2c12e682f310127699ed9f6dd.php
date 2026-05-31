<?php
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
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
            <span class="text-xl font-bold text-zinc-800 dark:text-white"><?php echo e($this->stats['total']); ?></span>
        </div>
        <div class="text-center">
            <span class="block text-xs font-medium text-zinc-500 uppercase">Completadas</span>
            <span
                class="text-xl font-bold text-emerald-600 dark:text-emerald-400"><?php echo e($this->stats['completed']); ?></span>
        </div>
        <div class="text-center">
            <span class="block text-xs font-medium text-zinc-500 uppercase">Pendientes</span>
            <span class="text-xl font-bold text-amber-600 dark:text-amber-400"><?php echo e($this->stats['pending']); ?></span>
        </div>
        <div class="text-center">
            <span class="block text-xs font-medium text-zinc-500 uppercase">Progreso</span>
            <span
                class="text-xl font-bold text-indigo-600 dark:text-indigo-400"><?php echo e($this->stats['percentage']); ?>%</span>
        </div>
    </div>

    <!-- 2. Listado de tareas (Usa la propiedad computada $this->filteredTodos) -->
    <div class="space-y-3">
        <h3 class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Lista de Tareas</h3>

        <ul
            class="divide-y divide-zinc-100 dark:divide-zinc-800 border border-zinc-100 dark:border-zinc-800 rounded-lg overflow-hidden">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($this->filteredTodos) === 0): ?>
                <li class="p-4 text-center text-sm text-zinc-500">
                    No se encontraron tareas con "<?php echo e($search); ?>".
                </li>
            <?php else: ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->filteredTodos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $todo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <!-- Es buena práctica definir wire:key en loops de Livewire -->
                    <li <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'todo-'.e($todo['id']).''; ?>wire:key="todo-<?php echo e($todo['id']); ?>"
                        class="flex items-center justify-between p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/30">
                        <span
                            class="<?php echo e($todo['completed'] ? 'line-through text-zinc-400 dark:text-zinc-500' : 'text-zinc-700 dark:text-zinc-300'); ?>">
                            <?php echo e($todo['task']); ?>

                        </span>
                        <button wire:click="toggleTodo(<?php echo e($todo['id']); ?>)"
                            class="px-3 py-1 text-xs font-medium rounded-full <?php echo e($todo['completed'] ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300'); ?>">
                            <?php echo e($todo['completed'] ? 'Completada' : 'Marcar completada'); ?>

                        </button>
                    </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                    <?php echo e($this->filteredExecutionCount); ?> vez/veces</span>
            </div>
            <div class="bg-indigo-100/50 dark:bg-indigo-950/50 p-2 rounded">
                <span class="block text-zinc-500">stats()</span>
                <span class="font-bold text-indigo-700 dark:text-indigo-300">Ejecutado:
                    <?php echo e($this->statsExecutionCount); ?> vez/veces</span>
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
                        class="bg-zinc-100 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">@foreach</code>.
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
</div><?php /**PATH /Users/andrescruz/Herd/livewirestore/storage/framework/views/livewire/views/9579bdef.blade.php ENDPATH**/ ?>