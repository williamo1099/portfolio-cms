{{-- Large Screen --}}
<nav class="hidden lg:flex flex-row px-4 py-3 justify-between top-0 sticky bg-primary/80 backdrop-blur shadow-md z-50">
    {{-- Menu --}}
    <div class="flex flex-row gap-8 items-center">
        <a class="text-xl text-white font-bold" href="{{ route('home.index') }}" wire:navigate>Portfolio CMS</a>

        <div class="flex flex-row gap-2">
            <x-nav-item :active="request()->routeIs('curriculum-vitaes.*')" :href="route('curriculum-vitaes.index')">Curriculum Vitae</x-nav-item>
            <x-nav-item :active="request()->routeIs('projects.*')" :href="route('projects.index')">Projects</x-nav-item>
            <x-nav-item :active="request()->routeIs('mails.*')" :href="route('mails.index')">Mails</x-nav-item>
        </div>
    </div>

    <div class="flex flex-row gap-3">
        {{-- Profile --}}
        <a href="/profile" title="Log Out"
            class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition text-white cursor-pointer hover:bg-primary">
            <i class="bi bi-person-circle"></i>
        </a>

        {{-- Log Out --}}
        <livewire:auth.logout-button />
    </div>
</nav>

{{-- Small Screen --}}
<nav class="flex lg:hidden flex-row px-4 py-3 justify-between top-0 sticky bg-primary/80 backdrop-blur shadow-md z-50">
    {{-- Home --}}
    <a class="text-xl text-white font-bold" href="{{ route('home.index') }}" wire:navigate>Portfolio CMS</a>

    {{-- Hamburger --}}
    <input type="checkbox" id="menu-toggle" class="hidden peer" />
    <label for="menu-toggle" class="cursor-pointer text-white text-xl font-bold select-none">
        <i class="bi bi-list"></i>
    </label>

    {{-- Menu --}}
    <div
        class="hidden peer-checked:block bg-primary rounded rounded-t-none absolute top-full left-0 w-full z-40 px-2 py-3">
        <div class="flex flex-col">
            {{-- Curriculum Vitae --}}
            <x-nav-item :active="request()->routeIs('curriculum-vitaes.*')" :href="route('curriculum-vitaes.index')">
                <i class="bi bi-file-earmark-pdf"></i> Curriculum Vitae
            </x-nav-item>

            {{-- Projects --}}
            <x-nav-item :active="request()->routeIs('projects.*')" :href="route('projects.index')">
                <i class="bi bi-folder"></i> Projects
            </x-nav-item>

            {{-- Mails --}}
            <x-nav-item :active="request()->routeIs('mails.*')" :href="route('mails.index')">
                <i class="bi bi-envelope"></i> Mails
            </x-nav-item>

            <a href="/profile" class="text-white px-3 py-2 rounded hover:bg-primary flex items-center gap-2">
                <i class="bi bi-person-circle"></i> Profile
            </a>

            <livewire:auth.logout-button />
        </div>
    </div>
</nav>
