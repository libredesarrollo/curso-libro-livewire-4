<?php

use App\Models\User;
use Livewire\Livewire;

it('filemanager demo page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('demo.filemanager'));

    $response->assertOk();
    $response->assertSeeLivewire('livewire-filemanager');
});
