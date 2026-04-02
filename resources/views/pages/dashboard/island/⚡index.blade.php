<?php

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Post;

new class extends Component {

    public $loadHeavy = false;


    #[Computed]
    public function totalPosts()
    {
        // return Post::count();
        return rand(4, 100);
    }

    #[Computed]
    public function recentPosts()
    {
        // if($this->loadHeavy){
        //     sleep(3);
        // }
        return Post::inRandomOrder()->take(rand(4, 20))->get();
    }
    
    public function heavyPosts()
    {
        sleep(3);
        return Post::inRandomOrder()->take(rand(4, 20))->get();
    }

    // En tu componente Livewire/Volt
    // public function with()
    // {
    //     sleep(3); // Esto mantendrá el placeholder visible por 3 segundos
    //     return [];
    // }
};
?>

<div class="space-y-8 gap-4">

    <flux:heading level="1">Islands Demo</flux:heading>
    <flux:text>Esta página demuestra diferentes usos del directive @island en Livewire 4.</flux:text>

    <flux:card>
        <flux:heading level="2">1. Island Básico</flux:heading>
        <flux:text>Se actualiza independientemente sin re-renderizar toda la página {{ time() }}.</flux:text>
        {{-- si comentas es island se recarga TODO el componente junt con el time --}}
        @island
            <div class="p-4 bg-zinc-50 dark:bg-zinc-800 rounded-lg">
                <flux:heading level="3">Total de Posts: {{ $this->totalPosts }}</flux:heading>
                <flux:text class="mt-2">Este island usa un Computed property que se recalcula solo cuando el island se
                    actualiza.</flux:text>
                <flux:button size="sm" wire:click="$refresh" class="mt-2">
                    Actualizar
                </flux:button>

                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <p class="text-red">El tiempo {{ time() }} sera mayor y solo se calcula al momento de que LA ISLA
                        ES VISIBLE</p>
                    <flux:heading level="3">Posts Recientes</flux:heading>
                    <ul class="mt-2 space-y-2">
                        @foreach ($this->recentPosts as $post)
                            <li class="flex items-center gap-2">
                                <flux:badge>{{ $post->id }}</flux:badge>
                                {{ $post->title }}
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        @endisland
    </flux:card>

    <div class="h-96"></div>
    <div class="h-96"></div>
    <div class="h-96"></div>

    <flux:card>
        <flux:heading level="2">2. Island con Lista (Lazy - carga al hacer scroll)</flux:heading>
        <flux:text>Este island carga solo cuando se hace scroll y es visible en el viewport.</flux:text>


        <p class="text-red">El tiempo {{ time() }} sera el mismo que el de <strong>1. Island Básico</strong> al
            cargar la página</p>

        @island(lazy: true)
            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <p class="text-red">El tiempo {{ time() }} sera mayor y solo se calcula al momento de que LA ISLA ES
                    VISIBLE</p>
                <flux:heading level="3">Posts Recientes (SOLO se GENERA EL LISTADO AL CARGAR LA PAGINA) </flux:heading>
                <ul class="mt-2 space-y-2">
                    @foreach ($this->recentPosts as $post)
                        <li class="flex items-center gap-2">
                            <flux:badge>{{ $post->id }}</flux:badge>
                            {{ $post->title }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endisland

    </flux:card>

    <flux:card>
        <flux:heading level="2">3. Island Deferred (carga inmediata)</flux:heading>
        <flux:text>Este island carga inmediatamente después de que la página carga, sin esperar a que sea visible.
        </flux:text>

        @island(defer: true)
            <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                <flux:heading level="3">Estado: Cargado</flux:heading>
                <flux:text>Este island se cargó inmediatamente al cargar la página.</flux:text>
                <flux:badge color="green" class="mt-2">Defer</flux:badge>
            </div>
        @endisland
    </flux:card>

    <flux:card>
        <flux:heading level="2">4. Named Island con wire:island</flux:heading>
        <flux:text>Los named islands pueden ser actualizados desde cualquier lugar con wire:island. {{ time() }}</flux:text>

        @island()
            <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <flux:heading level="3">Estadísticas (Isla sin nombre :/)</flux:heading>
                <flux:text>Posts publicados: {{ $this->totalPosts }}</flux:text>
                <flux:button wire:click="$refresh">
                    U
                </flux:button>
            </div>
        @endisland

        @island(name: 'stats')
            <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg my-4">
                <flux:heading level="3">Estadísticas (Isla stats)</flux:heading>
                <flux:text>Posts publicados: {{ $this->totalPosts }}</flux:text>
                <flux:button wire:click="$refresh">
                    U
                </flux:button>
            </div>
        @endisland

        @island(name: 'stats2')
            <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <flux:heading level="3">Estadísticas (Isla stats2)</flux:heading>
                <flux:text>Posts publicados: {{ $this->totalPosts }}</flux:text>
                <flux:button wire:click="$refresh">
                    U
                </flux:button>
            </div>
        @endisland

        <div class="mt-4 flex flex-col gap-2">
            <flux:button wire:click="$refresh" wire:island="stats">
                Actualizar Isla con nombre stats (Estoy fuera de la isla)
            </flux:button>
            <flux:button wire:click="$refresh">
                Actualizar Stats (NO actualiza a nadie, NO esta dentro de ningula isla)
            </flux:button>
        </div>
    </flux:card>

    <flux:card>
        <flux:heading level="2">5. Island con Custom Placeholder</flux:heading>
        <flux:text>Personaliza el estado de carga con @placeholder.</flux:text>
        <div class="h-96"></div>

        @island(lazy: true)
            @placeholder
                <div class="p-4 rounded-lg animate-pulse bg-zinc-200 dark:bg-zinc-700">
                    <div class="h-4 bg-zinc-300 dark:bg-zinc-600 rounded w-3/4 mb-2"></div>
                    <div class="h-4 bg-zinc-300 dark:bg-zinc-600 rounded w-1/2"></div>
                </div>
            @endplaceholder

            <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                <flux:heading level="3">Contenido Cargado</flux:heading>
                <flux:text>Este contenido se cargó lazy con placeholder personalizado.</flux:text>
            </div>
        @endisland

        <div class="h-64"></div>
        
        <flux:card>
            <flux:heading level="2">6. Island Hija Custom Placeholder</flux:heading>
            <flux:text>Personaliza el estado de carga con @placeholder.</flux:text>
            {{-- @livewire('dashboard.island-lazy') --}}
            @island(lazy: true)
                @placeholder
                    
                    {{-- @livewire('dashboard.island-lazy')  --}}
                    {{-- NO SIRVE, no puedes cargar componentes en islas, carga pero bloquea 3s --}}

                    <div class="animate-pulse h-24 flex justify-center items-center bg-gray-500 border rounded-2xl">Cargando comentarios...</div>
                @endplaceholder

                
                    @foreach ($this->heavyPosts() as $post)
                        <li class="flex items-center gap-2">
                            <flux:badge>{{ $post->id }}</flux:badge>
                            {{ $post->title }}
                        </li>
                    @endforeach
                    <flux:button wire:click="$refresh">
                        Refresh with placeholder
                    </flux:button>
            @endisland

            <div class="h-64"></div>
        </flux:card>

    </flux:card>
</div>