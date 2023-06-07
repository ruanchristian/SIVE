<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">
    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">
        Início
    </div>

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">
        Funções do sistema
    </div>

    <x-sidebar.dropdown title="Eleições" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'eleicoes.',
    )">

        <x-slot name="icon">
            <x-heroicon-o-academic-cap class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink title="Cadastrar eleições" href="/" :isActive="request()->routeIs('election.index')"></x-sidebar.sublink>

        <x-sidebar.sublink title="Editar eleições" href="/" :isActive="request()->routeIs('election.index')"></x-sidebar.sublink>
    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="Usuários" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'user.',
    )">

        <x-slot name="icon">
            <x-heroicon-o-user class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink title="Ver usuários" href="/" :isActive="request()->routeIs('user.index')"></x-sidebar.sublink>

        <x-sidebar.sublink title="Cadastrar usuários" href="/" :isActive="request()->routeIs('user.create')"></x-sidebar.sublink>
    </x-sidebar.dropdown>
</x-perfect-scrollbar>
