<div class="px-4 py-12 w-full bg-white dark:bg-zinc-800" x-data="{ create_root_folder: false }">
    <div class="text-center">
        <?php if (isset($component)) { $__componentOriginalabd02e4dbe95666b35785201ce8e69c1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalabd02e4dbe95666b35785201ce8e69c1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.icons.folder','data' => ['class' => 'mx-auto h-16']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::icons.folder'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mx-auto h-16']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalabd02e4dbe95666b35785201ce8e69c1)): ?>
<?php $attributes = $__attributesOriginalabd02e4dbe95666b35785201ce8e69c1; ?>
<?php unset($__attributesOriginalabd02e4dbe95666b35785201ce8e69c1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalabd02e4dbe95666b35785201ce8e69c1)): ?>
<?php $component = $__componentOriginalabd02e4dbe95666b35785201ce8e69c1; ?>
<?php unset($__componentOriginalabd02e4dbe95666b35785201ce8e69c1); ?>
<?php endif; ?>

        <h3 class="mt-2 font-semibold text-gray-900 dark:text-zinc-300"><?php echo e(__('livewire-filemanager::filemanager.root_folder_not_configurated')); ?></h3>
        <p class="mt-1 text-base text-gray-500 dark:text-zinc-300"><?php echo e(__('livewire-filemanager::filemanager.root_folder_not_configurated_help')); ?></p>

        <div class="mt-6">
            <?php if (isset($component)) { $__componentOriginal699fd8f07e236bed7c5c8be7acb7d383 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal699fd8f07e236bed7c5c8be7acb7d383 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.buttons.primary','data' => ['xOn:click' => 'create_root_folder = true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::buttons.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-on:click' => 'create_root_folder = true']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php if (isset($component)) { $__componentOriginalb62066b219f207c57a345c503be37dcd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb62066b219f207c57a345c503be37dcd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.icons.plus','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::icons.plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb62066b219f207c57a345c503be37dcd)): ?>
<?php $attributes = $__attributesOriginalb62066b219f207c57a345c503be37dcd; ?>
<?php unset($__attributesOriginalb62066b219f207c57a345c503be37dcd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb62066b219f207c57a345c503be37dcd)): ?>
<?php $component = $__componentOriginalb62066b219f207c57a345c503be37dcd; ?>
<?php unset($__componentOriginalb62066b219f207c57a345c503be37dcd); ?>
<?php endif; ?>

                <span><?php echo e(__('livewire-filemanager::filemanager.add_your_first_folder')); ?></span>
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
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginalcfba2f2e3977da69fbf2ec07a678babd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcfba2f2e3977da69fbf2ec07a678babd = $attributes; } ?>
<?php $component = LivewireFilemanager\Filemanager\Http\Components\BladeFilemanagerModalComponent::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\LivewireFilemanager\Filemanager\Http\Components\BladeFilemanagerModalComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['modal' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('create_root_folder')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

         <?php $__env->slot('title', null, []); ?> <?php echo e(__('livewire-filemanager::filemanager.add_your_first_folder')); ?> <?php $__env->endSlot(); ?>

        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-zinc-300"><?php echo e(__('livewire-filemanager::filemanager.root_folder_name')); ?></label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <?php if (isset($component)) { $__componentOriginal4fd9e9f5e9c003c69f6a0dbc6cec8cd8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4fd9e9f5e9c003c69f6a0dbc6cec8cd8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.form.text-input','data' => ['type' => 'text','autofocus' => true,'wire:model' => 'newFolderName','name' => 'folder','id' => 'folder','class' => ''.e(($errors->has('newFolderName') ? 'focus:ring-red-500 focus:border-red-500 focus:ring-red-500 ring-red-500 dark:focus:ring-red-600 dark:ring-red-600' : 'ring-gray-300 focus:ring-indigo-600')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::form.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','autofocus' => true,'wire:model' => 'newFolderName','name' => 'folder','id' => 'folder','class' => ''.e(($errors->has('newFolderName') ? 'focus:ring-red-500 focus:border-red-500 focus:ring-red-500 ring-red-500 dark:focus:ring-red-600 dark:ring-red-600' : 'ring-gray-300 focus:ring-indigo-600')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4fd9e9f5e9c003c69f6a0dbc6cec8cd8)): ?>
<?php $attributes = $__attributesOriginal4fd9e9f5e9c003c69f6a0dbc6cec8cd8; ?>
<?php unset($__attributesOriginal4fd9e9f5e9c003c69f6a0dbc6cec8cd8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4fd9e9f5e9c003c69f6a0dbc6cec8cd8)): ?>
<?php $component = $__componentOriginal4fd9e9f5e9c003c69f6a0dbc6cec8cd8; ?>
<?php unset($__componentOriginal4fd9e9f5e9c003c69f6a0dbc6cec8cd8); ?>
<?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newFolderName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-5 w-5 text-red-500 dark:text-red-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newFolderName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600 dark:text-red-600" id="email-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

         <?php $__env->slot('action', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal699fd8f07e236bed7c5c8be7acb7d383 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal699fd8f07e236bed7c5c8be7acb7d383 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.buttons.primary','data' => ['type' => 'button','wire:click' => 'saveNewFolder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::buttons.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','wire:click' => 'saveNewFolder']); ?>
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
<?php /**PATH C:\Users\andre\Herd\livewirestore\vendor\livewire-filemanager\filemanager\src/../resources/views/partials/empty-application.blade.php ENDPATH**/ ?>