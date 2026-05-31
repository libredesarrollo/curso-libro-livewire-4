<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['folder', 'selectedFolders', 'selectedFiles']));

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

foreach (array_filter((['folder', 'selectedFolders', 'selectedFiles']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    x-data="{ clickTimeout: null, isDragOver: false }"
    draggable="true"
    x-on:dragstart="
        const isSelected = <?php echo json_encode($selectedFolders, 15, 512) ?>.includes(<?php echo e($folder->id); ?>);
        if (!isSelected) {
            $wire.clearSelection();
            $wire.toggleFolderSelection(<?php echo e($folder->id); ?>);
        }
        event.dataTransfer.effectAllowed = 'move';
        event.dataTransfer.setData('text/plain', JSON.stringify({
            folders: isSelected ? <?php echo json_encode($selectedFolders, 15, 512) ?> : [<?php echo e($folder->id); ?>],
            files: isSelected ? <?php echo json_encode($selectedFiles, 15, 512) ?> : []
        }));
        $el.classList.add('opacity-50');
    "
    x-on:dragend="$el.classList.remove('opacity-50')"
    x-on:dragover.prevent="
        if (!<?php echo json_encode($selectedFolders, 15, 512) ?>.includes(<?php echo e($folder->id); ?>) && !event.dataTransfer.types.includes('Files')) {
            event.dataTransfer.dropEffect = 'move';
            isDragOver = true;
        }
    "
    x-on:dragleave.prevent="isDragOver = false"
    x-on:drop.prevent="
        if (!<?php echo json_encode($selectedFolders, 15, 512) ?>.includes(<?php echo e($folder->id); ?>)) {
            isDragOver = false;
            const dragData = event.dataTransfer.getData('text/plain');
            if (dragData) {
                try {
                    const data = JSON.parse(dragData);
                    if (data.folders || data.files) {
                        $wire.moveItemsToFolder(<?php echo e($folder->id); ?>, data.folders || [], data.files || []);
                    }
                } catch (e) {
                    console.error('Invalid drag data:', e);
                }
            }
        }
    "
    :class="{ 
        '!bg-gray-200/50 !hover:bg-gray-200/60 !dark:bg-gray-700 !hover:dark:bg-gray-700 group': <?php echo json_encode($selectedFolders, 15, 512) ?>.includes(<?php echo e($folder->id); ?>),
        '!bg-blue-100 !dark:bg-blue-900/50 ring-2 ring-blue-400': isDragOver
    }"
    x-on:click.stop="
        if (this.clickTimeout) {
            clearTimeout(this.clickTimeout);
            this.clickTimeout = null;
        }
        
        const ctrlPressed = event.ctrlKey || event.metaKey;
        const isSelected = <?php echo json_encode($selectedFolders, 15, 512) ?>.includes(<?php echo e($folder->id); ?>);

        this.clickTimeout = setTimeout(() => {
            if (ctrlPressed) {
                $wire.toggleFolderSelection(<?php echo e($folder->id); ?>);
            } else {
                if (!isSelected) {
                    $wire.clearSelection();
                    $wire.toggleFolderSelection(<?php echo e($folder->id); ?>);
                }
            }
            
            $nextTick(() => {
                $wire.handleFolderClick(<?php echo e($folder->id); ?>);
            });
        }, 200);
    "
    x-on:dblclick.stop="
        if (this.clickTimeout) {
            clearTimeout(this.clickTimeout);
            this.clickTimeout = null;
        }
        $wire.navigateToFolder(<?php echo e($folder->id); ?>);
    "
    x-on:mousedown.stop=""
    data-id="<?php echo e($folder->id); ?>"
    class="folder cursor-pointer mb-4 max-w-[137px] min-w-[137px] max-h-[137px] min-h-[137px] items-start p-2 mx-1 hover:bg-blue-100/30 hover:dark:bg-gray-700 text-center select-none">
        <?php if (isset($component)) { $__componentOriginalabd02e4dbe95666b35785201ce8e69c1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalabd02e4dbe95666b35785201ce8e69c1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.icons.folder','data' => ['class' => 'mx-auto w-16 h-16 mb-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::icons.folder'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mx-auto w-16 h-16 mb-2']); ?>
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

        <div class="flex flex-wrap text-center">
            <span :class="{ 'bg-blue-500 text-white dark:bg-blue-700 group': <?php echo json_encode($selectedFolders, 15, 512) ?>.includes(<?php echo e($folder->id); ?>) }" class="text-ellipsis overflow-hidden break-words w-full block text-xs max-w-[150px] dark:text-zinc-200 rounded"><?php echo e($folder->name); ?></span>
            <small :class="{ 'text-blue-900': <?php echo json_encode($selectedFolders, 15, 512) ?>.includes(<?php echo e($folder->id); ?>) }" class="w-full block text-xs text-blue-500"><?php echo e($folder->elements()); ?></small>
        </div>
</div>
<?php /**PATH /Users/andrescruz/Herd/livewirestore/vendor/livewire-filemanager/filemanager/src/../resources/views/components/elements/directory.blade.php ENDPATH**/ ?>