<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Screenbites - Create Account</title>
    <style>
        body { margin: 0; font-family: 'Arial Black', sans-serif; background-color: #000; color: #fff; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 40px 0; }
        .auth-box { background: #111; padding: 40px; border-top: 5px solid #ffd000; border-radius: 8px; width: 100%; max-width: 500px; text-align: center; }
        .auth-box h1 { color: #ffd000; text-transform: uppercase; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; font-size: 12px; margin-bottom: 5px; color: #aaa; text-transform: uppercase; }
        .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="password"] { width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px; box-sizing: border-box; }
        
        .avatar-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-top: 10px; }
        .avatar-grid label { cursor: pointer; }
        .avatar-grid input[type="radio"] { 
            position: absolute; 
            opacity: 0; 
            width: 0; 
            height: 0; 
        }
        .avatar-grid img { width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 50%; border: 3px solid transparent; transition: all 0.2s; opacity: 0.5; }
        .avatar-grid input[type="radio"]:checked + img { border-color: #ffd000; opacity: 1; transform: scale(1.1); box-shadow: 0 0 15px rgba(255,208,0,0.5); }
        .avatar-grid img:hover { opacity: 1; }

        .password-wrapper { position: relative; display: flex; align-items: center; }
        .password-wrapper input { padding-right: 40px; }
        .toggle-password { position: absolute; right: 10px; background: none; border: none; color: #888; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: color 0.3s ease; padding: 0; }
        .toggle-password:hover { color: #ffd000; }

        .btn-submit { width: 100%; background: #ffd000; color: #000; padding: 15px; border: none; font-weight: 900; text-transform: uppercase; cursor: pointer; border-radius: 4px; margin-top: 20px; transition: background 0.3s; }
        .btn-submit:hover { background: #fff; }
        .link { display: block; margin-top: 20px; color: #ffd000; text-decoration: none; font-size: 12px; }
        .link:hover { text-decoration: underline; }
        .error { color: #ff4444; font-size: 12px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="auth-box">
        <h1>Join the Club</h1>

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <!-- Cambiada la ruta a la estándar de Laravel Auth -->
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label style="color: #ffd000; text-align: center; font-size: 14px;">Choose your Character</label>

                @error('avatar') <span class="error" style="text-align: center; display: block;">Please select an avatar</span> @enderror

                <div class="avatar-grid">
                    <label><input type="radio" name="avatar" value="avatar1.png"><img src="{{ asset('img/avatars/avatar1.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                    <label><input type="radio" name="avatar" value="avatar2.png"><img src="{{ asset('img/avatars/avatar2.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                    <label><input type="radio" name="avatar" value="avatar3.png"><img src="{{ asset('img/avatars/avatar3.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                    <label><input type="radio" name="avatar" value="avatar4.png"><img src="{{ asset('img/avatars/avatar4.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                    <label><input type="radio" name="avatar" value="avatar5.png"><img src="{{ asset('img/avatars/avatar5.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                    <label><input type="radio" name="avatar" value="avatar6.png"><img src="{{ asset('img/avatars/avatar6.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                    <label><input type="radio" name="avatar" value="avatar7.png"><img src="{{ asset('img/avatars/avatar7.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                    <label><input type="radio" name="avatar" value="avatar8.png"><img src="{{ asset('img/avatars/avatar8.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                    <label><input type="radio" name="avatar" value="avatar9.png"><img src="{{ asset('img/avatars/avatar9.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                    <label><input type="radio" name="avatar" value="avatar10.png"><img src="{{ asset('img/avatars/avatar10.png') }}" onerror="this.src='https://via.placeholder.com/100/333/ffd000'"></label>
                </div>
            </div>

            <div class="form-group"><label>Full Name</label><input type="text" name="name" value="{{ old('name') }}" required></div>
            <div class="form-group"><label>Email Address</label><input type="email" name="email" value="{{ old('email') }}" required></div>
            
            <div class="form-group">
                <label>Password (Min 8 characters)</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="reg-password" required>
                    <button type="button" class="toggle-password" onclick="toggleVisibility('reg-password', 'icon-reg1')">
                        <svg id="icon-reg1" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password_confirmation" id="reg-password-conf" required>
                    <button type="button" class="toggle-password" onclick="toggleVisibility('reg-password-conf', 'icon-reg2')">
                        <svg id="icon-reg2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn-submit">Sign Up</button>
        </form>
        <a href="{{ route('login') }}" class="link">Already have an account? Sign in here</a>
        <a href="{{ route('home') }}" class="link" style="color: #666; margin-top: 10px;">Back to Home</a>
    </div>

    <script>
        function toggleVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }
    </script>
</body>
</html>