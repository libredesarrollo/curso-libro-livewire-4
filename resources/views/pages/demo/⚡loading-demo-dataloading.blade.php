<?php

use Livewire\Attributes\On;
use Livewire\Component;

use Livewire\Attributes\Layout;

new #[Layout('layouts.web')] class extends Component {
    public array $users = [
        ['id' => 1, 'name' => 'John Doe'],
        ['id' => 2, 'name' => 'Jane Smith'],
        ['id' => 3, 'name' => 'Bob Johnson']
    ];

    public function refreshUsers()
    {
        sleep(2);
    }

    public function deleteUser(int $id)
    {
        sleep(2);
        $this->users = array_filter($this->users, fn($u) => $u['id'] !== $id);
    }

    public function addUser()
    {
        sleep(2);
        $this->users[] = ['id' => count($this->users) + 1, 'name' => 'Nuevo Usuario'];
    }
}
?>

<div class="p-6 border rounded-lg shadow-sm bg-gray-400">
    <h2 class="text-xl font-bold mb-4">Demo de data-loading (Livewire v4)</h2>

    <div>
        <button wire:click="addUser" class="peer">
            Save
        </button>

        <span class="peer-data-loading:opacity-50">
            Saving...
        </span>
    </div>

    <div class="mb-8 p-4 border-l-4 border-blue-500 bg-blue-500">
        <h3 class="font-semibold text-blue-700">1. Botón con estado de carga automático</h3>
        <p class="text-sm text-gray-600 mb-3">
            Livewire añade automáticamente el atributo <code>data-loading</code> a los elementos que disparan requests.
        </p>

        <button wire:click="refreshUsers"
            class="data-loading:opacity-50 data-loading:scale-95 bg-blue-500 text-white px-4 py-2 rounded transition-all">
            Refrescar Todo
        </button>

        <div class="mt-3 p-3 bg-yellow-600 border border-yellow-200 rounded text-sm">
            <strong>Nota:</strong> No necesitas <code>wire:loading</code>. El botón se vuelve semitransparente
            automáticamente gracias al prefijo <code>data-loading:</code> en Tailwind.
        </div>
    </div>

    <div class="p-4 border-l-4 border-green-500 bg-green-500">
        <h3 class="font-semibold text-green-700 mb-4">2. Botón con spinner y deshabilitado</h3>

        <div class="mb-6">
            <button wire:click="addUser" wire:loading.attr="disabled" wire:target="addUser"
                class="bg-green-600 disabled:opacity-50 data-loading:cursor-not-allowed text-white px-4 py-2 rounded flex items-center gap-2 transition-all">
                <span wire:loading.remove wire:target="addUser">➕ Añadir Usuario</span>
                <span wire:loading wire:target="addUser" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"
                            fill="none"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                        </path>
                    </svg>
                    Agregando...
                </span>
            </button>
        </div>

        <div class="bg-white dark:bg-gray-900 border rounded-xl p-4 shadow-sm">
            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4">Lista de usuarios</h4>

            <ul class="space-y-2">
                @foreach ($users as $user)
                    <li class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg"
                        wire:transition>
                        <span data-loading:opacity-50 data-loading:transition-all>
                            {{ $user['name'] }}
                        </span>

                        <button wire:click="deleteUser({{ $user['id'] }})" wire:loading.attr="disabled"
                            wire:target="deleteUser({{ $user['id'] }})"
                            class="data-loading:opacity-50 data-loading:cursor-not-allowed bg-red-100 text-red-600 px-3 py-1 rounded-md hover:bg-red-200 disabled:opacity-50 transition">
                            <span wire:loading wire:target="deleteUser({{ $user['id'] }})">
                                🗑️ Eliminando...
                            </span>

                            <span wire:loading.remove wire:target="deleteUser({{ $user['id'] }})">
                                Eliminar
                            </span>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mt-8 p-4 border-l-4 border-purple-500 bg-purple-50">
        <h3 class="font-semibold text-purple-700 mb-3">3. Ejemplo de formulario</h3>

        <form wire:submit.prevent="addUser" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700! mb-1">Nombre</label>
                <input type="text" wire:model="newName" placeholder="Escribe un nombre..."
                    class="data-loading:bg-gray-500 data-loading:text-gray-400 w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="bg-purple-600 disabled:opacity-50 data-loading:opacity-70 text-white px-4 py-2 rounded hover:bg-purple-700 transition-all">
                <span wire:loading.remove>Guardar</span>
                <span wire:loading>Guardando...</span>
            </button>
        </form>
    </div>



    <div class="mt-6 p-4 bg-gray-100 rounded-lg">
        <h4 class="font-semibold text-gray-700 mb-2">Diferencias clave:</h4>
        <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
            <li><code>wire:loading</code> → mostrar/ocultar elementos</li>
            <li><code>data-loading:...</code> → estilizar elementos con Tailwind durante el request</li>
            <li>No requiere <code>wire:target</code> con <code>data-loading</code></li>
            <li>Funciona automáticamente con eventos entre componentes</li>
            <li><code>has-data-loading:</code> → estilo en elemento padre</li>
            <li><code>in-data-loading:</code> → estilo en hijos</li>
            <li><code>peer-data-loading:</code> → estilo en hermanos</li>
            <li><code>not-data-loading:</code> → estilo cuando NO carga</li>
        </ul>
    </div>
</div>