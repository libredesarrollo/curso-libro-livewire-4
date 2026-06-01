<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-5xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col lg:max-w-5xl gap-8">


                {{-- Hero --}}
                <div class="text-center py-8 lg:py-12">
                    <h1 class="text-4xl lg:text-6xl font-semibold tracking-tight">{{ config('app.name', 'Livewire Store') }}</h1>
                    <p class="mt-4 text-lg text-[#706f6c] dark:text-[#A1A09A] max-w-xl mx-auto">
                        Plataforma construida con Laravel, Livewire, Flux UI y Tailwind CSS. Explora los módulos y ejemplos disponibles.
                    </p>
                </div>


                <ul>
                    <li><strong>User:</strong> admin@admin.com</li>
                    <li><strong>Password:</strong>!a5qRNEtVXyX3s</li>
                </ul>

                {{-- Module Cards Grid --}}
                <div class="grid gap-6 lg:grid-cols-3">
@auth
                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}" class="group block p-6 bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-[#f53003]/10 dark:bg-[#FF4433]/10 text-[#f53003] dark:text-[#FF4433]">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-medium">Dashboard</h2>
                        </div>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Panel de administración con gestión de posts, categorías, tags y más.</p>
                        <span class="inline-block mt-4 text-sm font-medium text-[#f53003] dark:text-[#FF4433] group-hover:underline">
                            Ir al Dashboard &rarr;
                        </span>
                    </a>
@endauth
                    {{-- Blog --}}
                    <a href="{{ route('web.index') }}" class="group block p-6 bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-[#f53003]/10 dark:bg-[#FF4433]/10 text-[#f53003] dark:text-[#FF4433]">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-medium">Blog</h2>
                        </div>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Artículos y publicaciones del blog público.</p>
                        <span class="inline-block mt-4 text-sm font-medium text-[#f53003] dark:text-[#FF4433] group-hover:underline">
                            Visitar el Blog &rarr;
                        </span>
                    </a>

                    {{-- Ejemplos --}}
                    <div class="block p-6 bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-[#f53003]/10 dark:bg-[#FF4433]/10 text-[#f53003] dark:text-[#FF4433]">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 01-.657.643 48.39 48.39 0 01-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 01-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 00-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 01-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 00.657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 01-.349-1.003c0-1.035 1.007-1.875 2.25-1.875s2.25.84 2.25 1.875c0 .369-.128.713-.349 1.003-.215.283-.401.604-.401.959v0c0 .333.277.599.61.58a48.1 48.1 0 005.427-.63 48.05 48.05 0 00.582-4.717.532.532 0 00-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.959.401v0a.656.656 0 00.658-.663 48.422 48.422 0 00-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 01-.61-.58v0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-medium">Ejemplos</h2>
                        </div>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-3">Componentes demo con Livewire.</p>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('demo.loading') }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Loading</a>
                            <a href="{{ route('demo.data-loading') }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Data Loading</a>
                            <a href="{{ route('demo.lazy') }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Lazy</a>
                            <a href="{{ route('demo.computed') }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Computed</a>
                            <a href="{{ route('demo.intersect') }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Intersect</a>
                            <a href="{{ route('demo.wire-text') }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Wire Text</a>
                            <a href="{{ route('demo.wire-ref') }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Wire Ref</a>
                            <a href="{{ route('demo.filemanager') }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">File Manager</a>
                            <a href="{{ route('teleport-example') }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Teleport</a>
                            <a href="/chat" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Chat</a>
                            <a href="{{ route('contact-edit', 1) }}" class="text-xs px-2.5 py-1 rounded-md bg-[#f53003]/5 dark:bg-[#FF4433]/5 text-[#f53003] dark:text-[#FF4433] hover:underline">Contacto</a>
                        </div>
                    </div>
                </div>

                {{-- More modules row --}}
                <div class="grid gap-6 lg:grid-cols-2">
                    <a href="{{ route('todo') }}" class="group block p-6 bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-[#f53003]/10 dark:bg-[#FF4433]/10 text-[#f53003] dark:text-[#FF4433]">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-medium">Todo List</h2>
                        </div>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Aplicación de tareas pendientes con Livewire.</p>
                        <span class="inline-block mt-4 text-sm font-medium text-[#f53003] dark:text-[#FF4433] group-hover:underline">Abrir Todo &rarr;</span>
                    </a>

                    <a href="{{ route('shop.cart.list') }}" class="group block p-6 bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-[#f53003]/10 dark:bg-[#FF4433]/10 text-[#f53003] dark:text-[#FF4433]">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-medium">Shop / Carrito</h2>
                        </div>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Carrito de compras con Livewire.</p>
                        <span class="inline-block mt-4 text-sm font-medium text-[#f53003] dark:text-[#FF4433] group-hover:underline">Ir a la Tienda &rarr;</span>
                    </a>
                </div>

                {{-- Footer --}}
                <div class="text-center pb-8">
                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        Construido con <a href="https://laravel.com" class="underline hover:text-[#f53003] dark:hover:text-[#FF4433]">Laravel</a>,
                        <a href="https://livewire.laravel.com" class="underline hover:text-[#f53003] dark:hover:text-[#FF4433]">Livewire</a>,
                        <a href="https://fluxui.dev" class="underline hover:text-[#f53003] dark:hover:text-[#FF4433]">Flux UI</a> y
                        <a href="https://tailwindcss.com" class="underline hover:text-[#f53003] dark:hover:text-[#FF4433]">Tailwind CSS</a>.
                    </p>
                </div>

            </main>
        </div>

        <flux:toast />
        @fluxScripts
    </body>
</html>
