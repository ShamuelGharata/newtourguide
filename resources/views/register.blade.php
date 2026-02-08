<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Explore Malang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Explore <span>Malang</span></div>
        <ul>
            <li><a href="/">Home</a></li>
        </ul>
    </nav>

    <section class="auth-container">
        <div class="auth-card">
            <h2>Register</h2>
            <p class="auth-subtitle">Create an account to start your journey.</p>
            
            @if ($errors->any())
                <div style="color: red; margin-bottom: 10px; text-align: left;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" required value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a password" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm your password" required>
                </div>
                <button type="submit" class="auth-btn">Register</button>
            </form>

            <p class="auth-footer">Already have an account? <a href="/login">Login here</a></p>
        </div>
    </section>
</body>
</html>