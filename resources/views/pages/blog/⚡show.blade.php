<?php

use Livewire\Component;

use Livewire\Attributes\Layouts;

use App\Models\Post;
use App\Models\Category;

new #[Layout('layouts.web')]  class extends Component
{
    public Post $post;

    function mount(Post $post){
        $this->post = $post;
    }
};
?>

<div>
    <flux:card class="mx-auto">
        <h1 class="text-6xl">{{ $post->title }}</h1>

        <p class="my-4 ml-2">
            <span
                class="text-sm text-gray-500 italic font-bold uppercase tracking-widest">{{ $post->date->format('d-m-Y') }}</span>

            <a class="ml-4 rounded-md bg-purple-500 py-1 px-2 text-white"
                href="{{ route('web.index', ['category_id' => $post->category->id]) }}">
                {{ $post->category->title }}
            </a>

            <a class="ml-4 rounded-md bg-purple-500 py-1 px-2 text-white"
                href="{{ route('web.index', ['type' => $post->type]) }}">
                {{ $post->type }}
            </a>
        </p>

        <div>{!! $post->text !!}</div>

        <hr class="my-8">

        {{-- @livewire('contact.general', ['subject' => "#$post->id - "]) --}}
    </flux:card>

</div>