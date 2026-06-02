<?php

use Livewire\Component;

use Livewire\Attributes\Layout;

new #[Layout('layouts.web')] class extends Component {

    public string $title;
    public string $loadedAt;
    public array $items = [];

    public function mount(): void
    {
        // Simular carga lenta de 2 segundos
        sleep(2);

        $this->title = 'Datos de Ventas Recientes';
        $this->loadedAt = now()->format('H:i:s');
        $this->items = [
            ['id' => 1, 'product' => 'Suscripción Premium', 'price' => '$99.00', 'status' => 'Completado'],
            ['id' => 2, 'product' => 'Soporte Prioritario', 'price' => '$49.00', 'status' => 'Completado'],
            ['id' => 3, 'product' => 'Consultoría 1 Hora', 'price' => '$150.00', 'status' => 'Pendiente'],
        ];
    }
};
?>

@placeholder
    <div class="border border-blue-100 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800/80 p-6 rounded-2xl shadow-sm animate-pulse">
        <div class="flex items-center space-x-4 mb-4">
            <div class="bg-blue-200 dark:bg-blue-900/50 h-8 w-8 rounded-full flex items-center justify-center">
                <svg class="animate-spin h-5 w-5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div class="flex-1 space-y-2">
                <div class="h-4 bg-blue-200 dark:bg-blue-900/30 rounded w-1/3"></div>
                <div class="h-3 bg-blue-200 dark:bg-blue-900/20 rounded w-1/4"></div>
            </div>
        </div>
        
        <div class="space-y-3">
            <div class="h-10 bg-blue-100 dark:bg-blue-950/40 rounded-xl"></div>
            <div class="h-10 bg-blue-100 dark:bg-blue-950/40 rounded-xl"></div>
            <div class="h-10 bg-blue-100 dark:bg-blue-950/40 rounded-xl"></div>
        </div>
        
        <div class="mt-4 text-xs text-blue-500/80 flex items-center gap-1.5 justify-end">
            <span>⏳ Simulando carga lenta (sleep de 2 segundos)...</span>
        </div>
    </div>
@endplaceholder

<div class="border border-emerald-100 dark:border-emerald-950 bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm transition-all duration-300 hover:shadow-md">
    <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-4 mb-4">
        <div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                {{ $title }}
            </h3>
            <p class="text-xs text-gray-500 mt-0.5">Cargado dinámicamente usando Livewire 4 Lazy Loading</p>
        </div>
        <span class="text-xs font-mono bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 px-2.5 py-1 rounded-full">
            Hora de carga: {{ $loadedAt }}
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3 rounded-l-lg">ID</th>
                    <th scope="col" class="px-4 py-3">Producto</th>
                    <th scope="col" class="px-4 py-3">Precio</th>
                    <th scope="col" class="px-4 py-3 rounded-r-lg">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @foreach ($items as $item)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">#{{ $item['id'] }}</td>
                        <td class="px-4 py-3">{{ $item['product'] }}</td>
                        <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white">{{ $item['price'] }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item['status'] === 'Completado' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400' : 'bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-amber-400' }}">
                                {{ $item['status'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
