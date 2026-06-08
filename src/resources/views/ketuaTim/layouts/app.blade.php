<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard Ketua Tim - Colab, aplikasi manajemen tim kolaboratif.">
    <title>Colab | {{ $title }}</title>

    @vite('resources/css/app.css')

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
        .sidebar-overlay { transition: opacity 0.3s ease; }
    </style>
</head>
<body class="bg-colab-gray-light min-h-screen font-sans">

    {{-- ========================== MOBILE SIDEBAR OVERLAY ========================== --}}
    <div id="sidebarOverlay"
         class="fixed inset-0 bg-black/40 z-40 lg:hidden hidden opacity-0 sidebar-overlay"
         onclick="toggleSidebar()">
    </div>

    {{-- ========================== SIDEBAR ========================== --}}
    <aside id="sidebar"
           class="fixed top-0 left-0 z-50 h-screen w-[220px] bg-white border-r border-colab-gray flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-300">

        {{-- Sidebar Header — Logo --}}
        <div class="px-6 py-0">
            <img src="{{ asset('images/logo.png') }}" alt="Colab Logo" class="h-36 w-auto">
        </div>

        {{-- Sidebar Content --}}
        <nav class="flex-1 flex flex-col px-4 overflow-y-auto">

            {{-- Akun Section --}}
            <div class="mb-6">
                <h2 class="px-2 mb-2 text-xs font-semibold text-gray-900 uppercase tracking-wider">Akun</h2>
                <ul class="space-y-1">

                    {{-- Profil --}}
                    <li>
                        <a href="{{ route('profil') }}"
                            class="flex items-center gap-3 px-3 rounded-lg text-sm transition-colors
                                {{ request()->is('profil')
                                    ? 'font-bold text-colab-blue bg-blue-50 border-l-4 border-colab-blue'
                                    : 'text-gray-500 hover:bg-colab-gray-light' }}">
                            <img src="{{ asset('images/person.png') }}" alt="Profil" class="w-14 h-14 object-contain">
                            <span>Profil</span>
                        </a>
                    </li>

                    {{-- Logout --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-3 rounded-lg text-sm text-gray-500 hover:bg-colab-gray-light transition-colors">
                                <img src="{{ asset('images/logout.png') }}" alt="Logout" class="w-14 h-14 object-contain">
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

            {{-- Menu Section --}}
            <div class="mb-6">
                <h2 class="px-2 mb-2 text-xs font-semibold text-gray-900 uppercase tracking-wider">Menu</h2>
                <ul class="space-y-1">
                    {{-- Dashboard --}}
                    <li>
                        <a href="{{ route('ketua_tim.dashboard') }}"
                            class="flex items-center gap-3 px-3 rounded-lg text-sm transition-colors
                                {{ request()->is('ketua-tim/dashboard')
                                    ? 'font-bold text-colab-blue bg-blue-50 border-l-4 border-colab-blue'
                                    : 'text-gray-500 hover:bg-colab-gray-light' }}">
                            <img src="{{ asset(request()->is('ketua-tim/dashboard') ? 'images/dashboard-active.png' : 'images/dashboard.png') }}"
                                alt="Dashboard" class="w-14 h-14 object-contain">
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- Task --}}
                    <li>
                        <a href="{{ route('ketua_tim.task') }}"
                            class="flex items-center gap-3 px-3 rounded-lg text-sm transition-colors
                                {{ request()->is('ketua-tim/task*')
                                    ? 'font-bold text-colab-blue bg-blue-50 border-l-4 border-colab-blue'
                                    : 'text-gray-500 hover:bg-colab-gray-light' }}">
                            <img src="{{ asset(request()->is('ketua-tim/task*') ? 'images/task-active.png' : 'images/task.png') }}"
                                alt="Task" class="w-14 h-14 object-contain">
                            <span>Task</span>
                        </a>
                    </li>

                    {{-- Materials --}}
                    <li>
                        <a href="{{ route('ketua_tim.materials') }}"
                            class="flex items-center gap-3 px-3 rounded-lg text-sm transition-colors
                                {{ request()->is('ketua-tim/materials*')
                                    ? 'font-bold text-colab-blue bg-blue-50 border-l-4 border-colab-blue'
                                    : 'text-gray-500 hover:bg-colab-gray-light' }}">
                            <img src="{{ asset(request()->is('ketua-tim/materials*') ? 'images/materials-active.png' : 'images/materials.png') }}"
                                alt="Materials" class="w-14 h-14 object-contain">
                            <span>Materials</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Sidebar Footer --}}
        <div class="px-6 py-4 border-t border-colab-gray">
            <p class="text-xs text-gray-400">Colab v0.01</p>
        </div>
    </aside>

    {{-- ========================== MAIN WRAPPER ========================== --}}
    <div class="lg:ml-[220px] min-h-screen flex flex-col">

        {{-- ========================== TOPBAR ========================== --}}
        <header class="sticky top-0 z-30 bg-white border-b border-colab-gray px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">

            {{-- Mobile hamburger --}}
            <button id="hamburgerBtn" onclick="toggleSidebar()"
                    class="lg:hidden p-2 rounded-lg hover:bg-colab-gray-light transition-colors"
                    aria-label="Toggle Sidebar">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Spacer for desktop --}}
            <div class="hidden lg:block"></div>

            {{-- User Profile --}}
            <div class="relative flex items-center gap-3 ml-auto" x-data="{ open: false }">

                {{-- Avatar --}}
                <div class="w-10 h-10 rounded-full bg-colab-gray flex items-center justify-center overflow-hidden flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v1.2c0 .7.5 1.2 1.2 1.2h16.8c.7 0 1.2-.5 1.2-1.2v-1.2c0-3.2-6.4-4.8-9.6-4.8z"/>
                    </svg>
                </div>

                {{-- Name & Role --}}
                @php
                    $activeRoleName = session('active_role') ?? auth()->user()->roles->first()->role_name ?? null;
                    $activeRoleLabel = $activeRoleName ? \App\Models\Role::label($activeRoleName) : '-';
                @endphp

                <div class="hidden sm:block">
                    <p class="text-sm font-bold text-gray-900 leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 leading-tight">{{ $activeRoleLabel }}</p>
                </div>

                {{-- Dropdown chevron --}}
                <button @click="open = !open"
                    class="p-1 rounded hover:bg-colab-gray-light transition-colors" aria-label="User Menu">
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                        :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute right-0 top-14 w-56 bg-white rounded-xl shadow-lg border border-gray-100 z-50 overflow-hidden">

                    {{-- Email --}}
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>

                    {{-- Hak Akses tampil meski hanya 1 role --}}
                    <div class="border-b border-gray-100">
                        <p class="px-4 py-2 text-xs font-bold text-white bg-gray-400 text-center">Hak Akses</p>

                        @foreach(auth()->user()->roles as $role)
                            @if($role->role_name === $activeRoleName)
                                {{-- Role aktif tidak bisa diklik --}}
                                <div class="w-full text-center px-4 py-3 text-sm font-bold text-colab-blue bg-blue-50 border-b border-gray-100">
                                    {{ \App\Models\Role::label($role->role_name) }}
                                    <span class="text-xs font-normal text-gray-400 block">aktif</span>
                                </div>
                            @else
                                {{-- Role lain bisa switch --}}
                                <form method="POST" action="{{ route('switch.role') }}">
                                    @csrf
                                    <input type="hidden" name="role" value="{{ $role->role_name }}">
                                    <button type="submit"
                                        class="w-full text-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-0">
                                        {{ \App\Models\Role::label($role->role_name) }}
                                    </button>
                                </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </header>

        {{-- ========================== MAIN CONTENT ========================== --}}
        <div>
            <h1 class="h3 m-4 sm:m-6 lg:m-8 text-3xl font-bold text-gray-900">{{ $title }}</h1>

            {{-- Content injected --}}
            @yield('content')
        </div>
    </div>

    {{-- ========================== FLOATING ACTION BUTTON (AI ChatBot) ========================== --}}
    <button id="fab-chatbot"
            class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-colab-blue text-white rounded-full shadow-lg flex items-center justify-center hover:bg-colab-blue-dark hover:shadow-xl hover:scale-110 active:scale-95 transition-all duration-200 ease-out"
            aria-label="AI ChatBot">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
    </button>

    {{-- ========================== SCRIPTS ========================== --}}
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            } else {
                overlay.classList.remove('hidden');
                void overlay.offsetWidth;
                overlay.classList.remove('opacity-0');
                sidebar.classList.remove('-translate-x-full');
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('sidebar');
                if (!sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar();
                }
            }
        });
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>