<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        {{-- App logo --}}
        <a class="navbar-brand" href="{{ route('home.index') }}" wire:navigate>Portfolio CMS</a>

        {{-- Hamburger button --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu list --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <x-nav-item :active="request()->routeIs('projects.*')" :href="route('projects.index')">Projects</x-nav-item>
            </ul>
        </div>

        {{-- Logout button --}}
        <livewire:auth.logout-button />
    </div>
</nav>
