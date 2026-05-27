<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
   
    public $text1 = "";
    public $text2 = "";

    public function leaving()
    {
        $this->text1 = "leaving";
    }

    public function enter()
    {
        $this->text2 = "enter";
    }
}
?>

<div>

    <!-- Runs when entering viewport (default) -->
<div style="height: 1000px" class="w-full bg-amber-500" wire:intersect:leave="leaving">
     <h1 class="text-5xl font-bold mb-4">{{ $text1 }}</h1>
     <h1 class="text-5xl font-bold mb-4">{{ $text2 }}</h1>
</div>
 
<!-- Runs when entering viewport (explicit) -->
<div style="height: 1000px" class="w-full bg-blue-500"  wire:intersect:enter="enter"> 
     <h1 class="text-5xl font-bold mb-4">{{ $text1 }}</h1>
     <h1 class="text-5xl font-bold mb-4">{{ $text2 }}</h1>
</div>
<div style="height: 1000px" class="w-full bg-red-500" > 
     <h1 class="text-5xl font-bold mb-4">{{ $text1 }}</h1>
     <h1 class="text-5xl font-bold mb-4">{{ $text2 }}</h1>
</div>
 
<!-- Runs when leaving viewport -->
<!-- <div style="height: 1000px" class="w-full bg-red-500" wire:intersect:leave="pauseVideo">...</div> -->
</div>