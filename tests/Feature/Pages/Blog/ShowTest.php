<?php

use App\Models\Post;
use Livewire\Livewire;

it('has blog show page', function () {
    $post = Post::factory()->create();

    $response = $this->get(route('web.show', $post->slug));

    $response->assertStatus(200);
});

it('renders the blog show page with post', function () {
    $post = Post::factory()->create();

    Livewire::test('pages::blog.show', ['post' => $post])
        ->assertSee($post->title);
});
