<div class="w-full flex justify-center items-center bg-white/10 backdrop-blur">
    <div
        class="flex flex-col gap-3 w-sm lg:w-md mx-5 lg:mx-0 p-6 bg-white/80 backdrop-blur rounded-lg border border-gray-200 shadow-md">
        <h2 class="text-center text-2xl font-semibold mb-5">Login to <span
                class="bg-primary text-white font-bold rounded px-2 py-1">Portfolio
                CMS</span>
        </h2>

        {{-- Form --}}
        <form wire:submit.prevent="login" class="space-y-3">
            {{-- General Auth Error --}}
            @error('authentication')
                <x-flash-alert type="error">{{ $message }}</x-flash-alert>
            @enderror

            {{-- Email --}}
            <div>
                <label for="email" class="block font-semibold text-gray-700 mb-1">Email Address</label>
                <input wire:model="form.email" type="email" id="email" name="email"
                    placeholder="Enter your e-mail address"
                    class="w-full border-gray-300 bg-white rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500"
                    required>

                @error('form.email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="relative">
                <label for="password" class="block font-semibold text-gray-700 mb-1">Password</label>
                <input wire:model="form.password" type="{{ $showPassword ? 'text' : 'password' }}" id="password"
                    name="password" placeholder="Enter your password"
                    class="w-full border-gray-300 bg-white rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500"
                    required>

                <button wire:click.prevent="togglePassword"
                    class="absolute right-3 top-1/2 text-gray-700 font-semibold cursor-pointer hover:text-primary">
                    <i class="bi bi-eye{{ $showPassword ? '-slash' : '' }}"></i>
                </button>

                @error('form.password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center gap-2 text-sm">
                <input wire:model="form.remember" type="checkbox" id="remember"
                    class="form-checkbox rounded accent-primary cursor-pointer">
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
