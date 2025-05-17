<div class="min-h-screen flex justify-center items-center bg-white/10 backdrop-blur">
    <div class="flex flex-col gap-3 w-md p-6 bg-white/80 backdrop-blur rounded-lg border border-gray-200 shadow-md">
        <h2 class="text-center text-3xl font-bold mb-5">Login to Portfolio CMS</h2>

        {{-- Form --}}
        <form wire:submit.prevent="login" class="space-y-4">
            {{-- General Auth Error --}}
            @error('authentication')
                <x-flash-alert type="error">{{ $message }}</x-flash-alert>
            @enderror

            {{-- Email --}}
            <div>
                <label for="email" class="block font-bold text-gray-700 mb-1">Email Address</label>
                <input wire:model="form.email" type="email" id="email" name="email"
                    class="w-full border-gray-300 bg-white rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500"
                    required>

                @error('form.email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block font-bold text-gray-700 mb-1">Password</label>
                <input wire:model="form.password" type="password" id="password" name="password"
                    class="w-full border-gray-300 bg-white rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500"
                    required>

                @error('form.password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center gap-2">
                <input wire:model="form.remember" type="checkbox" id="remember"
                    class="form-checkbox text-blue-600 rounded cursor-pointer">
                <label for="remember" class="text-gray-700 cursor-pointer">Remember me?</label>
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full px-4 py-2 bg-primary/80 text-white font-semibold cursor-pointer rounded hover:bg-primary transition">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
