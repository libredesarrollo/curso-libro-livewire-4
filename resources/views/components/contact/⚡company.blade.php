<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\ContactCompany;

new class extends Component {

    use WithFileUploads;

    public ?ContactCompany $contactCompany = null;

    #[Validate('required|min:2|max:255')]
    public $name;

    #[Validate('nullable|max:255')]
    public $identification;

    #[Validate('nullable|email')]
    public $email;

    #[Validate('nullable')]
    public $extra;

    #[Validate('nullable')]
    public $choices;

    function submit()
    {
        $data = $this->validate();
        
        if($this->contactCompany){
            $this->contactCompany->update($data);
            $this->dispatch("updated");
        }else{
            $this->contactCompany = ContactCompany::create($data);
            $this->dispatch("created");
        }
    }

    function mount(?int $id = null){
        
        if($id){
            $this->contactCompany = ContactCompany::findOrFail($id);
            $this->name = $this->contactCompany->name;
            $this->identification = $this->contactCompany->identification;
            $this->email = $this->contactCompany->email;
            $this->extra = $this->contactCompany->extra;
            $this->choices = $this->contactCompany->choices;
        }
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ $contactCompany ? __('Edit ContactCompany') : __('New ContactCompany') }}</flux:heading>
    </div>

    <x-action-message on="created">
        {{ __('ContactCompany created successfully') }}
    </x-action-message>
    <x-action-message on="updated">
        {{ __('ContactCompany updated successfully') }}
    </x-action-message>

    <form wire:submit.prevent="submit" class="space-y-6">
        <flux:card>
            <flux:field>
                <flux:label>Name</flux:label>
                <flux:input wire:model="name" placeholder="Enter company name" />
                <flux:error name="name" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Identification</flux:label>
                <flux:input wire:model="identification" placeholder="Enter identification" />
                <flux:error name="identification" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Email</flux:label>
                <flux:input wire:model="email" type="email" placeholder="Enter email" />
                <flux:error name="email" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Extra</flux:label>
                <flux:textarea wire:model="extra" placeholder="Extra information" rows="2" />
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Choices</flux:label>
                <flux:textarea wire:model="choices" placeholder="Choices" rows="2" />
            </flux:field>
        </flux:card>

        <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
    </form>
</div>
