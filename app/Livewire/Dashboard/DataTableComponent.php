<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;

abstract class DataTableComponent extends Component
{
    use WithPagination;

    public string $sortColumn = 'id';

    public string $sortDirection = 'desc';

    public function sort(string $column): void
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    abstract protected function getAllFilters(): array;

    abstract protected function getModelClass(): string;
}