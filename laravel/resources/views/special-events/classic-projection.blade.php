<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screenbites - 35mm Projection</title>

    <style>
        :root {
            --color-negro: #000000;
            --color-gris-oscuro: #0a0a0a;
            --color-gris-tarjeta: #141414;
            --color-gris-claro: #333333;
            --color-blanco: #ffffff;
            --color-principal: #ffffff; /* Blanco Clásico */
            --color-texto-btn: black;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Arial Black', 'Arial Bold', sans-serif;
            overflow-x: hidden;
            background-color: var(--color-negro);
            color: var(--color-blanco);
            width: 100%;
        }

        /* --- HEADER --- */
        header {
            position: fixed; top: 0; left: 0; right: 0;
            display: flex; justify-content: space-between; align-items: center;
            padding: 0 5% 0 3%; height: 100px; z-index: 1000;
            background-color: transparent; border-bottom: 1px solid transparent;
            transition: background-color 0.3s ease, box-shadow 0.3s ease, border-bottom 0.3s ease;
        }

        header.scrolled {
            background-color: rgba(0, 0, 0, 0.95); backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8); border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo img { height: 60px; }

        nav ul { list-style: none; display: flex; align-items: center; gap: 30px; }
        nav a, nav .logout-btn {
            text-decoration: none; color: var(--color-blanco); text-transform: uppercase;
            font-size: 13px; font-weight: 900; letter-spacing: 2px;
            transition: color 0.3s ease, transform 0.2s ease; background: none;
            border: none; cursor: pointer; display: flex; align-items: center; gap: 8px;
        }
        nav a:hover, nav .logout-btn:hover { color: #ffd000 !important; transform: scale(1.05); }

        .user-nav { display: flex; align-items: center; gap: 20px; border-left: 2px solid rgba(255, 255, 255, 0.2); padding-left: 20px; margin-left: 10px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: var(--color-blanco); transition: color 0.3s ease; }
        .user-profile .user-avatar { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; transition: transform 0.3s ease; }
        .user-profile:hover .user-avatar { transform: scale(1.1); }
        .chevron-icon {
            width: 14px; height: 14px; margin-left: 4px; stroke-width: 2.5;
            transition: color 0.3s ease, transform 0.3s ease; display: inline-block;
        }
        .user-profile:hover .user-name, .user-profile:hover .chevron-icon { color: #ffd000; }

        .nav-cart { position: relative; background: none; border: none; cursor: pointer; display: flex; align-items: center; padding: 5px; color: var(--color-blanco); transition: all 0.3s; }
        .nav-cart svg { width: 26px; height: 26px; }
        .cart-badge { position: absolute; top: -5px; right: -8px; background-color: red; color: white; font-size: 11px; font-weight: bold; width: 18px; height: 18px; border-radius: 50%; display: flex; justify-content: center; align-items: center; pointer-events: none; }
        .nav-cart:hover { color: #ffd000; transform: scale(1.1); }

        /* --- HERO DE MISTERIO --- */
        .movie-hero {
            position: relative; width: 100%; min-height: 75vh;
            display: flex; align-items: center; padding: 120px 5% 40px;
        }

        .backdrop-img {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover; object-position: center; z-index: 1; opacity: 30%;
            background-image: url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?q=80&w=1920');
            background-size: cover; filter: grayscale(100%) blur(5px);
        }

        .backdrop-gradient {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to top, var(--color-negro) 0%, rgba(0, 0, 0, 0.7) 50%, rgba(0,0,0,0.9) 100%);
            z-index: 2;
        }

        .movie-content {
            position: relative; z-index: 10; display: flex; gap: 60px;
            max-width: 1300px; margin: 0 auto; width: 100%; align-items: center;
        }

        /* Póster Animado */
        .mystery-poster {
            width: 320px; height: 480px; border-radius: 12px;
            background: #050505; border: 2px dashed #444; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
            box-shadow: 0 0 50px rgba(255, 255, 255, 0.1);
        }

        .mystery-poster::before {
            content: ''; position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.1), transparent);
            transform: skewX(-20deg); animation: scanline 3s infinite;
        }

        @keyframes scanline {
            0% { left: -100%; } 50% { left: 200%; } 100% { left: 200%; }
        }

        .mystery-poster .glitch-mark {
            font-size: 150px; color: var(--color-principal); font-family: 'Arial Black', sans-serif;
            text-shadow: 2px 2px 0px #555, -2px -2px 0px #222;
            animation: glitch 1.5s infinite;
        }

        @keyframes glitch {
            0% { transform: translate(0); text-shadow: 2px 2px 0px #555, -2px -2px 0px #222; }
            20% { transform: translate(-2px, 2px); text-shadow: -2px -2px 0px #555, 2px 2px 0px #222; }
            40% { transform: translate(-2px, -2px); text-shadow: 2px -2px 0px #555, -2px 2px 0px #222; }
            60% { transform: translate(2px, 2px); text-shadow: -2px 2px 0px #555, 2px -2px 0px #222; }
            80% { transform: translate(2px, -2px); text-shadow: 2px 2px 0px #555, -2px -2px 0px #222; }
            100% { transform: translate(0); text-shadow: 2px 2px 0px #555, -2px -2px 0px #222; }
        }

        .movie-info { flex: 1; }
        .movie-id { color: var(--color-negro); font-size: 14px; font-weight: bold; letter-spacing: 2px; margin-bottom: 10px; display: inline-block; background: var(--color-principal); padding: 5px 10px; border-radius: 4px; }
        .movie-title { font-size: 55px; margin: 0 0 15px 0; text-transform: uppercase; line-height: 1.1; text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8); }
        
        .movie-meta { display: flex; gap: 20px; align-items: center; font-family: Arial, sans-serif; font-size: 14px; margin-bottom: 25px; color: #ddd; }
        .age-badge { border: 2px solid currentColor; padding: 4px 8px; border-radius: 4px; font-weight: bold; }
        .movie-desc { font-family: Arial, sans-serif; line-height: 1.8; color: #ccc; margin-bottom: 35px; font-size: 16px; max-width: 800px; }

        .action-buttons { display: flex; gap: 20px; align-items: center; }
        
        .btn-buy {
            background: var(--color-principal); color: var(--color-texto-btn);
            padding: 15px 35px; font-size: 14px; font-weight: 900; text-transform: uppercase;
            border: none; border-radius: 6px; cursor: pointer; letter-spacing: 1px;
            transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 10px;
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.1);
        }

        .btn-buy:hover { background: #ffd000; color: var(--color-negro); transform: translateY(-3px); box-shadow: 0 15px 25px rgba(255, 208, 0, 0.3); }
        .btn-buy:disabled { background: #333 !important; color: #888 !important; cursor: not-allowed; transform: none; box-shadow: none; }

        .price-tag-big { font-size: 24px; color: var(--color-principal); font-family: 'Arial Black', sans-serif; }

        /* --- CONTENIDO ESPECIAL DEL EVENTO --- */
        .event-details-section { padding: 60px 5%; background-color: var(--color-negro); }
        .container { max-width: 1200px; margin: 0 auto; }
        .section-title { font-size: 28px; font-weight: 900; text-transform: uppercase; letter-spacing: -1px; color: var(--color-blanco); border-left: 5px solid var(--color-principal); padding-left: 15px; margin-bottom: 40px; }

        /* GRID: HOW IT WORKS */
        .mechanics-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-bottom: 80px; }
        .mechanic-card { background: #0a0a0a; border: 1px solid #222; padding: 40px 30px; border-radius: 12px; text-align: center; transition: transform 0.3s; }
        .mechanic-card:hover { transform: translateY(-10px); border-color: #444; }
        .mechanic-icon { width: 60px; height: 60px; background: rgba(255,255,255,0.1); color: var(--color-principal); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 24px; }
        .mechanic-card h3 { font-size: 18px; margin-bottom: 15px; text-transform: uppercase; }
        .mechanic-card p { font-family: Arial, sans-serif; color: #888; font-size: 14px; line-height: 1.6; }

        /* PISTAS (CLUES) */
        .clues-wrapper { background: linear-gradient(135deg, #111, #050505); border-radius: 16px; padding: 50px; border: 1px solid #333; margin-bottom: 80px; position: relative; overflow: hidden; }
        .clues-wrapper::before { content: '🎞'; position: absolute; top: -50px; right: -20px; font-size: 300px; font-family: 'Arial Black', sans-serif; color: rgba(255,255,255,0.02); line-height: 1; z-index: 0; }
        .clues-header { position: relative; z-index: 1; margin-bottom: 30px; }
        .clues-header h3 { color: var(--color-principal); font-size: 24px; text-transform: uppercase; margin-bottom: 10px; }
        .clues-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; position: relative; z-index: 1; }
        .clue-item { background: rgba(0,0,0,0.5); border-left: 3px solid var(--color-principal); padding: 20px; font-family: Arial, sans-serif; color: #ddd; font-style: italic; font-size: 15px; }

        /* THE RULES BOX */
        .rules-box { border: 2px solid var(--color-principal); border-radius: 12px; padding: 40px; background: rgba(255,255,255,0.02); display: flex; gap: 40px; align-items: center; }
        .rules-icon { flex-shrink: 0; color: var(--color-principal); }
        .rules-content h3 { font-size: 20px; text-transform: uppercase; margin-bottom: 15px; }
        .rules-content ul { font-family: Arial, sans-serif; color: #ccc; line-height: 1.8; margin-left: 20px; }
        .rules-content li::marker { color: var(--color-principal); }

        /* --- FOOTER --- */
        footer { background-color: #050505; padding: 60px 5% 40px; border-top: 1px solid var(--color-gris-claro); margin-top: 50px;}
        .footer-content { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 40px; max-width: 1200px; margin: 0 auto; }
        .footer-col { flex: 1; min-width: 200px; }
        .footer-col:first-child { display: flex; flex-direction: column; align-items: center; text-align: center; }
        .footer-logo img { height: 60px; margin-bottom: 20px; display: block; }
        .footer-col p { font-family: Arial, sans-serif; color: #888; font-size: 13px; line-height: 1.6; max-width: 250px; }
        .footer-col h4 { font-size: 16px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px; color: #ffd000; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { color: var(--color-blanco); text-decoration: none; font-family: Arial, sans-serif; font-size: 14px; transition: color 0.3s ease; }
        .footer-links a:hover { color: #ffd000; }
        .footer-bottom { max-width: 1200px; margin: 40px auto 0; padding-top: 20px; border-top: 1px solid var(--color-gris-claro); display: flex; justify-content: space-between; align-items: center; font-family: Arial, sans-serif; font-size: 12px; color: #666; }
        .footer-credits { display: flex; align-items: center; gap: 8px; color: #888; }
        .footer-credits span { color: #ffd000; font-weight: bold; }

        @media (max-width: 900px) {
            .movie-content { flex-direction: column; text-align: center; gap: 30px; }
            .movie-meta, .action-buttons { justify-content: center; }
            .mechanics-grid { grid-template-columns: 1fr; }
            .clues-list { grid-template-columns: 1fr; }
            .rules-box { flex-direction: column; text-align: center; }
            .rules-content ul { list-style-position: inside; margin-left: 0; }
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
                <li><a href="/#bar">MENUS</a></li>
                <li><a href="/#events">EVENTS</a></li>
                <li><a href="{{ route('locations') }}">LOCATIONS</a></li>
                <li><a href="{{ route('contact') }}">CONTACT</a></li>

                @auth
                <div class="user-nav">
                    @if(Auth::user()->role === 'admin')
                    <li>
                        <a href="{{ route('admin.index') }}" style="color: #ff4444 !important; border: 1px solid #ff4444; padding: 5px 10px; border-radius: 4px;">
                            ⚙️ ADMIN
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="/profile" class="user-profile" title="My Profile">
                            <img src="{{ asset('img/avatars/' . Auth::user()->avatar) }}" alt="Avatar" class="user-avatar" onerror="this.src='https://via.placeholder.com/35/333/ffd000'">
                            <span class="user-name">{{ strtoupper(Auth::user()->name) }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                    </li>
                    <li>
                        <button class="nav-cart" onclick="window.location.href='/cart'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                            <div class="cart-badge" id="nav-cart-counter">0</div>
                        </button>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn" title="Sign Out">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            </button>
                        </form>
                    </li>
                </div>
                @else
                <div class="user-nav">
                    <li>
                        <a href="{{ route('login') }}" title="Sign In">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" title="Create Account">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="19" y1="8" x2="19" y2="14"></line><line x1="22" y1="11" x2="16" y2="11"></line></svg>
                        </a>
                    </li>
                </div>
                @endauth
            </ul>
        </nav>
    </header>

    <div class="movie-hero">
        <div class="backdrop-img"></div>
        <div class="backdrop-gradient"></div>

        <div class="movie-content">
            <div class="mystery-poster">
                <span class="glitch-mark">🎞</span>
            </div>

            <div class="movie-info">
                <span class="movie-id">VINTAGE SERIES</span>
                <h1 class="movie-title">Classic 35mm: Casablanca</h1>

                <div class="movie-meta">
                    <span class="age-badge">TP</span>
                    <span>Analog / Drama</span>
                    <span>Approx. 1h 45m</span>
                    <span style="color: var(--color-principal); font-weight: bold;">December 01 • 20:00</span>
                </div>

                <p class="movie-desc">Vuelve a los orígenes. Una experiencia cinematográfica pura proyectada en película física original. Siente el grano, el sonido y la magia del proyector clásico en tu sala.</p>

                <div class="action-buttons">
                    <span class="price-tag-big">$8.00</span>

                    @auth
                        @php
                            // Lógica de fecha: El evento se abre el 1 de Dic de 2026
                            $eventDate = \Carbon\Carbon::create(2026, 12, 1, 20, 0, 0);
                            $isOpen = now()->greaterThanOrEqualTo($eventDate);

                            $yaTieneEsteEvento = \Illuminate\Support\Facades\DB::table('bookings')
                                ->where('user_id', Auth::id())
                                ->where('event_id', '35mm-01')
                                ->exists();
                        @endphp

                        @if($yaTieneEsteEvento)
                            <div style="position: relative;">
                                <button class="btn-buy" style="background: #333; color: #888; cursor: not-allowed; box-shadow: none;" disabled>
                                    <img src="{{ asset('img/img/Ticket-amarillo.png') }}" style="width:20px; filter: grayscale(1) opacity(0.5);"> 
                                    <span>TICKET CLAIMED</span>
                                </button>
                                <div style="position: absolute; top: 100%; left: 0; margin-top: 8px; background: #388e3c; color: white; padding: 4px 10px; border-radius: 4px; font-size: 10px; font-family: 'Arial Black', sans-serif; letter-spacing: 1px; white-space: nowrap;">
                                    ✓ ALREADY PURCHASED
                                </div>
                            </div>
                        @elseif(!$isOpen)
                            <div style="position: relative;">
                                <button class="btn-buy" style="background: #333; color: #888; cursor: not-allowed; box-shadow: none;" disabled>
                                    <img src="{{ asset('img/img/Ticket-amarillo.png') }}" style="width:20px; filter: grayscale(1) opacity(0.5);"> 
                                    <span>NOT YET OPEN</span>
                                </button>
                                <div style="position: absolute; top: 100%; left: 0; margin-top: 8px; color: #aaa; padding: 4px 10px; font-size: 10px; font-family: 'Arial Black', sans-serif; letter-spacing: 1px; white-space: nowrap;">
                                    AVAILABLE ON DEC 01
                                </div>
                            </div>
                        @else
                            <div>
                                <button class="btn-buy" onclick="addEventTicketToCart()">
                                    <img src="{{ asset('img/img/Ticket-amarillo.png') }}" style="width:20px; filter: invert(1);"> 
                                    <span>BOOK TICKETS</span>
                                </button>
                            </div>
                        @endif
                    @else
                        <button class="btn-buy" onclick="window.location.href='/login'">
                            <img src="{{ asset('img/img/Ticket-amarillo.png') }}" style="width:20px; filter: invert(1);"> LOGIN TO BOOK
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <section class="event-details-section">
        <div class="container">
            
            <h2 class="section-title">How It Works</h2>
            <div class="mechanics-grid">
                <div class="mechanic-card">
                    <div class="mechanic-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"></path></svg>
                    </div>
                    <h3>1. Analog Magic</h3>
                    <p>Authentic 35mm film projection. Feel the grain and the unique texture of celluloid.</p>
                </div>
                <div class="mechanic-card">
                    <div class="mechanic-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    </div>
                    <h3>2. The Machine</h3>
                    <p>Our 1950s analog projector has been restored piece by piece for this special screening.</p>
                </div>
                <div class="mechanic-card">
                    <div class="mechanic-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    </div>
                    <h3>3. History Lesson</h3>
                    <p>Receive a booklet with technical details and historical context of the movie upon entry.</p>
                </div>
            </div>

            <div class="clues-wrapper">
                <div class="clues-header">
                    <h3>Projection Details</h3>
                    <p style="color: #aaa; font-family: Arial, sans-serif;">La magia del cine clásico vuelve a la gran pantalla:</p>
                </div>
                <div class="clues-list">
                    <div class="clue-item">"The print used is an original 1940s distribution copy, preserved in climate control."</div>
                    <div class="clue-item">"Expect some authentic flicker and reel change marks - the heartbeat of real cinema."</div>
                    <div class="clue-item">"Includes a pre-show talk about why 35mm remains the gold standard for film purists."</div>
                    <div class="clue-item">"A special sepia-toned vintage menu will be available at the bar during this event."</div>
                </div>
            </div>

            <div class="rules-box">
                <div class="rules-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
                <div class="rules-content">
                    <h3>The Rules of the Screening</h3>
                    <ul>
                        <li><strong>Respect the Print:</strong> The analog film is extremely delicate. Expect slight imperfections in the image or sound, it's part of the experience.</li>
                        <li><strong>No Flash:</strong> No se permite el uso de flash fotográfico.</li>
                        <li><strong>Punctuality:</strong> Las puertas se cerrarán 5 minutos antes del inicio.</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-col">
                <div class="footer-logo"><img src="{{ asset('img/img/Logo-Blanco.png') }}" alt="Cine Screenbites"></div>
                <p>Experience cinema like never before. Grab your popcorn, find your seat, and let the magic begin.</p>
            </div>
            <div class="footer-col">
                <h4>Explore</h4>
                <ul class="footer-links">
                    <li><a href="/#cartelera">Now Playing</a></li>
                    <li><a href="/#cartelera">Coming Soon</a></li>
                    <li><a href="/#bar">Food & Drinks</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <ul class="footer-links">
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Follow Us</h4>
                <ul class="footer-links">
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Twitter / X</a></li>
                    <li><a href="#">TikTok</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Screenbites Cinema. All rights reserved.</p>
            <p class="footer-credits">
                Design for <span>Beni</span>
            </p>
        </div>
    </footer>

    <script>
        const CART_KEY = 'screenbites_cart_{{ Auth::check() ? Auth::id() : "guest" }}';

        // HEADER SCROLL EFFECT
        const headerEl = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                headerEl.classList.add('scrolled');
            } else {
                headerEl.classList.remove('scrolled');
            }
        });

        // CART BADGE UPDATE
        document.addEventListener('DOMContentLoaded', () => {
            updateCartBadge();
        });

        function updateCartBadge() {
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            let totalOrders = globalCart.length;

            const badge = document.querySelector('.cart-badge');
            if(badge) {
                badge.innerText = totalOrders;
                if(totalOrders > 0) {
                    badge.style.transform = 'scale(1.2)';
                    setTimeout(() => badge.style.transform = 'scale(1)', 200);
                }
            }
        }

        function addEventTicketToCart() {
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            
            let eventOrder = {
                id: 'ORD-35M-' + Date.now(),
                movieId: '35mm-01',
                movieTitle: 'Classic 35mm: Casablanca',
                color: '#ffffff',
                textColor: 'black',
                tickets: { seats: 'Classic Seat', price: 8.00 },
                food: [],
                orderTotal: 8.00
            };

            globalCart.push(eventOrder);
            localStorage.setItem(CART_KEY, JSON.stringify(globalCart));
            updateCartBadge();
            
            window.location.href = '/cart';
        }
    </script>
</body>
</html>