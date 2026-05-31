<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$currentFolder): ?>
        <?php echo $__env->make('livewire-filemanager::partials.empty-application', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php else: ?>
        <div class="w-full" x-data="FilemanagerComponent()"
            x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="uploading = false"
            x-on:livewire-upload-error="uploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress"
            @dragstart.window="handleDragStart($event)"
            @dragend.window="handleDragEnd($event)">
            <div class="w-full shadow-sm bg-white pt-4 border border-zinc-300 sm:rounded dark:border-zinc-700 dark:bg-zinc-800">
                <div class="px-4 pb-4 sm:px-5 flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-zinc-300">
                        <?php echo e($currentFolder->name); ?>


                        <span class="px-2 text-gray-600 dark:text-zinc-400">|</span>
                        <span class="text-gray-500 text-sm dark:text-zinc-400"><?php echo e($currentFolder->elements()); ?><?php echo ((count($selectedFolders) + count($selectedFiles)) > 0 ? ' <span class="text-zinc-700 dark:text-zinc-400">(' . (count($selectedFolders) + count($selectedFiles)) . ' ' . trans_choice('livewire-filemanager::filemanager.selected', (count($selectedFolders) + count($selectedFiles))) . ')</span>' : ''); ?></span>
                    </h2>

                    <div>
                        <input type="file" wire:model.live="files" name="files" id="fileInput" multiple style="display: none;">

                        <button class="border rounded p-1.5 px-2 md:px-4 flex text-sm items-center gap-x-4 bg-zinc-100 dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300" @click="Livewire.dispatch('reset-media', { media_id: null })" onclick="document.getElementById('fileInput').click();">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>

                            <span class="hidden md:flex"><?php echo e(__('livewire-filemanager::filemanager.add_a_file')); ?></span>
                        </button>
                    </div>

                    <div class="flex space-x-4 items-center">
                        <div class="flex items-center gap-x-2 max-h-[25px]">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((count($selectedFolders) + count($selectedFiles)) > 0): ?>
                                <div>
                                    <button @click="Livewire.dispatch('reset-media', { media_id: null })" class="border rounded p-1.5 border-red-600 text-white bg-red-500 dark:bg-red-600" wire:click="deleteItems">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="mx-2 px-2 dark:text-zinc-500">|</div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->currentFolder->id !== 1): ?>
                                <div>
                                    <button class="border rounded p-1.5 border-zinc-300 dark:border-zinc-600 dark:text-zinc-500" @click="Livewire.dispatch('reset-media', { media_id: null })" wire:click="navigateToParent">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 rtl:rotate-y-180">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="mx-2 px-2 dark:text-zinc-500">|</div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div>
                                <button class="border rounded p-1.5 border-zinc-300 dark:border-zinc-600 dark:text-zinc-500" @click="Livewire.dispatch('reset-media', { media_id: null })" wire:click="createNewFolder">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                    </svg>
                                </button>
                            </div>

                            <input wire:model.live="search" @click="Livewire.dispatch('reset-media', { media_id: null })" class="rounded border border-zinc-300 w-full py-2 px-3 zinc-500 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:me-2 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-500" type="search" placeholder="<?php echo e(__('livewire-filemanager::filemanager.search')); ?>...">
                        </div>
                    </div>
                </div>

                <div id="filemanager-area"
                    class="border-t border-zinc-300 shadow-inner overflow-x-hidden relative dark:border-zinc-700" x-bind:class="dropingFile ? 'bg-blue-50 dark:bg-zinc-900/90 border-dashed' : ''">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?>
                        <div class="px-4 sm:px-5 py-1 bg-gray-100 border-b border-zinc-300 text-sm dark:bg-zinc-900 dark:text-zinc-300 dark:border-zinc-700"><?php echo e((count($searchedFiles) + count($folders))); ?> <?php echo e(trans_choice('livewire-filemanager::filemanager.search_results', count($searchedFiles) + count($folders))); ?></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <template x-if="drawnArea">
                        <div class="drawn-area absolute z-10 border border-blue-300 bg-blue-100/60 dark:bg-blue-100/10 dark:border-gray-500/70" :style="{
                            left: drawnArea.left + 'px',
                            top: drawnArea.top + 'px',
                            width: drawnArea.width + 'px',
                            height: drawnArea.height + 'px'
                        }"></div>
                    </template>

                    <div
                    id="folder-container"
                    @mousedown="initiateDrawing($event)" 
                    @mousemove="draw($event)" 
                    @mouseup="stopDrawing()" 
                    @mouseleave="stopDrawing()"
                    x-on:drop="dropingFile = false"
                    x-on:drop.prevent="handleFileDrop($event)"
                    x-on:dragover.prevent="dropingFile = true"
                    x-on:dragleave.prevent="dropingFile = false"
                    x-on:dblclick.self="$wire.createNewFolder()"
                    x-on:click="handleContainerClick($event)"
                    class="p-2 pb-10 min-h-[500px] select-none overflow-y-auto flex relative flex-wrap content-start">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isCreatingNewFolder): ?>
                            <div class="cursor-pointer mb-4 max-w-[137px] min-w-[137px] max-h-[137px] min-h-[137px] items-start p-2 mx-1 text-center" @click.outside="$wire.saveNewFolder">
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

                                <input type="text" id="new-folder-name" wire:model="newFolderName" wire:keydown.enter="saveNewFolder" class="text-center w-full rounded py-0.5 px-1 text-sm dark:bg-zinc-800 dark:text-zinc-200">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newFolderName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-left text-xs leading-none text-red-500 overflow-hidden text-ellipsis line-clamp-4">
                                    <?php echo e($message); ?>

                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $folders->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal7e78eee28c6172a004746179f9852d74 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7e78eee28c6172a004746179f9852d74 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.elements.directory','data' => ['folder' => $folder,'selectedFolders' => $selectedFolders,'selectedFiles' => $selectedFiles,'key' => 'folder-' . $folder->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::elements.directory'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['folder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($folder),'selectedFolders' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedFolders),'selectedFiles' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedFiles),'key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('folder-' . $folder->id)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7e78eee28c6172a004746179f9852d74)): ?>
