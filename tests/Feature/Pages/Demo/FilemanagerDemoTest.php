<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use LivewireFilemanager\Filemanager\Livewire\LivewireFilemanagerComponent;
use LivewireFilemanager\Filemanager\Models\Folder;

it('filemanager demo page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('demo.filemanager'));

    $response->assertOk();
    $response->assertSeeLivewire('livewire-filemanager');
});

it('can upload files through the filemanager component', function () {
    $user = User::factory()->create();

    $rootFolder = Folder::create([
        'name' => 'Root',
        'slug' => 'root',
        'parent_id' => null,
    ]);

    session(['currentFolderId' => $rootFolder->id]);

    $file = UploadedFile::fake()->image('avatar.png');

    Livewire::actingAs($user)
        ->test(LivewireFilemanagerComponent::class)
        ->set('files', [$file]);
});
