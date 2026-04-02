<?php

use App\Livewire\Blog\Index;
use App\Models\Post;
use Livewire\Livewire;

it('has blog index page', function () {
    $response = $this->get('/blog');

    $response->assertStatus(200);
});

test('renders the index page and has posts', function () {
    Livewire::test('pages::blog.index')
        ->assertSee('Blog');
});