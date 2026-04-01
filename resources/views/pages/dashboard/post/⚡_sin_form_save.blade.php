<?php

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

new class extends Component {

    use WithFileUploads;

    #[Validate('required|min:2|max:255')]
    public $title;

    #[Validate('required|min:2|max:255')]
    public $slug;

    #[Validate('required')]
    public $date;

    #[Validate('nullable')]
    public $text;

    #[Validate('nullable')]
    public $description;

    #[Validate('nullable|image|max:2048')]
    public $image;

    #[Validate('required')]
    public $posted = 'not';

    #[Validate('required')]
    public $type = 'post';

    #[Validate('required|exists:categories,id')]
    public $category_id;

    public $post;
    public $categories = [];
    public $types = ['advert', 'post','course','movie'];

    function submit()
    {
        $data = $this->validate();
        
        if($this->post){
            $this->post->update($data);
            $this->dispatch("updated");
        }else{
            $this->post = Post::create($data);
            $this->dispatch("created");
        }
        
        if($this->image){
            if($this->post->image){
                Storage::disk('public_upload')
                    ->delete('images/post/'.$this->post->image);
            }
            $imageName = $this->post->slug . '.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('images/post',$imageName,'public_upload');
            $this->post->update([
                'image' => $imageName
            ]);
        }
        return $this->redirectRoute('d-post-index');
        // return redirect()->route('d-post-index');
    }

    function mount(?int $id = null){
        $this->categories = Category::all()->toArray();
        
        if($id){
            $this->post = Post::findOrFail($id);
            $this->title = $this->post->title;
            $this->slug = $this->post->slug;
            $this->date = $this->post->date;
            $this->text = $this->post->text;
            $this->description = $this->post->description;
            $this->posted = $this->post->posted;
            $this->type = $this->post->type;
            $this->category_id = $this->post->category_id;
        }else{
            $this->date = now()->format('Y-m-d');
        }
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ $post ? __('Edit Post') : __('New Post') }}</flux:heading>
        <flux:button href="{{ route('d-post-index') }}" variant="ghost">{{ __('Back') }}</flux:button>
    </div>

    <x-action-message on="created">
        {{ __('Post created successfully') }}
    </x-action-message>
    <x-action-message on="updated">
        {{ __('Post updated successfully') }}
    </x-action-message>

    <form wire:submit.prevent="submit" class="space-y-6">
        <flux:card>
            <flux:field>
                <flux:label>Title</flux:label>
                <flux:input wire:model="title" placeholder="Enter post title" />
                <flux:error name="title" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Slug</flux:label>
                <flux:input wire:model="slug" placeholder="post-slug" />
                <flux:error name="slug" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Date</flux:label>
                <flux:input type="date" wire:model="date" />
                <flux:error name="date" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Category</flux:label>
                <flux:select wire:model="category_id" placeholder="Select a category">
                    @foreach($categories as $category)
                        <flux:select.option value="{{ $category['id'] }}">
                            {{ $category['title'] }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="category_id" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Type</flux:label>
                <flux:select wire:model="type">
                    @foreach($types as $t)
                        <flux:select.option value="{{ $t }}">
                            {{ ucfirst($t) }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="type" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Description</flux:label>
                <flux:textarea wire:model="description" placeholder="Short description" rows="2" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Content</flux:label>
                <flux:textarea wire:model="text" placeholder="Post content" rows="6" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Image</flux:label>
                <flux:input type="file" wire:model="image" />
                <flux:error name="image" />
            </flux:field>

            @if($post?->image)
                <div class="mt-4">
                    <flux:label>Current Image</flux:label>
                    <img src="{{ asset('images/post/'.$post->image) }}" alt="" class="mt-2 h-20 w-20 rounded-lg object-cover">
                </div>
            @endif

            <flux:field class="mt-4">
                <flux:checkbox wire:model="posted" />
                <flux:label>Published</flux:label>
            </flux:field>
        </flux:card>

        <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
    </form>
</div>
