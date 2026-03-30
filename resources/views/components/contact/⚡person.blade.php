<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\ContactPerson;

new class extends Component {

    use WithFileUploads;

    public ?ContactPerson $contactPerson = null;

    #[Validate('required|min:2|max:255')]
    public $name;

    #[Validate('nullable|max:255')]
    public $surname;

    #[Validate('nullable')]
    public $choices;

    #[Validate('nullable')]
    public $other;

    function submit()
    {
        $data = $this->validate();
        
        if($this->contactPerson){
            $this->contactPerson->update($data);
            $this->dispatch("updated");
        }else{
            $this->contactPerson = ContactPerson::create($data);
            $this->dispatch("created");
        }
    }

    function mount(?int $id = null){
        
        if($id){
            $this->contactPerson = ContactPerson::findOrFail($id);
            $this->name = $this->contactPerson->name;
            $this->surname = $this->contactPerson->surname;
            $this->choices = $this->contactPerson->choices;
            $this->other = $this->contactPerson->other;
        }
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ $contactPerson ? __('Edit ContactPerson') : __('New ContactPerson') }}</flux:heading>
    </div>

    <x-action-message on="created">
        {{ __('ContactPerson created successfully') }}
    </x-action-message>
    <x-action-message on="updated">
        {{ __('ContactPerson updated successfully') }}
    </x-action-message>

    <form wire:submit.prevent="submit" class="space-y-6">
        <flux:card>
            <flux:field>
                <flux:label>Name</flux:label>
                <flux:input wire:model="name" placeholder="Enter name" />
                <flux:error name="name" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Surname</flux:label>
                <flux:input wire:model="surname" placeholder="Enter surname" />
                <flux:error name="surname" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Choices</flux:label>
                <flux:textarea wire:model="choices" placeholder="Choices" rows="2" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Other</flux:label>
                <flux:textarea wire:model="other" placeholder="Other information" rows="2" />
            </flux:field>
        </flux:card>

        <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
    </form>
</div>
