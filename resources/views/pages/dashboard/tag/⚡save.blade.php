<?php

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\Tag;

new class extends Component {

    use WithFileUploads;

    #[Validate('required|min:2|max:255')]
    public $title;

    #[Validate('required|min:2|max:255')]
    public $slug;

    #[Validate('nullable')]
    public $text;

    #[Validate('nullable|image|max:1024')]
    public $image;

    public $tag;

    function submit()
    {
        if($this->tag){
            $this->tag->update($this->validate());
            $this->dispatch("updated");
        }else{
            $this->tag = Tag::create($this->validate());
            $this->dispatch("created");
        }
        
        if($this->image){
            if($this->tag->image){
                Storage::disk('public_upload')
                    ->delete('images/tag/'.$this->tag->image);
            }
            $imageName = $this->tag->slug . '.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('images/tag',$imageName,'public_upload');
            $this->tag->update([
                'image' => $imageName
            ]);
        }
    }

    function mount(?int $id = null){
        if($id){
            $this->tag = Tag::findOrFail($id);
            $this->title = $this->tag->title;
            $this->slug = $this->tag->slug;
            $this->text = $this->tag->text;
        }
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ $tag ? __('Edit Tag') : __('New Tag') }}</flux:heading>
        <flux:button href="{{ route('d-tag-index') }}" variant="ghost">{{ __('Back') }}</flux:button>
    </div>

    <x-action-message on="created">
        {{ __('Tag created successfully') }}
    </x-action-message>
    <x-action-message on="updated">
        {{ __('Tag updated successfully') }}
    </x-action-message>

    <form wire:submit.prevent="submit" class="space-y-6">
        <flux:card>
            <flux:field>
                <flux:label>Title</flux:label>
                <flux:input wire:model="title" placeholder="Enter tag title" />
                <flux:error name="title" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Slug</flux:label>
                <flux:input wire:model="slug" placeholder="tag-slug" />
                <flux:error name="slug" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Description</flux:label>
                <flux:textarea wire:model="text" placeholder="Optional description" rows="3" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Image</flux:label>
                <flux:input type="file" wire:model="image" />
                <flux:error name="image" />
            </flux:field>

            @if($tag?->image)
                <div class="mt-4">
                    <flux:label>Current Image</flux:label>
                    <img src="{{ asset('images/tag/'.$tag->image) }}" alt="" class="mt-2 h-20 w-20 rounded-lg object-cover">
                </div>
            @endif
        </flux:card>

        <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
    </form>
</div>
