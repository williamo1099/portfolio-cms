<div class="card" style="width: 100%; max-width: 400px;">
    <div class="card-body">
        <h2 class="text-center mb-4">Login</h2>

        <!-- Login Form -->
        <form action="login.php" method="POST">
            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
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
