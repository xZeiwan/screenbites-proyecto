<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Screenbites</title>
    <style>
        :root {
            --color-negro: #000000;
            --color-gris-oscuro: #0a0a0a;
            --color-gris-tarjeta: #141414;
            --color-gris-claro: #333333;
            --color-blanco: #ffffff;
            --color-amarillo: #ffd000;
        }

        html {
            scroll-behavior: smooth;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial Black', 'Arial Bold', sans-serif;
            overflow-x: hidden;
            background-color: var(--color-negro);
            color: var(--color-blanco);
            width: 100%;
        }

        /* --- HEADER --- */
        header {
            position: fixed;
            top: 0; left: 0; right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5% 0 3%;
            height: 100px;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo img { height: 60px; }

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 30px;
        }

        nav a, .logout-btn {
            text-decoration: none;
            color: var(--color-blanco);
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 2px;
            transition: color 0.3s ease, transform 0.2s ease;
            background: none;
            border: none;
            cursor: pointer;
        }

        nav a:hover, .logout-btn:hover {
            color: var(--color-amarillo) !important;
            transform: scale(1.05);
        }

        /* --- NOTIFICACIONES (TOASTS) --- */
        .toast-notification {
            position: fixed;
            top: 120px;
            right: 20px;
            background: #111;
            border-left: 4px solid var(--color-amarillo);
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 9999;
            animation: slideIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, fadeOut 0.5s ease 5s forwards;
        }

        .toast-notification.error {
            border-left-color: #ff4444;
        }

        .toast-notification svg {
            color: var(--color-amarillo);
            width: 28px; height: 28px;
        }

        .toast-notification.error svg {
            color: #ff4444;
        }

        .toast-content h4 {
            color: var(--color-blanco);
            font-size: 15px;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .toast-content p {
            color: #aaa;
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            font-weight: normal;
        }

        @keyframes slideIn {
            from { transform: translateX(120%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes fadeOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(120%); opacity: 0; }
        }

        /* --- CONTACT PAGE --- */
        .page-container { 
            padding: 150px 5% 80px; 
            min-height: 80vh; 
            display: flex; 
            align-items: center; 
        }

        .contact-wrapper { 
            display: flex; 
            gap: 80px; 
            max-width: 1200px; 
            margin: 0 auto; 
            align-items: center; 
            width: 100%; 
        }
        
        .contact-info { flex: 1; }

        .contact-info h1 { 
            font-size: 55px; 
            text-transform: uppercase; 
            margin-bottom: 20px; 
            line-height: 1; 
        }

        .contact-info h1 span { color: var(--color-amarillo); }

        .contact-info p { 
            color: #888; 
            font-family: Arial, sans-serif; 
            font-size: 16px; 
            margin-bottom: 40px; 
            line-height: 1.6; 
            max-width: 500px; 
        }
        
        .contact-details-list { list-style: none; }

        .contact-details-list li { 
            display: flex; 
            align-items: center; 
            gap: 20px; 
            margin-bottom: 25px; 
            color: #ccc; 
            font-family: Arial, sans-serif; 
            font-size: 16px; 
        }

        .contact-details-list svg { 
            color: var(--color-amarillo); 
            width: 28px; height: 28px; 
        }

        .contact-form-box { 
            flex: 1; 
            background: #111; 
            padding: 50px; 
            border-radius: 12px; 
            border: 1px solid #333; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.5); 
        }

        .form-group { margin-bottom: 25px; }

        .form-control { 
            width: 100%; 
            background: #000; 
            border: 1px solid #333; 
            color: white; 
            padding: 18px;
            border-radius: 6px; 
            font-family: Arial, sans-serif; 
            font-size: 14px; 
            outline: none; 
            transition: border-color 0.3s; 
        }

        .form-control:focus { border-color: var(--color-amarillo); }

        textarea.form-control { 
            resize: vertical; 
            min-height: 150px; 
        }

        .btn-submit { 
            width: 100%; 
            background: var(--color-amarillo); 
            color: black; 
            border: none; 
            padding: 18px; 
            font-family: 'Arial Black'; 
            font-size: 14px; 
            text-transform: uppercase; 
            cursor: pointer; 
            border-radius: 6px; 
            transition: 0.3s; 
            margin-top: 10px; 
            letter-spacing: 1px; 
        }

        .btn-submit:hover { 
            background: white; 
            transform: translateY(-3px); 
        }

        @media (max-width: 900px) {
            .contact-wrapper { flex-direction: column; gap: 40px; }
            .page-container { padding-top: 120px; }
        }
    </style>
</head>
<body>
    <header id="main-header">
        <div class="logo">
            <a href="/"><img src="{{ asset('img/img/Logo-Blanco.png') }}" alt="Screenbites Logo"></a>
        </div>
        <nav>
            <ul>
                <li><a href="/">HOME</a></li>
                <li><a href="/#cartelera">FILMS</a></li>
                <li><a href="/#events">EVENTS</a></li>
                <li><a href="{{ route('contact') }}" style="color: var(--color-amarillo);">CONTACT</a></li>
            </ul>
        </nav>
    </header>

    @if(session('success'))
        <div class="toast-notification">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            <div class="toast-content">
                <h4>Success</h4>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="toast-notification error">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            <div class="toast-content">
                <h4>System Error</h4>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="page-container">
        <div class="contact-wrapper">
            <div class="contact-info">
                <h1>Get in<br><span>Touch</span></h1>
                <p>Have a question about our special events, private bookings, or lost items? Drop us a message and our team will get back to you faster than a jump scare.</p>
                
                <ul class="contact-details-list">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <strong>Call Us:</strong> +1 (555) 019-2834
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <strong>Email:</strong> hello@screenbites.com
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <strong>HQ:</strong> 123 Neon Ave, Central District
                    </li>
                </ul>
            </div>
            
            <div class="contact-form-box">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="YOUR NAME" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="YOUR EMAIL" required>
                    </div>
                    <div class="form-group">
                        <select name="topic" class="form-control" required style="appearance: none; cursor: pointer;">
                            <option value="" disabled selected>SELECT A TOPIC...</option>
                            <option value="events">Special Events Inquiry</option>
                            <option value="private">Private VIP Booking</option>
                            <option value="support">General Support / Lost Items</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" placeholder="TELL US MORE..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">SEND MESSAGE</button>
                </form>
            </div>
        </div>
    </div>
    @include('cookie-banner')
</body>
</html>