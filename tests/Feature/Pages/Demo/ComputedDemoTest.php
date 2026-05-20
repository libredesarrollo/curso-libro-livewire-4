<?php

use Livewire\Livewire;

it('computed demo page can be rendered', function () {
    $response = $this->get(route('demo.computed'));

    $response->assertOk();
});

it('calculates the correct initial stats', function () {
    Livewire::test('pages::demo.computed-demo')
        ->assertSet('stats.total', 5)
        ->assertSet('stats.completed', 2)
        ->assertSet('stats.pending', 3)
        ->assertSet('stats.percentage', 40);
});

it('filters tasks when searching', function () {
    Livewire::test('pages::demo.computed-demo')
        ->set('search', 'Aprender')
        ->assertSet('stats.total', 1)
        ->assertSee('Aprender sintaxis básica de Livewire 4')
        ->assertDontSee('Dominar Propiedades Computadas');
});

it('toggles a task completed status and updates stats', function () {
    Livewire::test('pages::demo.computed-demo')
        // Task 3 ("Dominar Propiedades Computadas") has completed: false
        ->call('toggleTodo', 3)
        ->assertSet('stats.completed', 3)
        ->assertSet('stats.percentage', 60);
});
