<?php

use App\Livewire\Contact\BaseForm;
use App\Models\ContactPerson;
use Livewire\Attributes\Validate;

new class extends BaseForm
{
    #[Validate('required|min:2|max:255')]
    public $name;

    #[Validate('nullable|max:255')]
    public $surname;

    #[Validate('nullable')]
    public $choices;

    #[Validate('nullable')]
    public $other;

    protected function getModelClass(): string
    {
        return ContactPerson::class;
    }

    protected function getStepEventNumber(): int
    {
        return 3;
    }

    protected function setModelData($model = null): void
    {
        $this->name = $model?->name;
        $this->surname = $model?->surname;
        $this->choices = $model?->choices;
        $this->other = $model?->other;
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ $model ? __('Edit ContactPerson') : __('New ContactPerson') }}</flux:heading>
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
                <flux:select wire:model='choices'>
                    <option value=""></option>
                    <option value="advert">{{ __('Advert') }}</option>
                    <option value="post">{{ __('Post') }}</option>
                    <option value="course">{{ __('Course') }}</option>
                    <option value="movie">{{ __('Movie') }}</option>
                    <option value="other">{{ __('Other') }}</option>
                </flux:select>
            </flux:field>

            <flux:field class="mt-4">
                <flux:label>Other</flux:label>
                <flux:textarea wire:model="other" placeholder="Other information" rows="2" />
            </flux:field>
        </flux:card>

        <div class="flex gap-2">
            <flux:button wire:click="$dispatch('stepEvent',[1])">Back</flux:button>
            <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
        </div>
    </form>
</div>
