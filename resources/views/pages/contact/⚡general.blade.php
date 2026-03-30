<?php

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

use App\Models\ContactGeneral;
use App\Models\Category;
use App\Models\Tag;

#[On('stepEvent')]
new class extends Component {
    use WithFileUploads;

    public $step = 1;

    #[Validate('required|min:2|max:255')]
    public $subject;

    #[Validate('required|min:2|max:255')]
    public $message;

    #[Validate('required')]
    public $type = 'person';

    public $contactGeneral;

    //protected $listeners=['stepEvent']; // #[On('stepEvent')]

    //************EVENTO */
    public function stepEvent($step)
    {
        $this->step = $step;
    }

    function submit()
    {
        $data = $this->validate();

        if ($this->contactGeneral) {
            $this->contactGeneral->update($data);
            $this->dispatch('updated');
        } else {
            $this->contactGeneral = ContactGeneral::create($data);
            $this->dispatch('created');
        }
    }

    function mount(?int $id = null)
    {
        if ($id) {
            $this->contactGeneral = ContactGeneral::findOrFail($id);
            $this->subject = $this->contactGeneral->subject;
            $this->message = $this->contactGeneral->message;
            $this->type = $this->contactGeneral->type;
        }
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        {{-- <flux:heading level="1">{{ $contactGeneral ? __('Edit ContactGeneral') : __('New ContactGeneral') }}</flux:heading> --}}
        {{-- <flux:button href="{{ route('d-contactGeneral-index') }}" variant="ghost">{{ __('Back') }}</flux:button> --}}
    </div>

    <x-action-message on="created">
        {{ __('ContactGeneral created successfully') }}
    </x-action-message>
    <x-action-message on="updated">
        {{ __('ContactGeneral updated successfully') }}
    </x-action-message>

    @if ($step == 1)
        <form wire:submit.prevent="submit" class="space-y-6">
            <flux:card>
                <flux:field>
                    <flux:label>Title</flux:label>
                    <flux:input wire:model="subject" placeholder="Enter contactGeneral subject" />
                    <flux:error name="subject" />
                </flux:field>

                <flux:field class="mt-4">
                    <flux:label>Type</flux:label>
                    <flux:select wire:model="type" placeholder="Select Type">
                        <flux:select.option value="person">
                            {{ __('Person') }}
                        </flux:select.option>
                        <flux:select.option value="company">
                            {{ __('Company') }}
                        </flux:select.option>
                    </flux:select>
                    <flux:error name="type" />
                </flux:field>

                <flux:field class="mt-4">
                    <flux:label>Message</flux:label>
                    <flux:textarea wire:model="message" placeholder="Message" rows="2" />
                </flux:field>
            </flux:card>
            <flux:button type="submit" variant="primary" class="w-full">{{ __('Save') }}</flux:button>
        </form>
    @elseif ($step == 2)
        <livewire:contact.company />
    @elseif ($step == 2.5)
        <livewire:contact.person />
    @elseif ($step == 3)
        <livewire:contact.detail />
    @else
        END
    @endif
</div>
