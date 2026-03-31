<?php

namespace App\Livewire\Contact;

use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;
use Livewire\Component;

abstract class BaseForm extends Component
{
    public ?int $parentId = null;

    public ?Model $model = null;

    abstract protected function getModelClass(): string;

    abstract protected function getStepEventNumber(): int;

    abstract protected function setModelData($model = null): void;

    public function submit(): void
    {
        $data = $this->validate();

        $data['contact_general_id'] = $this->parentId;

        $modelClass = $this->getModelClass();

        if ($this->model) {
            $this->model->update($data);
            $this->dispatch('updated');
        } else {
            $this->model = $modelClass::create($data);
            $this->dispatch('created');
        }

        $this->dispatch('stepEvent', $this->getStepEventNumber());
    }

    public function mount(?int $parentId = null): void
    {
        $this->setParentId($parentId);
    }

    #[On('parentId')]
    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;

        if ($this->parentId) {
            $modelClass = $this->getModelClass();
            $this->model = $modelClass::where('contact_general_id', $this->parentId)->first();
            $this->setModelData($this->model);
        }
    }
}
