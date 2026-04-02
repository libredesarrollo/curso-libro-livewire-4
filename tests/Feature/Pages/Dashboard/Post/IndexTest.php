<?php

use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

test('dashboard post index page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-post-index'));

    $response->assertOk();
});

test('renders the dashboard post index with posts', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.post.index')
        ->assertSee($post->title);
});
