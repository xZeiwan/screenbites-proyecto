<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { margin: 0; padding: 0; font-family: 'Arial', sans-serif; background-color: #000; color: #fff; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #111; padding: 40px 20px; border-top: 5px solid #ffd000; text-align: center; }
        .header { color: #ffd000; font-family: 'Arial Black', sans-serif; font-size: 28px; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 2px; }
        .divider { border-top: 1px dashed #ffd000; margin: 20px 0; }
        .content { font-size: 16px; color: #ccc; line-height: 1.6; margin-bottom: 30px; }
        .btn { display: inline-block; background-color: #ffd000; color: #000; text-decoration: none; padding: 15px 30px; font-family: 'Arial Black', sans-serif; font-size: 16px; font-weight: 900; text-transform: uppercase; border-radius: 4px; margin-bottom: 30px; }
        .footer { font-size: 12px; color: #666; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">CINE SCREENBITES</div>
        <div class="divider"></div>
        
        <div class="content">
            <h2>Hello, {{ $user->name }}!</h2>
            <p>Thanks for registering at Screenbites Cinema. To be able to purchase tickets and access your profile, we need to confirm that this email belongs to you.</p>
        </div>

        <a href="{{ $url }}" class="btn">VERIFY MY ACCOUNT</a>

        <div class="content" style="font-size: 13px;">
            <p>If the button doesn't work, copy and paste this link in your browser:</p>
            <p style="word-break: break-all; color: #ffd000;">{{ $url }}</p>
        </div>

        <div class="footer">
            If you haven't created an account at Screenbites, please ignore this message.
        </div>
    </div>
    @include('cookie-banner')
</body>
</html>