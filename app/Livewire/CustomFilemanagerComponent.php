<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use LivewireFilemanager\Filemanager\Livewire\LivewireFilemanagerComponent;

class CustomFilemanagerComponent extends LivewireFilemanagerComponent
{
    public function updatedFiles()
    {
        $this->validate();

        foreach ($this->files as $file) {
            $this->currentFolder
                ->addMedia($file->getRealPath())
                ->usingName($file->getClientOriginalName())
                ->sanitizingFileName(function ($fileName) use ($file) {
                    // FIX: Get extension from the original client file name, not from the temporary file real path
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                    $slugifiedName = Str::slug($name);

                    return strtolower($slugifiedName.'.'.$extension);
                })
                ->withCustomProperties([
                    'user_id' => optional(Auth::user())->id,
                ])
                ->toMediaCollection('medialibrary');
        }

        $this->files = [];
    }
}
