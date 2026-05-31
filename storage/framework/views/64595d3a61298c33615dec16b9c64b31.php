<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['folder', 'media', 'selectedFiles', 'selectedFolders' => [], 'key']));

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

foreach (array_filter((['folder', 'media', 'selectedFiles', 'selectedFolders' => [], 'key']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    x-data="{ isDragging: false }"
    draggable="true"
    x-on:dragstart="
        const isSelected = <?php echo json_encode($selectedFiles, 15, 512) ?>.includes(<?php echo e($media->id); ?>);
        if (!isSelected) {
            $wire.clearSelection();
            $wire.toggleFileSelection(<?php echo e($media->id); ?>);
        }
        isDragging = true;
        event.dataTransfer.effectAllowed = 'move';
        const selectedFolders = <?php echo json_encode($selectedFolders ?? [], 15, 512) ?>;
        event.dataTransfer.setData('text/plain', JSON.stringify({
            folders: isSelected ? selectedFolders : [],
            files: isSelected ? <?php echo json_encode($selectedFiles, 15, 512) ?> : [<?php echo e($media->id); ?>]
        }));
    "
    x-on:dragend="isDragging = false"
    :class="{ 
        '!bg-gray-200/50 !hover:bg-gray-200/60 !dark:bg-gray-700 !hover:dark:bg-gray-700 group': <?php echo json_encode($selectedFiles, 15, 512) ?>.includes(<?php echo e($media->id); ?>),
        'opacity-50': isDragging
    }"
    x-on:click.stop="
        const isSelected = <?php echo json_encode($selectedFiles, 15, 512) ?>.includes(<?php echo e($media->id); ?>);
        
        if (event.ctrlKey || event.metaKey) {
            $wire.toggleFileSelection(<?php echo e($media->id); ?>);
        } else {
            if (!isSelected) {
                $wire.clearSelection();
                $wire.toggleFileSelection(<?php echo e($media->id); ?>);
            }
        }
        
        $nextTick(() => {
            $wire.handleMediaClick(<?php echo e($media->id); ?>);
        });
    "
    x-on:mousedown.stop=""
    data-id="<?php echo e($media->id); ?>"
    id="<?php echo e($key); ?>"
    class="file cursor-pointer mb-4 max-w-[137px] min-w-[137px] max-h-[137px] min-h-[137px] items-start p-2 mx-1 hover:bg-blue-100/30 hover:dark:bg-gray-700 text-center select-none">
    <div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($media->hasGeneratedConversion('thumbnail')): ?>
            <img src="<?php echo e($media->getUrl('thumbnail')); ?>" class="mx-auto shadow border p-1 bg-white max-w-20 max-h-20 mb-2" alt="folder">
        <?php else: ?>
            <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'livewire-filemanager::icons.mimes.' . getFileType($media->mime_type)] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'icon-'.e($key).'','class' => 'mx-auto w-16 h-16 mb-2.5']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="flex flex-wrap text-center">
        <span class="text-ellipsis overflow-hidden break-words w-full block text-xs max-w-[150px] dark:text-zinc-200"><?php echo e(trimString($media->name, 38)); ?></span>
    </div>
</div>
<?php /**PATH /Users/andrescruz/Herd/livewirestore/vendor/livewire-filemanager/filemanager/src/../resources/views/components/elements/media.blade.php ENDPATH**/ ?>