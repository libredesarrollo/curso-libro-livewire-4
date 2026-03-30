<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\ContactDetail;

new class extends Component {

    use WithFileUploads;

    public ?ContactDetail $contactDetail = null;

    #[Validate('nullable')]
    public $extra;

    function submit()
    {
        $data = $this->validate();
        
        if($this->contactDetail){
            $this->contactDetail->update($data);
            $this->dispatch("updated");
        }else{
            $this->contactDetail = ContactDetail::create($data);
            $this->dispatch("created");
        }
    }

    function mount(?int $id = null){
        
        if($id){
            $this->contactDetail = ContactDetail::findOrFail($id);
            $this->extra = $this->contactDetail->extra;
        }
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ $contactDetail ? __('Edit ContactDetail') : __('New ContactDetail') }}</flux:heading>
    </div>

    <x-action-message on="created">
        {{ __('ContactDetail created successfully') }}
    </x-action-message>
    <x-action-message on="updated">
        {{ __('ContactDetail updated successfully') }}
    </x-action-message>

    <form wire:submit.prevent="submit" class="space-y-6">
        <flux:card>
            <flux:field>
                <flux:label>Extra</flux:label>
                <flux:textarea wire:model="extra" placeholder="Extra information" rows="4" />
            </flux:field>
        </flux:card>

        <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
    </form>
</div>
