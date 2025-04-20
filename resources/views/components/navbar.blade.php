<nav class="flex flex-row px-4 py-3 justify-between top-0 sticky bg-primary/80 backdrop-blur shadow-md z-50">
    {{-- Menu --}}
    <div class="flex flex-row gap-8 items-center">
        <a class="text-xl text-white font-bold" href="{{ route('home.index') }}" wire:navigate>Portfolio CMS</a>

        <div class="flex flex-row gap-2">
            <x-nav-item :active="request()->routeIs('projects.*')" :href="route('projects.index')">Projects</x-nav-item>
            <x-nav-item :active="request()->routeIs('curriculum-vitaes.*')" :href="route('curriculum-vitaes.index')">Curriculum Vitae</x-nav-item>
        </div>
    </div>

    {{-- Log Out --}}
    <livewire:auth.logout-button />
</nav>
