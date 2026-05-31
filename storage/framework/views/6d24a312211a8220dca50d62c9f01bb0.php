<?php
use Livewire\Component;
?>

<div class="space-y-6">
        <script src="https://cdn.tailwindcss.com"></script>
    <!-- Header/Hero section -->
    <div class="relative overflow-hidden rounded-2xl bg-linear-to-r from-indigo-500 via-purple-500 to-pink-500 p-8 text-white shadow-lg">
        <div class="relative z-10 space-y-2">
            <h1 class="text-3xl font-extrabold tracking-tight">Livewire File Manager</h1>
            <p class="max-w-2xl text-indigo-100">
                A simple, friendly, and practical file and folder manager for Laravel applications using Livewire and Alpine.js.
            </p>
        </div>
        <!-- Decorative background elements -->
        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10 blur-2xl"></div>
        <div class="absolute -bottom-20 -left-20 h-60 w-60 rounded-full bg-white/10 blur-3xl"></div>
    </div>

    <!-- Instructions / Badges -->
    <div class="flex flex-wrap gap-2">
        <span class="inline-flex items-center gap-1.5 rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-indigo-700/10 dark:bg-indigo-950/30 dark:text-indigo-400">
            📂 Drag & Drop Uploads
        </span>
        <span class="inline-flex items-center gap-1.5 rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-purple-700/10 dark:bg-purple-950/30 dark:text-purple-400">
            🔍 Real-time Search
        </span>
        <span class="inline-flex items-center gap-1.5 rounded-md bg-pink-50 px-2 py-1 text-xs font-medium text-pink-700 ring-1 ring-pink-700/10 dark:bg-pink-950/30 dark:text-pink-400">
            🌙 Dark Mode Aware
        </span>
        <span class="inline-flex items-center gap-1.5 rounded-md bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-amber-700/10 dark:bg-amber-950/30 dark:text-amber-400">
            🔒 Spatie Media Library Backend
        </span>
    </div>

    <!-- Main Container -->
    <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-xs dark:border-zinc-700 dark:bg-zinc-900">
        <div class="mb-4">
            <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100">Live Browser View</h2>
            <p class="text-sm text-zinc-500">Manage your files and directories below.</p>
        </div>

        <div class="min-h-[500px]">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('livewire-filemanager', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-814319757-0', $__key);

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
    </div>
        <script defer src="https://unpkg.com/@alpinejs/ui@3.13.3-beta.1/dist/cdn.min.js"></script>
</div><?php /**PATH /Users/andrescruz/Herd/livewirestore/storage/framework/views/livewire/views/d24a83be.blade.php ENDPATH**/ ?>