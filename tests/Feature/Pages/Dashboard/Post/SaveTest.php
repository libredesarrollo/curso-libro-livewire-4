<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

test('dashboard post create page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-post-create'));

    $response->assertOk();
});

test('dashboard post edit page can be rendered', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-post-edit', $post->id));

    $response->assertOk();
});

test('can create a new post', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.post.save')
        ->set('form.title', 'Test Post')
        ->set('form.slug', 'test-post')
        ->set('form.date', now()->format('Y-m-d'))
        ->set('form.description', 'Test description')
        ->set('form.posted', 'yes')
        ->set('form.type', 'post')
        ->set('form.category_id', $category->id)
        ->call('submit')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'title' => 'Test Post',
        'slug' => 'test-post',
        'posted' => 'yes',
    ]);
});

test('can update an existing post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();
    $category = Category::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.post.save', ['id' => $post->id])
        ->set('form.title', 'Updated Post')
        ->set('form.category_id', $category->id)
        ->call('submit')
        ->assertHasNoErrors();

    $post->refresh();
    expect($post->title)->toBe('Updated Post');
});
