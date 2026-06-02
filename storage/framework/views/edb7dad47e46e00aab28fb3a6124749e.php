<?php
use Livewire\Component;
use Livewire\Attributes\Layout;
?>

<div class="p-6 max-w-4xl mx-auto space-y-6">
    <div style="height: 1000px"></div>
    <!-- Header/Hero section -->
    <div
        class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-3xl p-8 text-white shadow-lg relative overflow-hidden">
        <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-12 translate-y-12 scale-150">
            <svg width="400" height="400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
            </svg>
        </div>

        <div class="relative z-10 space-y-3">
            <span
                class="bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider">
                Livewire 4 Demo
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                Lazy Loading Component Example
            </h1>
            <p class="max-w-xl text-indigo-100 text-sm sm:text-base leading-relaxed">
                Aprende a diferir la carga de componentes pesados o lentos para mejorar significativamente el tiempo de
                renderizado de la página inicial.
            </p>
        </div>
    </div>

    <!-- Explanatory layout -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Documentation Sidebar -->
        <div class="md:col-span-1 space-y-4">
            <div
                class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-5 rounded-2xl shadow-sm">
                <h3 class="text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider mb-3">
                    ¿Cómo funciona?
                </h3>
                <ul class="space-y-3 text-xs text-gray-600 dark:text-gray-400">
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500">✔</span>
                        <span>Difiere la carga del componente hasta que entra en el viewport (pantalla visible).</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500">✔</span>
                        <span>Muestra un <strong>Placeholder</strong> o esqueleto animado mientras se realiza la
                            petición en segundo plano.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-500">✔</span>
                        <span>No bloquea el renderizado HTML de la página principal.</span>
                    </li>
                </ul>
            </div>

            <div
                class="bg-gray-50 dark:bg-gray-900/50 p-5 rounded-2xl border border-gray-100 dark:border-gray-800 space-y-3">
                <h4 class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Sintaxis Utilizada:
                </h4>
                <pre class="bg-gray-900 text-gray-100 text-[10px] p-3 rounded-lg overflow-x-auto font-mono">
&lt;livewire:pages::demo.lazy-child <span class="text-yellow-400">lazy</span> /&gt;
                </pre>
            </div>
        </div>

        <!-- Component Display & Demo Area -->
        <div class="md:col-span-2 space-y-6">
            <div
                class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-6 rounded-2xl shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-3">
                    <h3 class="font-bold text-gray-800 dark:text-gray-200">
                        ⚡ Componente Cargado Asíncronamente
                    </h3>
                    <button onclick="window.location.reload();"
                        class="text-xs text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium underline flex items-center gap-1">
                        🔄 Recargar para ver efecto
                    </button>
                </div>

                <!-- 1. Lazy Loading (ACTIVO) -->
                <div>

                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('pages::demo.lazy-child', ['lazy' => true]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1862990586-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                </div>

                <!-- 2. Defer Loading (COMENTADO - EL OTRO NO)
                     Este es el modo deferred loading, el cual carga inmediatamente después
                     de que termine de cargar el DOM, sin importar si es visible en pantalla.
                     Se mantiene comentado para cumplir con los requisitos.
                
                <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <h4 class="text-sm font-semibold text-gray-500 mb-2">Deferred Component (Comentado)</h4>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('pages::demo.lazy-child', ['defer' => true]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1862990586-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                </div>
                -->
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\andre\Herd\livewirestore\storage\framework/views/livewire/views/2e13815e.blade.php ENDPATH**/ ?>