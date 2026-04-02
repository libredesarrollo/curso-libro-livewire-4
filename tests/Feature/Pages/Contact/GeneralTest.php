<?php

use Livewire\Livewire;

it('contact page can be rendered', function () {
    $response = $this->get(route('general'));

    $response->assertOk();
});

it('renders the contact page', function () {
    Livewire::test('pages::contact.general')
        ->assertSee('STEP');
});

it('can create a new contact', function () {
    Livewire::test('pages::contact.general')
        ->set('subject', 'Test Subject')
        ->set('message', 'Test Message')
        ->set('type', 'person')
        ->call('submit')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('contact_generals', [
        'subject' => 'Test Subject',
        'message' => 'Test Message',
        'type' => 'person',
    ]);
});

it('validates required subject and message fields', function () {
    Livewire::test('pages::contact.general')
        ->set('type', '')
        ->call('submit')
        ->assertHasErrors(['subject', 'message', 'type']);
});
