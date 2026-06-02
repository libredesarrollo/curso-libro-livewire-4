<?php

use Livewire\Component;

use Livewire\Attributes\Layout;

new #[Layout('layouts.web')] class extends Component {
    public bool $showModal = false;

    public function openModal(): void
    {
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }
};
?>

<div>
<div class="p-8" wire:name="teleport">
    <flux:heading size="xl" class="mb-4">Ejemplo simple de x-teleport</flux:heading>

    <flux:text class="mb-4">
        El contenido teleportado aparece al final del body, NO donde se define aquí.
    </flux:text>

    <button class="btn" >asas</button>

    <flux:button wire:click="openModal" variant="primary">
        Abrir modal teleportado
    </flux:button>

    <flux:text class="mt-4 text-gray-500">
        Abre las herramientas del navegador (F12) → pestaña Elements y busca "MODAL TELEPORTED" al final del &lt;body&gt;
    </flux:text>
</div>

{{-- Este contenido SE TELEPORTARÁ al <body> --}}
    @teleport('body')
{{-- <template x-teleport="body"> --}}
    <div 
        x-show="$wire.showModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div class="bg-white dark:bg-gray-500 p-6 rounded-lg shadow-xl max-w-md">
            <flux:heading size="lg" class="mb-2">MODAL TELEPORTED</flux:heading>
            <flux:text class="mb-4">
                Este modal está en el body aunque se definió aquí dentro.
                Mira en las DevTools al final del &lt;body&gt; para verificar.
            </flux:text>
            <flux:button wire:click="closeModal" variant="primary">
                Cerrar
            </flux:button>
        </div>
    </div>
    @endteleport
{{-- </template> --}}

</div>