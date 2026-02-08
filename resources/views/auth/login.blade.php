<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Explore Malang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body style="background: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0;">

    <div style="width: 100%; max-width: 400px; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
        
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="margin: 0; color: #333;">Welcome Back</h2>
            <p style="color: #666; font-size: 14px;">Login to review your favorite places</p>
        </div>

        @if($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #555;">Email Address</label>
                <input type="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;" placeholder="name@example.com">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #555;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;" placeholder="••••••••">
            </div>

            <button type="submit" style="width: 100%; background: #ff5722; color: white; border: none; padding: 14px; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 16px;">
                Login
            </button>
        </form>

        <div style="text-align: center; margin-top: 25px; font-size: 14px; color: #666;">
            Don't have an account? <a href="{{ route('register') }}" style="color: #ff5722; text-decoration: none; font-weight: bold;">Register here</a>
        </div>
    </div>

</body>
</html>