<div class="flex flex-col gap-4">
    <x-page-header :title="$title" :breadcrumbs="$breadcrumbs" />

    {{-- Flash alert --}}
    @foreach (['success', 'error'] as $type)
        @if (session($type))
            <x-flash-alert :type="$type">{{ session($type) }}</x-flash-alert>
        @endif
    @endforeach

    <x-card class="space-y-4">
        <form wire:submit.prevent="save">
            {{-- Name --}}
            <div>
                <label for="input-name" class="block font-bold text-lg mb-1 text-gray-700">Name</label>
                <input wire:model="form.name" type="text" id="input-name"
                    class="w-full border-gray-300 bg-white rounded-md shadow-sm px-4 py-2 focus:ring-accent focus:border-accent"
                    placeholder="Enter your name">
                @error('form.name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- E-mail --}}
            <div>
                <label for="input-email" class="block font-bold text-lg mb-1 text-gray-700">E-mail</label>
                <input wire:model="form.email" type="email" id="input-email"
                    class="w-full border-gray-300 bg-white rounded-md shadow-sm px-4 py-2 focus:ring-accent focus:border-accent"
                    placeholder="Enter your e-mail">
                @error('form.email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="input-password" class="block font-bold text-lg mb-1 text-gray-700">Password</label>
                <input wire:model="form.password" type="pasword" id="input-password"
                    class="w-full border-gray-300 bg-white rounded-md shadow-sm px-4 py-2 focus:ring-accent focus:border-accent"
                    placeholder="Enter your password">
                <p class="text-sm text-gray-500 mt-1">Leave blank to keep your current password.</p>
            </div>

            {{-- New Password --}}
            <div>
                <label for="input-new-password" class="block font-bold text-lg mb-1 text-gray-700">New Password</label>
                <input wire:model="form.newPassword" type="password" id="input-new-password"
                    class="w-full border-gray-300 bg-white rounded-md shadow-sm px-4 py-2 focus:ring-accent focus:border-accent"
                    placeholder="Enter your new password">
                <p class="text-sm text-gray-500 mt-1">Leave blank to keep your current password.</p>
            </div>

            {{-- Re-enter New Password --}}
            <div class="mb-5">
                <label for="input-new-password-confirmation" class="block font-bold text-lg mb-1 text-gray-700">Re-enter
                    New
                    Password</label>
                <input wire:model="form.newPasswordConfirmation" type="password" id="input-new-password-confirmation"
                    class="w-full border-gray-300 bg-white rounded-md shadow-sm px-4 py-2 focus:ring-accent focus:border-accent"
                    placeholder="Re-enter your new password">
                <p class="text-sm text-gray-500 mt-1">Leave blank to keep your current password.</p>
            </div>

            {{-- Submit Button --}}
            <div class="flex flex-row gap-3">
                <button type="submit"
                    class="px-4 py-2 bg-green-500 text-white font-semibold rounded cursor-pointer hover:bg-green-600 transition">
                    Update Project
                </button>

                <a href="{{ route('projects.index') }}" type="button"
                    class="px-4 py-2 bg-red-500 text-white font-semibold rounded cursor-pointer hover:bg-red-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </x-card>
</div>
