<?php

use Livewire\Livewire;

it('has blog index page', function () {
    $response = $this->get('/blog');

    $response->assertStatus(200);
});

it('renders the index page and has posts', function () {
    Livewire::test('pages::blog.index')
        ->assertSee('Blog');
});
