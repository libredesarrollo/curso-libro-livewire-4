<?php

use Livewire\Component;
use App\Models\Post;

use Livewire\Attributes\Layout;

new #[Layout('layouts.web')] class extends Component {
    public $likes;

    public function mount()
    {
        $this->likes = 5;
    }

    public function like()
    {
        $this->likes++;
    }
};
?>

<div>
    <flux:button x-on:click="$wire.likes++" wire:click="like">❤️ Like</flux:button>

    <ul>
        <li>
            Likes wire-text: <span wire:text="likes"></span>
        </li>
        <li>
            Likes Blade: {{ $likes }}
        </li>
    </ul>
</div>
