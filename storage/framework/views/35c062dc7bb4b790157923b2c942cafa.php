
<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($toolbar)): ?>
        
        <div class="lgrid-toolbar-host mb-2">
            <?php echo e($toolbar); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div wire:ignore>
        <div data-lgrid tabindex="0" class="lgrid">
            
            <script type="application/json" data-lgrid-config><?php echo json_encode($config, 15, 512) ?></script>

            
            <div data-lgrid-ref="toolbar" class="lgrid-toolbar" hidden></div>

            <div data-lgrid-ref="scroll" class="lgrid-scroll">
                <div data-lgrid-ref="head" class="lgrid-head"></div>
                <div data-lgrid-ref="body" class="lgrid-rows lgrid-rows--cv"></div>
                <div data-lgrid-ref="footer" class="lgrid-footer" hidden></div>

                
                <div data-lgrid-ref="loading" class="lgrid-loading" hidden aria-hidden="true">
                    <span class="lgrid-loading-spinner"></span>
                </div>

                
                <div data-lgrid-ref="editor" class="lgrid-cell-editor" hidden></div>
            </div>

            
            <div data-lgrid-ref="popup" class="lgrid-popup" hidden></div>

            
            <div data-lgrid-ref="pagination" class="lgrid-pagination" hidden></div>

            
            <div data-lgrid-ref="statusbar" class="lgrid-statusbar" hidden></div>

            
            <div class="lgrid-syncbar" role="status" aria-live="polite">
                <span data-lgrid-ref="syncStatus">Saved</span>
                <button data-lgrid-ref="syncRetry" type="button" class="lgrid-sync-retry" hidden>
                    <?php echo e(__('Retry now')); ?>

                </button>
            </div>

            
            <div class="lgrid-errorbar">
                <span class="lgrid-errorbar-icon" aria-hidden="true">!</span>
                <button data-lgrid-ref="errorReview" type="button" class="lgrid-error-review"
                        aria-expanded="false" hidden>
                    <span data-lgrid-ref="errorCount" class="lgrid-errorbar-count">0</span>
                    <span><?php echo e(__('errors — Review')); ?></span>
                </button>
                <button data-lgrid-ref="errorPrev" type="button" class="lgrid-error-nav"
                        aria-label="<?php echo e(__('Previous grid error')); ?>">↑</button>
                <button data-lgrid-ref="errorNext" type="button" class="lgrid-error-nav"
                        aria-label="<?php echo e(__('Next grid error')); ?>">↓</button>
            </div>
            <div data-lgrid-ref="errorPanel" class="lgrid-error-panel" role="region"
                 aria-label="<?php echo e(__('Grid validation errors')); ?>" hidden>
                <ol data-lgrid-ref="errorList" class="lgrid-error-list"></ol>
            </div>

            
            <div data-lgrid-ref="draftBar" class="lgrid-draftbar" role="status" hidden>
                <span data-lgrid-ref="draftMessage"></span>
                <button data-lgrid-ref="draftRestore" type="button"><?php echo e(__('Restore')); ?></button>
                <button data-lgrid-ref="draftDiscard" type="button"><?php echo e(__('Discard')); ?></button>
            </div>

            
            <div data-lgrid-ref="announcer" class="lgrid-sr-only" aria-live="polite" aria-atomic="true"></div>

            
            <template data-lgrid-ref="emptyTemplate">
                <div class="lgrid-empty"><?php echo e(__('No rows to display.')); ?></div>
            </template>
        </div>
    </div>
</div>
<?php /**PATH /Users/andrescruz/Herd/livewirestore/vendor/unnathianalytics/laragrid/src/../resources/views/datagrid.blade.php ENDPATH**/ ?>