<?php

use App\Models\Tag;
use App\Models\User;
use Livewire\Livewire;

test('dashboard tag index page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-tag-index'));

    $response->assertOk();
});

test('renders the dashboard tag index with tags', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.tag.index')
        ->assertSee($tag->title);
});

test('dashboard tag create page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-tag-create'));

    $response->assertOk();
});

test('dashboard tag edit page can be rendered', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-tag-edit', $tag->id));

    $response->assertOk();
});

test('can create a new tag', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.tag.save')
        ->set('title', 'Test Tag')
        ->set('slug', 'test-tag')
        ->call('submit')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('tags', [
        'title' => 'Test Tag',
        'slug' => 'test-tag',
    ]);
});

test('can update an existing tag', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.tag.save', ['id' => $tag->id])
        ->set('title', 'Updated Tag')
        ->call('submit')
        ->assertHasNoErrors();

    $tag->refresh();
    expect($tag->title)->toBe('Updated Tag');
});
