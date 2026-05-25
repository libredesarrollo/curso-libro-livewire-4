<x-layouts::app.sidebar :title="$title ?? null">

    <div class="w-full bg-zinc-900 p-4">
        @persist('global-audio-player')
            <audio id="main-player" src="/music.mp3" controls></audio>
        @endpersist
    </div>

    <flux:main>



        {{ $slot }}
    </flux:main>
</x-layouts::app.sidebar>
