<?php

namespace App\Livewire;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class DemoLazy extends Component
{
    public function render()
    {
        sleep(3);

        return view('livewire.demo-lazy');
    }
}
