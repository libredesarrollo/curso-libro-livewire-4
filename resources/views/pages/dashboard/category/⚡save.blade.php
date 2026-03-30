<?php

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\Category;

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

    public $category;

    protected $rules = [
        'title' => 'required|min:2|max:255',
        'slug' => 'required|min:2|max:255',
        'image' => "nullable|image|max:1024",
        'text' => 'nullable',
    ];

    function submit()
    {
        if($this->category){
            $this->category->update($this->validate());
            $this->dispatch("updated");
        }else{
            $this->category = Category::create($this->validate());
            $this->dispatch("created");
        }
        
        if($this->image){
            if($this->category->image){
                Storage::disk('public_upload')
                    ->delete('images/category/'.$this->category->image);
            }
            $imageName = $this->category->slug . '.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('images/category',$imageName,'public_upload');
            $this->category->update([
                'image' => $imageName
            ]);
        }
    }

    function mount(?int $id = null){
        if($id){
            $this->category = Category::findOrFail($id);
            $this->title = $this->category->title;
            $this->slug = $this->category->slug;
            $this->text = $this->category->text;
        }
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ $category ? __('Edit Category') : __('New Category') }}</flux:heading>
        <flux:button href="{{ route('d-category-index') }}" variant="ghost">{{ __('Back') }}</flux:button>
    </div>

    <x-action-message on="created">
        {{ __('Category created successfully') }}
    </x-action-message>
    <x-action-message on="updated">
        {{ __('Category updated successfully') }}
    </x-action-message>

    <form wire:submit.prevent="submit" class="space-y-6">
        <flux:card>
            <flux:field>
                <flux:label>Title</flux:label>
                <flux:input wire:model="title" placeholder="Enter category title" />
                <flux:error name="title" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Slug</flux:label>
                <flux:input wire:model="slug" placeholder="category-slug" />
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

            @if($category?->image)
                <div class="mt-4">
                    <flux:label>Current Image</flux:label>
                    <img src="{{ asset('images/category/'.$category->image) }}" alt="" class="mt-2 h-20 w-20 rounded-lg object-cover">
                </div>
            @endif
        </flux:card>

        <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
    </form>
</div>
