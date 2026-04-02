<?php

use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

it('shop cart page can be rendered', function () {
    $response = $this->get(route('shop.cart.list'));

    $response->assertOk();
});

it('renders the shop cart page', function () {
    Livewire::test('pages::shop.cart')
        ->assertSee('Carrito');
});

it('can add item to cart when authenticated', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    $this->actingAs($user);

    Livewire::test('pages::shop.cart', ['post' => $post, 'type' => 'add'])
        ->call('addItem')
        ->assertDispatched('addItemToCart');
});
