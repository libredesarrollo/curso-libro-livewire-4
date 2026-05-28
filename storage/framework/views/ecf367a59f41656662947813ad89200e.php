<?php
use Livewire\Attributes\On;
use Livewire\Component;
?>

<div>

    <!-- Runs when entering viewport (default) -->
<div style="height: 1000px" class="w-full bg-amber-500" wire:intersect:leave="leave">
     <h1 class="text-5xl font-bold mb-4"><?php echo e($text1); ?></h1>
     <h1 class="text-5xl font-bold mb-4"><?php echo e($text2); ?></h1>
</div>
 
<!-- Runs when entering viewport (explicit) -->
<div style="height: 1000px" class="w-full bg-blue-500"  wire:intersect:enter="enter"> 
     <h1 class="text-5xl font-bold mb-4"><?php echo e($text1); ?></h1>
     <h1 class="text-5xl font-bold mb-4"><?php echo e($text2); ?></h1>
</div>
<div style="height: 1000px" class="w-full bg-red-500" > 
     <h1 class="text-5xl font-bold mb-4"><?php echo e($text1); ?></h1>
     <h1 class="text-5xl font-bold mb-4"><?php echo e($text2); ?></h1>
</div>
 
<!-- Runs when leaving viewport -->
<!-- <div style="height: 1000px" class="w-full bg-red-500" wire:intersect:leave="pauseVideo">...</div> -->
</div><?php /**PATH /Users/andrescruz/Herd/livewirestore/storage/framework/views/livewire/views/652e7bf7.blade.php ENDPATH**/ ?>