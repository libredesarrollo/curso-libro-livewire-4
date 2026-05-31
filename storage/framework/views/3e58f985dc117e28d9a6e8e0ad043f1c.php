<div x-cloak x-data="{ file: false }"
    x-on:rename-file.window="file = true"
    x-on:reset-media.window="file = false">

    <?php if (isset($component)) { $__componentOriginalcfba2f2e3977da69fbf2ec07a678babd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcfba2f2e3977da69fbf2ec07a678babd = $attributes; } ?>
<?php $component = LivewireFilemanager\Filemanager\Http\Components\BladeFilemanagerModalComponent::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\LivewireFilemanager\Filemanager\Http\Components\BladeFilemanagerModalComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['modal' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('file')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

         <?php $__env->slot('title', null, []); ?> 
            <?php echo e(__('livewire-filemanager::filemanager.rename_file')); ?>

         <?php $__env->endSlot(); ?>

        <div>
            <input type="text" wire:model="name" class="rounded border border-zinc-300 w-full py-2 px-3 zinc-500 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:me-2 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-500">
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm text-red-500 dark:text-red-400"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

         <?php $__env->slot('action', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal699fd8f07e236bed7c5c8be7acb7d383 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal699fd8f07e236bed7c5c8be7acb7d383 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.buttons.primary','data' => ['type' => 'button','wire:click' => 'save']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::buttons.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','wire:click' => 'save']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php echo e(__('livewire-filemanager::filemanager.actions.save')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal699fd8f07e236bed7c5c8be7acb7d383)): ?>
<?php $attributes = $__attributesOriginal699fd8f07e236bed7c5c8be7acb7d383; ?>
<?php unset($__attributesOriginal699fd8f07e236bed7c5c8be7acb7d383); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal699fd8f07e236bed7c5c8be7acb7d383)): ?>
<?php $component = $__componentOriginal699fd8f07e236bed7c5c8be7acb7d383; ?>
<?php unset($__componentOriginal699fd8f07e236bed7c5c8be7acb7d383); ?>
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
<?php /**PATH /Users/andrescruz/Herd/livewirestore/vendor/livewire-filemanager/filemanager/src/../resources/views/livewire/rename-file.blade.php ENDPATH**/ ?>