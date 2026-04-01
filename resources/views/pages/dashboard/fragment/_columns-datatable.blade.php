<flux:table.columns>
    <tr class="border-b">
        @foreach ($columns as $key => $label)
            <flux:table.column>
                <button wire:click="sort('{{ $key }}')" class="flex items-center gap-1">
                    {{ __($label) }}
                    @if ($sortColumn === $key)
                        <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                    @endif
                </button>
            </flux:table.column>
        @endforeach
        <flux:table.column align="end">{{ __('Actions') }}</flux:table.column>
    </tr>
</flux:table.columns>