<?php

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Category;

new class extends Component
{
    use WithPagination;

    // public $categories;
    // function mount(){
    //     $this->categories = Category::all();    
    //     $this->categories = Category::paginate();    // NO funciona
    // }

    function with(): array{
        return [
            'categories' => Category::paginate(10)    
        ];
    }

    function delete(Category $category)  {
        $category->delete();
        $this->dispatch("deleted");
    }
};
?>

 <div>

    <x-action-message on="deleted">
        {{ __('Deleted category success') }}
    </x-action-message>


    <flux:button href="{{ route('d-category-create') }}" variant="primary">{{ __('Create') }}</flux:button>

    <h1>List</h1>
    <table class="table w-full">
        <thead>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $c)
                <tr>
                    <td>
                        {{ $c->title }}
                    </td>
                    <td>
                        
                        <flux:button href="{{ route('d-category-edit', $c) }}" variant="primary" size="sm">{{ __('Edit') }}</flux:button>
                        <flux:button onclick="confirm('{{ __('Are you sure you want to delete the selected record?') }}') || event.stopImmediatePropagation()" wire:click='delete({{ $c }})' variant="danger" size="sm">{{ __('Delete') }}</flux:button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {{$categories->links()}}
</div>