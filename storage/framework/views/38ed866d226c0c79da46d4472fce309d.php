<div x-cloak x-data="{ delete_items: false }"
    x-on:delete-items.window="delete_items = true"
    x-on:reset-media.window="delete_items = false">

    <?php if (isset($component)) { $__componentOriginalcfba2f2e3977da69fbf2ec07a678babd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcfba2f2e3977da69fbf2ec07a678babd = $attributes; } ?>
<?php $component = LivewireFilemanager\Filemanager\Http\Components\BladeFilemanagerModalComponent::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\LivewireFilemanager\Filemanager\Http\Components\BladeFilemanagerModalComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['modal' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('delete_items')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

         <?php $__env->slot('title', null, []); ?> <?php echo e(__('livewire-filemanager::filemanager.delete_items')); ?> <?php $__env->endSlot(); ?>

        <p class="text-black dark:text-zinc-300"><?php echo e(__('livewire-filemanager::filemanager.delete_items_warning')); ?></p>

         <?php $__env->slot('action', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginalc4ee42ccf68971ecfa665d62767f1d5a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc4ee42ccf68971ecfa665d62767f1d5a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.buttons.danger','data' => ['type' => 'button','wire:click' => 'delete']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::buttons.danger'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','wire:click' => 'delete']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php echo e(__('livewire-filemanager::filemanager.actions.delete')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc4ee42ccf68971ecfa665d62767f1d5a)): ?>
<?php $attributes = $__attributesOriginalc4ee42ccf68971ecfa665d62767f1d5a; ?>
<?php unset($__attributesOriginalc4ee42ccf68971ecfa665d62767f1d5a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc4ee42ccf68971ecfa665d62767f1d5a)): ?>
<?php $component = $__componentOriginalc4ee42ccf68971ecfa665d62767f1d5a; ?>
<?php unset($__componentOriginalc4ee42ccf68971ecfa665d62767f1d5a); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcfba2f2e3977da69fbf2ec07a678babd)): ?>
<?php $attributes = $__attributesOriginalcfba2f2e3977da69fbf2ec07a678babd; ?>
<?php unset($__attributesOriginalcfba2f2e3977da69fbf2ec07a678babd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcfba2f2e3977da69fbf2ec07a678babd)): ?>
<?php $component = $__componentOriginalcfba2f2e3977da69fbf2ec07a678babd; ?>
<?php unset($__componentOriginalcfba2f2e3977da69fbf2ec07a678babd); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\Users\andre\Herd\livewirestore\vendor\livewire-filemanager\filemanager\src/../resources/views/livewire/delete-items.blade.php ENDPATH**/ ?>