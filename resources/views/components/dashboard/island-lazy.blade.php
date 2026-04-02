<?php
use Livewire\Component;
use App\Models\Post;

new class extends Component {
    public function with()
    {
        sleep(3); // Solo bloquea esta isla
        return [
            'total' => Post::count(),
            'recent' => Post::latest()->take(5)->get(),
        ];
    }
}; 
?>

<div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
    <flux:heading level="3">Estadísticas Reales (Componente Hijo)</flux:heading>
    <flux:text>Posts: {{ $total }}</flux:text>
    {{-- ... resto de tu lista --}}
</div>