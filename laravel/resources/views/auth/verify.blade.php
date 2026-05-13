<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cine Screenbites - Verifica tu Correo</title>
    <style>
        body { margin: 0; font-family: 'Arial Black', sans-serif; background-color: #000; color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .auth-box { background: #111; padding: 50px 40px; border-top: 5px solid #ffd000; border-radius: 8px; width: 100%; max-width: 450px; text-align: center; }
        .auth-box h1 { color: #ffd000; text-transform: uppercase; margin-bottom: 15px; font-size: 26px; }
        .auth-box p { color: #888; font-family: Arial, sans-serif; font-size: 15px; margin-bottom: 30px; line-height: 1.6; }
        .btn-submit { width: 100%; background: transparent; color: #ffd000; padding: 15px; border: 2px solid #ffd000; font-family: 'Arial Black', sans-serif; font-size: 14px; font-weight: 900; text-transform: uppercase; cursor: pointer; border-radius: 4px; transition: 0.3s; }
        .btn-submit:hover { background: #ffd000; color: #000; }
        .success-msg { color: #4ade80; font-family: Arial, sans-serif; font-size: 13px; margin-bottom: 20px; background: rgba(74, 222, 128, 0.1); padding: 10px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="auth-box">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>We have sent you a verification link to <strong>{{ Auth::user()->email }}</strong>.</p>
        <p>Please click the button in the message to activate your account. You can close this page once you do.</p>
        
        @if (session('message'))
            <div class="success-msg">
                We have sent you a new verification link to your email!
            </div>
        @endif

        <form action="{{ route('verification.send') }}" method="POST">
            @csrf 
            <button type="submit" class="btn-submit">Resend the email</button>
        </form>

        {{-- CAJA MODO DEMO / PRESENTACIÓN MEJORADA --}}
        <div style="margin-top: 30px; padding-top: 25px; border-top: 1px solid rgba(255, 208, 0, 0.2); text-align: center; display: flex; flex-direction: column; align-items: center;">
            
            <span style="background: var(--color-principal, #ffd000); color: #000; font-size: 10px; font-weight: 900; padding: 3px 8px; border-radius: 4px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;">
                Demo Mode
            </span>
            
            <p style="color: #aaa; font-size: 13px; margin-bottom: 20px; line-height: 1.5; max-width: 90%;">
                Skip the email check during this presentation and activate the account instantly:
            </p>

            <a href="{{ route('verification.verify.demo') }}" 
               style="background: var(--color-principal, #ffd000); color: #000; padding: 12px 0; width: 100%; border-radius: 4px; font-family: 'Arial Black', sans-serif; font-size: 12px; text-decoration: none; text-transform: uppercase; transition: all 0.3s ease; border: 2px solid var(--color-principal, #ffd000); display: inline-block; letter-spacing: 1px;"
               onmouseover="this.style.background='transparent'; this.style.color='var(--color-principal, #ffd000)';"
               onmouseout="this.style.background='var(--color-principal, #ffd000)'; this.style.color='#000';">
                Verify Account Instantly
            </a>
            
        </div>
    </div>
</body>
</html>