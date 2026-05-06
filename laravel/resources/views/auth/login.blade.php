<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screenbites - Sign In</title>
    <style>
        :root {
            --primary: #ffd000;
            --bg: #000;
            --card-bg: #0d0d0d;
            --input-bg: #1a1a1a;
            --text-muted: #888;
        }

        body { 
            margin: 0; 
            font-family: 'Arial Black', sans-serif; 
            background-color: var(--bg); 
            background-image: radial-gradient(circle at 50% 50%, #111 0%, #000 100%);
            color: #fff; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            overflow: hidden;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
            animation: fadeIn 0.8s ease;
        }

        .auth-box { 
            background: var(--card-bg); 
            padding: 50px 40px; 
            border: 1px solid #222;
            border-top: 5px solid var(--primary); 
            border-radius: 12px; 
            text-align: center; 
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-box h1 { 
            color: #fff; 
            text-transform: uppercase; 
            margin-bottom: 10px; 
            font-size: 28px;
            letter-spacing: -1px;
        }

        .auth-box p {
            color: var(--text-muted);
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-group { margin-bottom: 25px; text-align: left; }

        .form-group label { 
            display: block; 
            font-size: 11px; 
            margin-bottom: 8px; 
            color: var(--primary); 
            text-transform: uppercase; 
            letter-spacing: 1px;
            font-weight: 900;
        }

        .form-group input { 
            width: 100%; 
            padding: 14px; 
            background: var(--input-bg); 
            border: 1px solid #333; 
            color: #fff; 
            border-radius: 6px; 
            box-sizing: border-box; 
            font-family: Arial, sans-serif;
            font-size: 15px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(255, 208, 0, 0.1);
        }
        
        .password-wrapper { position: relative; display: flex; align-items: center; }
        .password-wrapper input { padding-right: 45px; }

        .toggle-password { 
            position: absolute; 
            right: 12px; 
            background: none; 
            border: none; 
            color: #555; 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            transition: color 0.3s;
        }

        .toggle-password:hover { color: var(--primary); }

        .btn-submit { 
            width: 100%; 
            background: var(--primary); 
            color: #000; 
            padding: 16px; 
            border: none; 
            font-weight: 900; 
            text-transform: uppercase; 
            cursor: pointer; 
            border-radius: 6px; 
            margin-top: 10px; 
            font-size: 14px;
            letter-spacing: 1px;
            transition: transform 0.2s, background 0.3s;
        }

        .btn-submit:hover { 
            background: #fff; 
            transform: scale(1.02);
        }

        .footer-links {
            margin-top: 30px;
        }

        .link { 
            display: block; 
            color: var(--primary); 
            text-decoration: none; 
            font-size: 13px; 
            margin-bottom: 15px;
            transition: color 0.3s;
        }

        .link:hover { color: #fff; }

        .back-home {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 12px;
            font-family: Arial, sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s;
        }

        .back-home:hover { color: #fff; }

        .error-box { 
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid red;
            color: #ff4444; 
            font-size: 13px; 
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px; 
            font-family: Arial, sans-serif;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h1>Welcome Back</h1>
            <p>Ready for the next premiere? Sign in to your account.</p>
            
            @if($errors->any())
                <div class="error-box">
                    <strong>Error:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="name@example.com" required autocomplete="email">
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="login-password" placeholder="••••••••" required>
                        <button type="button" class="toggle-password" onclick="toggleVisibility('login-password', 'icon-login')">
                            <svg id="icon-login" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Sign In</button>
            </form>

            <div class="footer-links">
                <a href="{{ route('register') }}" class="link">Don't have an account? Join now</a>
                <a href="/" class="back-home">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Back to home
                </a>
            </div>
        </div>
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