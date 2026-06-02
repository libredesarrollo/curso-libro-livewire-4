<?php
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Layout;
?>

<div class="p-6 border rounded-lg shadow-sm bg-white">
    <h2 class="text-xl font-bold mb-4">Demo de Loading States Avanzado</h2>

    <div class="mb-8 p-4 border-l-4 border-yellow-500 bg-yellow-50">
        <h3 class="font-semibold text-yellow-700">1. Sin Target (Genérico)</h3>
        <button wire:click="refreshUsers" class="bg-blue-500 text-white px-4 py-2 rounded">
            Refrescar Todo
        </button>

        <div wire:loading class="mt-2 text-blue-600 font-bold italic">
            ⌛ Procesando algo en el servidor... (Salgo con CUALQUIER botón)
        </div>
    </div>

    <div class="p-4 border-l-4 border-green-500 bg-green-50">
        <h3 class="font-semibold text-green-700 mb-4">2. Targets Específicos y por ID</h3>
        
        <div class="mb-6">
            <button wire:click="addUser" 
                    wire:loading.attr="disabled" 
                    wire:target="addUser"
                    class="bg-green-600 disabled:opacity-50 text-white px-4 py-2 rounded">
                <span wire:loading.remove wire:target="addUser">➕ Añadir Usuario</span>
                <span wire:loading wire:target="addUser">Agregando...</span>
            </button>
        </div>

        <div class="bg-white dark:bg-gray-900 border rounded-xl p-4 shadow-sm">
            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4">Lista de usuarios</h4>

            <ul class="space-y-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <li class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <span wire:loading.class="opacity-50" wire:target="deleteUser(<?php echo e($user['id']); ?>)">
                            <?php echo e($user['name']); ?>

                        </span>

                        <button 
                            wire:click="deleteUser(<?php echo e($user['id']); ?>)" 
                            wire:loading.attr="disabled"
                            wire:target="deleteUser(<?php echo e($user['id']); ?>)"
                            class="bg-red-100 text-red-600 px-3 py-1 rounded-md hover:bg-red-200 disabled:opacity-50 transition"
                        >
                            <span wire:loading wire:target="deleteUser(<?php echo e($user['id']); ?>)">
                                🗑️ Eliminando...
                            </span>
                            
                            <span wire:loading.remove wire:target="deleteUser(<?php echo e($user['id']); ?>)">
                                Eliminar
                            </span>
                        </button>
                    </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ul>
        </div>
    </div>
</div><?php /**PATH C:\Users\andre\Herd\livewirestore\storage\framework/views/livewire/views/e58cc596.blade.php ENDPATH**/ ?>