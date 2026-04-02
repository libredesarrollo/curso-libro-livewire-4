<?php

use Livewire\Attributes\Lazy;
use Livewire\Component;
use App\Models\Post;

#[Lazy]
new class extends Component {
    public function render()
    {
        $recentPosts = Post::latest()->take(5)->get();
        
        return view('livewire.dashboard.island.lazy-component', [
            'recentPosts' => $recentPosts,
        ]);
    }
};
