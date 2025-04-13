<div class="min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card w-25">
        <div class="card-body">
            <h2 class="text-center mb-4">Login</h2>

            {{-- Form --}}
            <form wire:submit.prevent="login">
                @error('authentication')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input wire:model="form.email" type="email" class="form-control" id="email" name="email"
                        required>

                    @error('form.email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input wire:model="form.password" type="password" class="form-control" id="password"
                        name="password" required>

                    @error('form.password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="mb-3">
                    <input wire:model="form.remember" type="checkbox" class="form-check-input" id="remember"
                        name="password">
                    <label class="form-check-label" for="remember">
                        Remember me?
                    </label>
                </div>

                {{-- Button --}}
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
