<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['modal']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['modal']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div x-dialog x-model="<?php echo e($modal); ?>" style="display: none" class="fixed inset-0 overflow-y-auto z-10">
    <div x-dialog:overlay x-transition.opacity class="fixed inset-0 bg-indigo-950/50 dark:bg-zinc-700/80"></div>

    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div x-dialog:panel x-transition class="relative max-w-xl w-full bg-white rounded-xl shadow-lg overflow-y-auto dark:bg-zinc-800">
            <div class="absolute top-0 end-0 pt-4 pe-4">
                <button type="button" @click="$dialog.close()" class="bg-gray-50 rounded-lg p-2 text-gray-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:bg-zinc-700 dark:text-zinc-200">
                    <span class="sr-only"><?php echo e(__('livewire-filemanager::filemanager.actions.close_modal')); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="p-4">
                <h2 class="text-xl font-bold text-black dark:text-zinc-300"><?php echo e($title); ?></h2>

                <div class="py-8 text-black dark:text-zinc-300">
                    <?php echo e($slot); ?>

                </div>
            </div>

            <div class="p-4 flex justify-end gap-x-2 bg-gray-50 dark:bg-zinc-900/30">
                <?php if (isset($component)) { $__componentOriginal561f32f05902c90e73bbbbedc553a887 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal561f32f05902c90e73bbbbedc553a887 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.buttons.secondary','data' => ['type' => 'button','xOn:click' => '$dialog.close()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::buttons.secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','x-on:click' => '$dialog.close()']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    <?php echo e(__('livewire-filemanager::filemanager.actions.cancel')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal561f32f05902c90e73bbbbedc553a887)): ?>
<?php $attributes = $__attributesOriginal561f32f05902c90e73bbbbedc553a887; ?>
<?php unset($__attributesOriginal561f32f05902c90e73bbbbedc553a887); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal561f32f05902c90e73bbbbedc553a887)): ?>
<?php $component = $__componentOriginal561f32f05902c90e73bbbbedc553a887; ?>
<?php unset($__componentOriginal561f32f05902c90e73bbbbedc553a887); ?>
<?php endif; ?>

                <?php echo e($action); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\andre\Herd\livewirestore\vendor\livewire-filemanager\filemanager\src/../resources/views/components/livewire-filemanager-modal.blade.php ENDPATH**/ ?>