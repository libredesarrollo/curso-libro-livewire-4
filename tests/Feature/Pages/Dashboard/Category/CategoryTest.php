<?php

use App\Models\Category;
use App\Models\User;
use Livewire\Livewire;

test('dashboard category index page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-category-index'));

    $response->assertOk();
});

test('renders the dashboard category index with categories', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.category.index')
        ->assertSee($category->title);
});

test('dashboard category create page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-category-create'));

    $response->assertOk();
});

test('dashboard category edit page can be rendered', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('d-category-edit', $category->id));

    $response->assertOk();
});

test('can create a new category', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.category.save')
        ->set('title', 'Test Category')
        ->set('slug', 'test-category')
        ->call('submit')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('categories', [
        'title' => 'Test Category',
        'slug' => 'test-category',
    ]);
});

test('can update an existing category', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::dashboard.category.save', ['id' => $category->id])
        ->set('title', 'Updated Category')
        ->call('submit')
        ->assertHasNoErrors();

    $category->refresh();
    expect($category->title)->toBe('Updated Category');
});
