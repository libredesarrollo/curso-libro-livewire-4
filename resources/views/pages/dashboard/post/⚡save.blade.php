<?php

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Livewire\Forms\PostForm;

new class extends Component {

    use WithFileUploads;

    public PostForm $form;

    public $post;
    public $categories = [];
    public $types = ['advert', 'post','course','movie'];

    function mount(?int $id = null){
        $this->categories = Category::all()->toArray();
        
        if($id){
            $this->post = Post::findOrFail($id);
            $this->form->setPost($this->post);
        }else{
            $this->date = now()->format('Y-m-d');
        }
    }

    function submit()
    {
        // $data = $this->validate();
        $this->form->store();
        if($this->post){
            // $this->post->update($data);
            // si NO usas redireccion
            $this->dispatch("updated");
        }else{
            // $this->post = Post::create($data);
            // si NO usas redireccion
            $this->dispatch("created");
        }
        
        // si usas redireccion
        session()->flash('status', __('Post saved successfully'));

        return $this->redirectRoute('d-post-index', navigate:true);
        // return redirect()->route('d-post-index')->with('status', __('Post saved successfully'));
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
                <flux:input wire:model="form.title" placeholder="Enter post title" />
                <flux:error name="form.title" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Slug</flux:label>
                <flux:input wire:model="form.slug" placeholder="post-slug" />
                <flux:error name="form.slug" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Date</flux:label>
                <flux:input type="date" wire:model="form.date" />
                <flux:error name="form.date" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Category</flux:label>
                <flux:select wire:model="form.category_id" placeholder="Select a category">
                    @foreach($categories as $category)
                        <flux:select.option value="{{ $category['id'] }}">
                            {{ $category['title'] }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="form.category_id" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Type</flux:label>
                <flux:select wire:model="form.type">
                    @foreach($types as $t)
                        <flux:select.option value="{{ $t }}">
                            {{ ucfirst($t) }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="form.type" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Description</flux:label>
                <flux:textarea wire:model="form.description" placeholder="Short description" rows="2" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Content</flux:label>
                <flux:textarea wire:model="form.text" placeholder="Post content" rows="6" class="hidden!" />
                <div wire:ignore>
                    <div id="editor">
                        {!! $this->form->text !!}
                    </div>
                </div>
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Image</flux:label>
                <flux:input type="file" wire:model="form.image" />
                <flux:error name="form.image" />
            </flux:field>

            @if($post?->image)
                <div class="mt-4">
                    <flux:label>Current Image</flux:label>
                    <img src="{{ asset('images/post/'.$post->image) }}" alt="" class="mt-2 h-20 w-20 rounded-lg object-cover">
                </div>
            @endif

            <flux:field class="mt-4">
                <flux:checkbox wire:model="form.posted" />
                <flux:label>Published</flux:label>
            </flux:field>
        </flux:card>

        <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
    </form>
     @vite(['resources/js/ckeditor.js','resources/css/ckeditor.css'])
    @script
    <script>
        editor.model.document.on('change:data', () => {
            $wire.form.text = editor.getData()
        })
    </script>
    @endscript
</div>
