<?php

use App\Livewire\Contact\BaseForm;
use App\Models\ContactDetail;
use App\Models\ContactGeneral;
use Livewire\Attributes\Validate;

new class extends BaseForm
{
    #[Validate('nullable')]
    public $extra;

    protected function getModelClass(): string
    {
        return ContactDetail::class;
    }

    protected function getStepEventNumber(): int
    {
        return 4;
    }

    protected function setModelData($model = null): void
    {
        $this->extra = $model?->extra;
    }

    public function back(): void
    {
        $contactGeneral = ContactGeneral::find($this->parentId);
        if ($contactGeneral->type == 'company') {
            $this->dispatch('stepEvent', 2);
        } elseif ($contactGeneral->type == 'person') {
            $this->dispatch('stepEvent', 2.5);
        }
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ $model ? __('Edit ContactDetail') : __('New ContactDetail') }}</flux:heading>
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

        <div class="flex gap-2">
            <flux:button wire:click="back()">Back</flux:button>
            <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
        </div>
    </form>
</div>
