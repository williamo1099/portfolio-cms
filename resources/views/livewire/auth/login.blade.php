<div class="min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card w-25">
        <div class="card-body">
            <h2 class="text-center mb-4">Login</h2>

            <!-- Login Form -->
            <form wire:submit.prevent="login">
                @error('authentication')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input wire:model="form.email" type="email" class="form-control" id="email" name="email"
                        required>

                    @error('form.email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input wire:model="form.password" type="password" class="form-control" id="password"
                        name="password" required>

                    @error('form.password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-center">
                    <a href="forgot-password.html">Forgot your password?</a>
                </div>
            </form>
        </div>
    </div>
</div>
