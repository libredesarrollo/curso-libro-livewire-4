<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public array $users = [
        ['id' => 1, 'name' => 'John Doe'],
        ['id' => 2, 'name' => 'Jane Smith'],
        ['id' => 3, 'name' => 'Bob Johnson']
    ];

    #[On('refresh-users')]
    public function refreshUsers()
    {
        sleep(2); // Simula carga
    }

    public function deleteUser(int $id)
    {
        sleep(2); // Simula proceso lento
        $this->users = array_filter($this->users, fn ($u) => $u['id'] !== $id);
    }

    public function addUser()
    {
        sleep(2);
        $this->users[] = ['id' => count($this->users) + 1, 'name' => 'Nuevo Usuario'];
    }
}
?>

<div class="p-6 border rounded-lg shadow-sm bg-white">
    <h2 class="text-xl font-bold mb-4">Demo de Loading States Avanzado</h2>

    <div class="mb-8 p-4 border-l-4 border-yellow-500 bg-yellow-50">
        <h3 class="font-semibold text-yellow-700">1. Sin Target (Genérico)</h3>
        <button wire:click="refreshUsers" class="bg-blue-500 text-white px-4 py-2 rounded">
            Refrescar Todo
        </button>

        <div wire:loading class="mt-2 text-blue-600 font-bold italic">
            ⌛ Procesando algo en el servidor... (Salgo con CUALQUIER botón)
        </div>
    </div>

    <div class="p-4 border-l-4 border-green-500 bg-green-50">
        <h3 class="font-semibold text-green-700 mb-4">2. Targets Específicos y por ID</h3>
        
        <div class="mb-6">
            <button wire:click="addUser" 
                    wire:loading.attr="disabled" 
                    wire:target="addUser"
                    class="bg-green-600 disabled:opacity-50 text-white px-4 py-2 rounded">
                <span wire:loading.remove wire:target="addUser">➕ Añadir Usuario</span>
                <span wire:loading wire:target="addUser">Agregando...</span>
            </button>
        </div>

        <div class="bg-white dark:bg-gray-900 border rounded-xl p-4 shadow-sm">
            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4">Lista de usuarios</h4>

            <ul class="space-y-2">
                @foreach ($users as $user)
                    <li class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <span wire:loading.class="opacity-50" wire:target="deleteUser({{ $user['id'] }})">
                            {{ $user['name'] }}
                        </span>

                        <button 
                            wire:click="deleteUser({{ $user['id'] }})" 
                            wire:loading.attr="disabled"
                            wire:target="deleteUser({{ $user['id'] }})"
                            class="bg-red-100 text-red-600 px-3 py-1 rounded-md hover:bg-red-200 disabled:opacity-50 transition"
                        >
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
</div>