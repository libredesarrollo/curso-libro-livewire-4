<?php

use App\Livewire\Contact\BaseForm;
use App\Models\ContactCompany;
use Livewire\Attributes\Validate;

new class extends BaseForm
{
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

    protected function getModelClass(): string
    {
        return ContactCompany::class;
    }

    protected function getStepEventNumber(): int
    {
        return 3;
    }

    protected function setModelData($model = null): void
    {
        $this->name = $model?->name;
        $this->identification = $model?->identification;
        $this->email = $model?->email;
        $this->extra = $model?->extra;
        $this->choices = $model?->choices;
    }
};
?>

<div class="space-y-6">

    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ $model ? __('Edit ContactCompany') : __('New ContactCompany') }}</flux:heading>
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

        <div class="flex gap-2">
            <flux:button wire:click="$dispatch('stepEvent',[1])">Back</flux:button>
            <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
        </div>
    </form>
</div>
