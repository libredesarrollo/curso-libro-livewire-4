<?php

use App\Ai\Agents\PokemonAgent;
use Laravel\Ai\Streaming\Events\TextDelta;
use Livewire\Component;
 
new class extends Component
{
    public $start = 3;
 
    public function begin()
    {
        while ($this->start >= 0) {
      
            // Pause for 1 second between numbers...
            sleep(1);
 
            // Decrement the counter...
            $this->start = $this->start - 1;
        };
    }
}

?>

<div>
    <flux:button wire:click="begin">Start count-down</flux:button>

    <h1 class="text-center mt-4">Count: <span >{{ $start }}</span></h1> 
</div>