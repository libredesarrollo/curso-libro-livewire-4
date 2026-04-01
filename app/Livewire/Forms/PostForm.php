<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post = null;

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

    public function setPost(Post $post)
    {
        $this->post = $post;
        // $this->title = $post->title;
        // $this->slug = $post->slug;
        // $this->date = $post->date;
        // $this->text = $post->text;
        // $this->description = $post->description;
        // $this->posted = $post->posted;
        // $this->type = $post->type;
        // $this->category_id = $post->category_id;

        $this->fill($post->only('title', 'description', 'slug', 'date', 'posted', 'type', 'category_id', 'text'));
    }

    public function store()
    {
        $data = $this->validate();

        if ($this->post) {
            // Post::create($this->only(['title', 'content'])); // si solo quieres algunos campos
            $this->post->update($data);
            // $this->dispatch("updated");
        } else {
            $this->post = Post::create($data);
            // $this->dispatch("created");
        }

        if ($this->image) {
            if ($this->post->image) {
                Storage::disk('public_upload')
                    ->delete('images/post/'.$this->post->image);
            }
            $imageName = $this->post->slug.'.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('images/post', $imageName, 'public_upload');
            $this->post->update([
                'image' => $imageName,
            ]);
        }

    }
}
