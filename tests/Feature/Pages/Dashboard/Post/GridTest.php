<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

test('dashboard post grid page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-post-grid'));

    $response->assertOk();
});

test('renders the dashboard post grid with posts', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for(Category::factory())->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.post.grid')
        ->assertSee($post->title);
});
