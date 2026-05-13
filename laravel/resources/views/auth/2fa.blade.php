<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cine Screenbites - Security Verification</title>
    <style>
        body { 
            margin: 0; 
            font-family: 'Arial Black', sans-serif; 
            background-color: #000; 
            color: #fff; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }
        .auth-box { 
            background: #111; 
            padding: 50px 40px; 
            border-top: 5px solid #ffd000; 
            border-radius: 8px; 
            width: 100%; 
            max-width: 400px; 
            text-align: center; 
        }
        .auth-box h1 { 
            color: #ffd000; 
            text-transform: uppercase; 
            margin-bottom: 10px; 
            font-size: 28px; 
        }
        .auth-box p { 
            color: #888; 
            font-family: Arial, sans-serif; 
            font-size: 14px; 
            margin-bottom: 30px; 
            line-height: 1.5; 
        }
        .form-group label { 
            display: block; 
            font-size: 18px; 
            color: #fff; 
            margin-bottom: 15px; 
        }
        .form-group input { 
            width: 100%; 
            padding: 15px; 
            background: #222; 
            border: 1px solid #ffd000; 
            color: #ffd000; 
            border-radius: 4px; 
            box-sizing: border-box; 
            text-align: center; 
            font-size: 28px; 
            font-weight: bold; 
            letter-spacing: 15px; 
            outline: none; 
        }
        /* --- ESTE ES EL ESTILO DEL BOTÓN QUE SE HABÍA PERDIDO --- */
        .btn-submit { 
            width: 100%; 
            background: #ffd000; 
            color: #000; 
            padding: 15px; 
            border: none; 
            font-family: 'Arial Black', sans-serif;
            font-size: 14px;
            font-weight: 900; 
            text-transform: uppercase; 
            cursor: pointer; 
            border-radius: 4px; 
            margin-top: 25px; 
            transition: 0.3s; 
        }
        .btn-submit:hover { 
            background: #fff; 
        }
        .error { 
            color: #ff4444; 
            font-family: Arial, sans-serif;
            font-size: 13px; 
            margin-bottom: 20px; 
            background: rgba(255, 68, 68, 0.1);
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="auth-box">
        <h1>Authentication 2FA</h1>
        <p>We have sent a 6-digit secret code to your email. Enter it here to access the cinema.</p>
        
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('2fa.verify') }}" method="POST">
            @csrf 
            <div class="form-group">
                <label for="two_factor_code">Enter Security Code</label>
                
                <input type="text" 
                    name="two_factor_code" 
                    id="two_factor_code" 
                    placeholder="123456" 
                    required 
                    maxlength="6" 
                    autocomplete="off"
                    class="form-control">
                    
                @error('two_factor_code')
                    <span style="color: #ff4444; font-size: 12px; display: block; margin-top: 10px; font-family: Arial, sans-serif;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Verify Identity</button>
        </form>

        {{-- CAJA MODO DEMO / PRESENTACIÓN --}}
        @if(session()->has('demo_2fa_code'))
        <div style="margin-top: 30px; padding: 20px; border: 2px dashed var(--color-principal, #ffd000); background: rgba(255, 208, 0, 0.05); border-radius: 8px; text-align: center;">
            
            <p style="color: var(--color-principal, #ffd000); font-size: 11px; text-transform: uppercase; margin-bottom: 5px; font-weight: 900; letter-spacing: 1px;">
                Demo Mode
            </p>
            <h2 style="color: #fff; letter-spacing: 8px; margin: 0; font-size: 32px; font-family: monospace;">
                {{ session('demo_2fa_code') }}
            </h2>
            <p style="color: #888; font-size: 11px; margin-top: 8px; font-family: Arial, sans-serif;">
                (The code has also been sent to your email)
            </p>
            
        </div>
        @endif
    </div>
</body>
</html>