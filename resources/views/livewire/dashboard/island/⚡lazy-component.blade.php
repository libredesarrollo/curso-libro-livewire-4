<div class="p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
    <flux:heading level="3">Posts Recientes (Lazy Component)</flux:heading>
    <ul class="mt-2 space-y-2">
        @foreach ($recentPosts as $post)
            <li class="flex items-center gap-2">
                <flux:badge color="teal">{{ $post->id }}</flux:badge>
                {{ $post->title }}
            </li>
        @endforeach
    </ul>
</div>