<?php $attributes = $__attributesOriginal7e78eee28c6172a004746179f9852d74; ?>
<?php unset($__attributesOriginal7e78eee28c6172a004746179f9852d74); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7e78eee28c6172a004746179f9852d74)): ?>
<?php $component = $__componentOriginal7e78eee28c6172a004746179f9852d74; ?>
<?php unset($__componentOriginal7e78eee28c6172a004746179f9852d74); ?>
<?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($searchedFiles): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $searchedFiles->sortBy('file_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalb6a795cbf1ddeff01db89aabb8c0b0ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6a795cbf1ddeff01db89aabb8c0b0ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.elements.media','data' => ['media' => $media,'selectedFiles' => $selectedFiles,'selectedFolders' => $selectedFolders,'key' => 'searched-file-' . $media->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::elements.media'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['media' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($media),'selectedFiles' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedFiles),'selectedFolders' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedFolders),'key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('searched-file-' . $media->id)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6a795cbf1ddeff01db89aabb8c0b0ee)): ?>
<?php $attributes = $__attributesOriginalb6a795cbf1ddeff01db89aabb8c0b0ee; ?>
<?php unset($__attributesOriginalb6a795cbf1ddeff01db89aabb8c0b0ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6a795cbf1ddeff01db89aabb8c0b0ee)): ?>
<?php $component = $__componentOriginalb6a795cbf1ddeff01db89aabb8c0b0ee; ?>
<?php unset($__componentOriginalb6a795cbf1ddeff01db89aabb8c0b0ee); ?>
<?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php else: ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $currentFolder->getMedia('medialibrary')->sortBy('file_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalb6a795cbf1ddeff01db89aabb8c0b0ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6a795cbf1ddeff01db89aabb8c0b0ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.elements.media','data' => ['media' => $media,'selectedFiles' => $selectedFiles,'selectedFolders' => $selectedFolders,'key' => 'file-' . $media->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::elements.media'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['media' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($media),'selectedFiles' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedFiles),'selectedFolders' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedFolders),'key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('file-' . $media->id)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6a795cbf1ddeff01db89aabb8c0b0ee)): ?>
<?php $attributes = $__attributesOriginalb6a795cbf1ddeff01db89aabb8c0b0ee; ?>
<?php unset($__attributesOriginalb6a795cbf1ddeff01db89aabb8c0b0ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6a795cbf1ddeff01db89aabb8c0b0ee)): ?>
<?php $component = $__componentOriginalb6a795cbf1ddeff01db89aabb8c0b0ee; ?>
<?php unset($__componentOriginalb6a795cbf1ddeff01db89aabb8c0b0ee); ?>
<?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="w-full absolute left-0 right-0 p-1 border-l-0 border-r-0 border -bottom-1" x-cloak x-show="uploading">
                        <div class="w-full flex mb-1">
                            <progress class="w-full" max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('livewire-filemanager.media-panel', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4120491409-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('livewire-filemanager.folder-panel', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4120491409-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('livewire-filemanager.rename-folder', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4120491409-2', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('livewire-filemanager.rename-file', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4120491409-3', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('livewire-filemanager.delete-items', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4120491409-4', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                </div>

                <nav class="select-none border-t text-sm px-4 sm:px-4 py-1.5 flex items-center border-zinc-300 dark:border-zinc-700 text-black dark:text-zinc-300">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <span 
                            x-data="{ isDragOver: false }"
                            class="cursor-pointer flex gap-x-1 items-center rounded px-2 py-1 transition-colors"
                            :class="{ 
                                'bg-blue-100 dark:bg-blue-900/50': isDragOver && <?php echo e($loop->last ? 'false' : 'true'); ?>

                            }"
                            <?php if(!$loop->last): ?>
                                x-on:dragover.prevent="
                                    if (!event.dataTransfer.types.includes('Files')) {
                                        event.dataTransfer.dropEffect = 'move';
                                        isDragOver = true;
                                    }
                                "
                                x-on:dragleave.prevent="isDragOver = false"
                                x-on:drop.prevent="
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
                                "
                            <?php endif; ?>
                            @click="Livewire.dispatch('reset-media', { media_id: null })" 
                            wire:click.prevent="navigateToBreadcrumb(<?php echo e($index); ?>)">
                            <?php if (isset($component)) { $__componentOriginalabd02e4dbe95666b35785201ce8e69c1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalabd02e4dbe95666b35785201ce8e69c1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.icons.folder','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::icons.folder'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
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
<?php endif; ?> <span><?php echo e($folder->name); ?></span>
                        </span>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$loop->last): ?>
                            <div class="px-2">
                                <?php if (isset($component)) { $__componentOriginalb343fb5fa7476047126e6629ff185e7b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb343fb5fa7476047126e6629ff185e7b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-filemanager::components.icons.chevron','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-filemanager::icons.chevron'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb343fb5fa7476047126e6629ff185e7b)): ?>
<?php $attributes = $__attributesOriginalb343fb5fa7476047126e6629ff185e7b; ?>
<?php unset($__attributesOriginalb343fb5fa7476047126e6629ff185e7b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb343fb5fa7476047126e6629ff185e7b)): ?>
<?php $component = $__componentOriginalb343fb5fa7476047126e6629ff185e7b; ?>
<?php unset($__componentOriginalb343fb5fa7476047126e6629ff185e7b); ?>
<?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </nav>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <style>
        .drag-hover {
            background-color: rgba(59, 130, 246, 0.2) !important;
            outline: 2px solid rgba(59, 130, 246, 0.4);
            outline-offset: -2px;
            transition: all 0.1s ease;
        }

        .dark .drag-hover {
            background-color: rgba(59, 130, 246, 0.3) !important;
            outline: 2px solid rgba(59, 130, 246, 0.5);
        }

        .drawn-area {
            pointer-events: none;
            transition: none;
        }
    </style>

    <script>
        function FilemanagerComponent() {
            return {
                uploading: false,
                progress: 0,
                dropingFile: false,
                isDrawing: false,
                startX: 0,
                startY: 0,
                drawnArea: null,
                hoveredElements: new Set(),
                wasDrawing: false,
                isDraggingItems: false,

                initiateDrawing(event) {
                    if (event.target.closest('.folder, .file')) {
                        return;
                    }

                    this.$wire.clearSelection();

                    const container = event.currentTarget;
                    const rect = container.getBoundingClientRect();

                    this.startX = event.clientX - rect.left;
                    this.startY = event.clientY - rect.top;

                    this.isDrawing = true;
                    this.drawnArea = {
                        left: this.startX,
                        top: this.startY,
                        width: 0,
                        height: 0
                    };
                },

                draw(event) {
                    if (!this.isDrawing) return;

                    const container = event.currentTarget;
                    const rect = container.getBoundingClientRect();

                    const currentX = event.clientX - rect.left;
                    const currentY = event.clientY - rect.top;

                    const width = currentX - this.startX;
                    const height = currentY - this.startY;

                    this.drawnArea.width = Math.abs(width);
                    this.drawnArea.height = Math.abs(height);

                    if (width < 0) {
                        this.drawnArea.left = currentX;
                    } else {
                        this.drawnArea.left = this.startX;
                    }

                    if (height < 0) {
                        this.drawnArea.top = currentY;
                    } else {
                        this.drawnArea.top = this.startY;
                    }

                    this.updateHoveredElements();
                },

                stopDrawing() {
                    if (this.isDrawing) {
                        this.wasDrawing = true;
                        this.selectElementsWithinDrawnArea();

                        this.hoveredElements.forEach(element => {
                            element.classList.remove('drag-hover');
                        });
                        this.hoveredElements.clear();

                        this.isDrawing = false;
                        this.drawnArea = null;
                    }
                },

                updateHoveredElements() {
                    const container = document.getElementById('folder-container');
                    const drawnRect = {
                        left: this.drawnArea.left,
                        top: this.drawnArea.top,
                        right: this.drawnArea.left + this.drawnArea.width,
                        bottom: this.drawnArea.top + this.drawnArea.height
                    };

                    this.hoveredElements.forEach(element => {
                        element.classList.remove('drag-hover');
                    });
                    this.hoveredElements.clear();

                    container.querySelectorAll('.folder, .file').forEach(element => {
                        const rect = element.getBoundingClientRect();
                        const containerRect = container.getBoundingClientRect();
                        const elementRect = {
                            left: rect.left - containerRect.left,
                            top: rect.top - containerRect.top,
                            right: rect.right - containerRect.left,
                            bottom: rect.bottom - containerRect.top
                        };

                        if (this.isElementWithinDrawnArea(drawnRect, elementRect)) {
                            element.classList.add('drag-hover');
                            this.hoveredElements.add(element);
                        }
                    });
                },

                selectElementsWithinDrawnArea() {
                    const container = document.getElementById('folder-container');
                    const drawnRect = {
                        left: this.drawnArea.left,
                        top: this.drawnArea.top,
                        right: this.drawnArea.left + this.drawnArea.width,
                        bottom: this.drawnArea.top + this.drawnArea.height
                    };

                    const selectedIds = { folders: [], files: [] };

                    container.querySelectorAll('.folder, .file').forEach(element => {
                        const rect = element.getBoundingClientRect();
                        const containerRect = container.getBoundingClientRect();
                        const elementRect = {
                            left: rect.left - containerRect.left,
                            top: rect.top - containerRect.top,
                            right: rect.right - containerRect.left,
                            bottom: rect.bottom - containerRect.top
                        };

                        if (this.isElementWithinDrawnArea(drawnRect, elementRect)) {
                            const id = parseInt(element.getAttribute('data-id'));
                            const type = element.classList.contains('folder') ? 'folders' : 'files';
                            selectedIds[type].push(id);
                        }
                    });

                    if (selectedIds.folders.length > 0 || selectedIds.files.length > 0) {
                        this.$wire.setSelection(selectedIds.folders, selectedIds.files);
                    }
                },

                isElementWithinDrawnArea(drawnRect, elementRect) {
                    const margin = 2;

                    return !(drawnRect.left > elementRect.right + margin ||
                             drawnRect.right < elementRect.left - margin ||
                             drawnRect.top > elementRect.bottom + margin ||
                             drawnRect.bottom < elementRect.top - margin);
                },

                handleContainerClick(event) {
                    if (!this.wasDrawing && event.target === event.currentTarget) {
                        this.$wire.clearSelection();
                    }
                    this.wasDrawing = false;
                },

                handleFileDrop(e) {
                    if (event.dataTransfer.files.length > 0) {
                        const files = e.dataTransfer.files;
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').uploadMultiple('files', files,
                            (uploadedFilename) => {}, () => {}, (event) => {}
                        )
                    }
                },
                
                handleDragStart(event) {
                    this.isDraggingItems = true;
                    document.querySelectorAll('.folder.selected, .file.selected').forEach(el => {
                        el.classList.add('opacity-50');
                    });
                },
                
                handleDragEnd(event) {
                    this.isDraggingItems = false;
                    document.querySelectorAll('.folder, .file').forEach(el => {
                        el.classList.remove('opacity-50');
                    });
                }
            };
        }

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('new-folder-created', function () {
                const checkExist = setInterval(function() {
                    let input = document.getElementById('new-folder-name');
                    input.focus();
                    input.select();

                    clearInterval(checkExist);
                }, 100);
            });

            Livewire.on('copy-link', function (event) {
                const link = decodeURIComponent(event.link);

                const showNotification = (message, bgColor, duration) => {
                    const notification = document.getElementById('copyNotification');
                    if (notification) {
                        notification.textContent = message;
                        notification.className = `top-0 text-white text-sm rounded px-3 p-2 mt-2 ${bgColor}`;
                        notification.classList.remove('hidden');
                        setTimeout(() => {
                            notification.classList.add('hidden');
                        }, duration);
                    }
                };

                if (window.isSecureContext) {
                    navigator.clipboard.writeText(link)
                        .then(() => {
                            showNotification(
                                "<?php echo e(__('livewire-filemanager::filemanager.actions.url_copy_pasted')); ?>",
                                'bg-green-500',
                                2000
                            );
                        })
                        .catch(() => {
                            showNotification(
                                "<?php echo e(__('livewire-filemanager::filemanager.actions.url_not_copy_pasted')); ?>",
                                'bg-red-500',
                                4000
                            );
                        });
                } else {
                    showNotification(
                        "<?php echo e(__('livewire-filemanager::filemanager.actions.url_not_copy_pasted')); ?>",
                        'bg-red-500',
                        4000
                    );
                }
            });
        });
    </script>
</div>
<?php /**PATH /Users/andrescruz/Herd/livewirestore/vendor/livewire-filemanager/filemanager/src/../resources/views/livewire/livewire-filemanager.blade.php ENDPATH**/ ?>