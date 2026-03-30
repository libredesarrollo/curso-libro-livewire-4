<?php

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

    // V1
    protected $rules = [
        'title' => 'required|min:2|max:255',
        'slug' => 'required|min:2|max:255',
        'image' => "nullable|image|max:1024",
        'text' => 'nullable',
    ];

    function submit()
    {
        // V1
        // $this->validate();

        // V2
        // $this->validate([
        //     'title' => "required|min:2|max:255",
        //     'text' => "nullable",
        // ]);

        // V3 Attr
        // $this->validate();

        if($this->category){
            $this->category->update($this->validate());
            $this->dispatch("updated");
        }else{
            $this->category = Category::create($this->validate());
            $this->dispatch("created");
        }
        
        // upload
        if($this->image){
        // delete old img
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

    // public function boot()
    // {
    //     Log::info('boot');
    // }
    // public function booted()
    // {
    //     Log::info('booted');
    // }
    // public function rendered()
    // {
    //     Log::info('rendered');
    // }
    // public function rendering()
    // {
    //     Log::info('rendering');
    // }
    // public function mount()
    // {
    //     Log::info('mount');
    // }
    // public function hydrateTitle($value)
    // {
    //     Log::info("hydrateTitle $value");
    // }
    // public function dehydrateFoo($value)
    // {
    //     Log::info("dehydrateFoo $value");
    // }
    // public function hydrate()
    // {
    //     Log::info('hydrate');
    // }
    // public function dehydrate()
    // {
    //     Log::info('dehydrate');
    // }
    // public function updating($name, $value)
    // {
    //     Log::info("updating $name $value");
    // }
    // public function updated($name, $value)
    // {
    //     Log::info("updated $name $value");
    // }
    // public function updatingTitle($value)
    // {
    //     Log::info("updatingTitle $value");
    // }
    // public function updatedTitle($value)
    // {
    //     Log::info("updatedTitle $value");
    // }
};
?>

<div>
    <x-action-message on="created">
        {{ __('Created category success') }}
    </x-action-message>
    <x-action-message on="updated">
        {{ __('Updated category success') }}
    </x-action-message>

    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Category') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage...') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <form wire:submit.prevent="submit" class="my-6 w-full space-y-6">

        <flux:input label="Title" type="text" wire:model="title" />
        <flux:input label="Slug" type="text" wire:model="slug" />
        <flux:input label="Text" type="text" wire:model="text" />
        <flux:input label="Image" type="file" wire:model="image" />


        <flux:button type="submit" variant="primary">Send</flux:button>

        {{-- <label for="">Title</label>
        <input type="text" wire:model="title">
        <label for="">Text</label>
        <input type="text" wire:model="text">
        <button type="submit">Send</button> --}}
    </form>
</div>
