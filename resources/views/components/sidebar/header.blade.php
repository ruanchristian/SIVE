<div class="flex items-center justify-between flex-shrink-0 px-3">
    <!-- Logo -->
    <span class="inline-flex items-center gap-2" title="{{ config('app.description') }}" >
        <img style="width: 5.5rem;" src="{{ asset('img/logo.png') }}" alt="Logo do Sistema">
        <span class="sr-only">Dashboard</span>
    </span>

    <x-button
        type="button"
        icon-only
        variant="secondary"
        x-show="isSidebarOpen || isSidebarHovered"
        x-on:click="isSidebarOpen = !isSidebarOpen"
    >
        <x-icons.menu-fold-right
            x-show="!isSidebarOpen"
            aria-hidden="true"
            class="hidden w-6 h-6 lg:block"
        />

        <x-icons.menu-fold-left
            x-show="isSidebarOpen"
            aria-hidden="true"
            class="hidden w-6 h-6 lg:block"
        />

        <x-heroicon-o-x
            aria-hidden="true"
            class="w-6 h-6 lg:hidden"
        />
    </x-button>
</div>
