<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screenbites Cinema - My Profile</title>

    <style>
        :root {
            --color-negro: #000000;
            --color-gris-oscuro: #0a0a0a;
            --color-gris-tarjeta: #141414;
            --color-gris-claro: #333333;
            --color-blanco: #ffffff;
            --color-amarillo: #ffd000;
            --glass: rgba(255, 255, 255, 0.03);
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
            background-image: radial-gradient(circle at 50% 0%, #1a1a1a 0%, #000 70%);
            color: var(--color-blanco);
            width: 100%;
        }

        /* --- HEADER (Original Respetado) --- */
        header {
            position: fixed;
            top: 0; left: 0; right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5%;
            height: 100px;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .chevron-icon {
            width: 14px;     
            height: 14px;
            margin-left: 2px; 
            stroke-width: 2.5; 
            transition: transform 0.3s ease;
            display: inline-block;
        }

        header .logo img { height: 50px; }
        header nav ul { list-style: none; display: flex; align-items: center; gap: 30px; }
        header nav a, header nav .logout-btn {
            text-decoration: none; color: var(--color-blanco);
            text-transform: uppercase; font-size: 13px; font-weight: 900;
            letter-spacing: 2px; transition: all 0.3s ease;
            background: none; border: none; cursor: pointer;
            display: flex; align-items: center; gap: 8px;
        }
        header nav a:hover, header nav .logout-btn:hover { color: var(--color-amarillo) !important; transform: scale(1.05); }

        .user-nav { display: flex; align-items: center; gap: 20px; border-left: 2px solid rgba(255, 255, 255, 0.2); padding-left: 20px; margin-left: 10px; }
        .user-profile { display: flex; align-items: center; gap: 10px; color: var(--color-amarillo); text-decoration: none; }
        .user-profile .user-avatar { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid var(--color-amarillo); }
        
        .nav-cart { position: relative; background: none; border: none; cursor: pointer; color: var(--color-blanco); display: flex; align-items: center; padding: 5px; transition: all 0.3s; }
        .nav-cart svg { width: 26px; height: 26px; }
        .cart-badge { position: absolute; top: -5px; right: -8px; background-color: red; color: white; font-size: 11px; font-weight: bold; width: 18px; height: 18px; border-radius: 50%; display: flex; justify-content: center; align-items: center; }
        .nav-cart:hover { color: var(--color-amarillo); transform: scale(1.1); }

        /* --- PROFILE LAYOUT PREMIUM --- */
        .profile-container {
            max-width: 1200px;
            margin: 160px auto 100px;
            padding: 0 5%;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 40px;
        }

        .profile-sidebar {
            background: var(--glass);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 20px;
            padding: 30px;
            height: fit-content;
            backdrop-filter: blur(10px);
        }

        .user-card-info {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .main-avatar-wrapper { position: relative; width: 100px; height: 100px; margin: 0 auto 15px; }
        .main-avatar { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 3px solid var(--color-amarillo); box-shadow: 0 0 20px rgba(255, 208, 0, 0.2); }

        .role-label { font-family: Arial, sans-serif; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; color: #888; margin-top: 8px; }

        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 8px; }
        .tab-btn {
            width: 100%; background: transparent; border: none;
            color: #777; padding: 14px 20px; font-size: 13px;
            font-family: 'Arial Black', sans-serif; text-transform: uppercase;
            cursor: pointer; border-radius: 12px; transition: all 0.3s ease;
            display: flex; align-items: center; gap: 12px;
        }
        .tab-btn svg { width: 18px; height: 18px; }
        .tab-btn:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .tab-btn.active { background: var(--color-amarillo); color: var(--color-negro); transform: scale(1.02); }

        .profile-content {
            background: var(--glass);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(10px);
        }

        .content-title { font-size: 28px; text-transform: uppercase; letter-spacing: -1px; margin-bottom: 10px; border-bottom: 1px solid #333; padding-bottom: 15px; color: var(--color-amarillo); }
        .content-desc { font-family: Arial, sans-serif; color: #aaa; font-size: 14px; margin-bottom: 35px; }

        .tab-content { display: none; animation: slideUp 0.4s ease forwards; }
        .tab-content.active { display: block; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* AVATARES */
        .avatar-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(70px, 1fr)); gap: 15px; margin: 20px 0 35px; }
        .avatar-option { width: 70px; height: 70px; border-radius: 15px; cursor: pointer; border: 2px solid transparent; transition: all 0.3s ease; filter: grayscale(1); opacity: 0.6; object-fit: cover;}
        .avatar-option.selected { border-color: var(--color-amarillo); filter: grayscale(0); opacity: 1; transform: scale(1.1); }

        /* FORMULARIOS */
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; color: #888; font-size: 11px; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 1px; font-weight: bold; }
        .form-group input { width: 100%; background: rgba(0,0,0,0.3); border: 1px solid #333; color: #fff; padding: 15px; border-radius: 10px; font-family: Arial, sans-serif; transition: all 0.3s; }
        .form-group input:focus { outline: none; border-color: var(--color-amarillo); }

        .btn-save { background: var(--color-amarillo); color: #000; border: none; padding: 16px 40px; border-radius: 10px; font-weight: 900; text-transform: uppercase; cursor: pointer; transition: all 0.3s; letter-spacing: 1px; }
        .btn-save:hover { background: #fff; transform: translateY(-2px); }

        /* BOOKINGS */
        .booking-card { background: rgba(255,255,255,0.02); border: 1px solid #222; border-radius: 15px; display: flex; overflow: hidden; margin-bottom: 20px; }
        .booking-poster { width: 120px; flex-shrink: 0; }
        .booking-poster img { width: 100%; height: 100%; object-fit: cover; }
        .booking-info { flex: 1; padding: 20px; display: flex; flex-direction: column; justify-content: center; }
        .booking-info h3 { font-size: 20px; margin-bottom: 5px; }
        .booking-info p { font-family: Arial, sans-serif; font-size: 13px; color: #888; }

        /* --- FOOTER (Original Respetado) --- */
        footer { background-color: var(--color-negro); padding: 60px 5% 40px; border-top: 1px solid var(--color-gris-claro); }
        .footer-content { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 40px; max-width: 1200px; margin: 0 auto; }
        .footer-col { flex: 1; min-width: 200px; }
        .footer-col:first-child { display: flex; flex-direction: column; align-items: center; text-align: center; }
        .footer-logo img { height: 60px; margin-bottom: 20px; }
        .footer-col p { font-family: Arial, sans-serif; color: #888; font-size: 13px; line-height: 1.6; }
        .footer-col h4 { font-size: 16px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px; color: var(--color-amarillo); }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { color: var(--color-blanco); text-decoration: none; font-family: Arial, sans-serif; font-size: 14px; transition: color 0.3s ease; }
        .footer-links a:hover { color: var(--color-amarillo); }
        .footer-bottom { max-width: 1200px; margin: 40px auto 0; padding-top: 20px; border-top: 1px solid var(--color-gris-claro); display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #666; font-family: Arial, sans-serif; }
        .footer-credits { display: flex; align-items: center; gap: 8px; color: #888; }
        .footer-credits span { color: var(--color-amarillo); font-weight: bold; }
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

                @auth
                <div class="user-nav">
                    <li>
                        <a href="/profile" class="user-profile" title="My Profile">
                            <img src="{{ asset('img/avatars/' . Auth::user()->avatar) }}" alt="Avatar" class="user-avatar" onerror="this.src='https://via.placeholder.com/35/333/ffd000'">
                            <span class="user-name">{{ strtoupper(Auth::user()->name) }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </a>
                    </li>

                    <li>
                        <button class="nav-cart" onclick="window.location.href='/cart'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            <div class="cart-badge" id="nav-cart-counter">0</div>
                        </button>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                            </button>
                        </form>
                    </li>
                </div>
                @endauth
            </ul>
        </nav>
    </header>

    <div class="profile-container">
        
        <aside class="profile-sidebar">
            <div class="user-card-info">
                <div class="main-avatar-wrapper">
                    <img src="{{ asset('img/avatars/' . Auth::user()->avatar) }}" id="sidebar-avatar" class="main-avatar" onerror="this.src='https://via.placeholder.com/100/333/ffd000'">
                </div>
                <h2>{{ Auth::user()->name }}</h2>
                <p class="role-label">
                    @if(Auth::user()->role === 'admin') Administrator
                    @elseif(Auth::user()->role === 'vip') VIP Member
                    @else Standard Member @endif
                </p>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <button class="tab-btn active" data-target="tab-profile">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Profile Settings
                    </button>
                </li>
                <li>
                    <button class="tab-btn" data-target="tab-security">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        Security
                    </button>
                </li>
                <li>
                    <button class="tab-btn" data-target="tab-bookings">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        My Bookings
                    </button>
                </li>
            </ul>
        </aside>

        <main class="profile-content">
            <div id="tab-profile" class="tab-content active">
                <h2 class="content-title">Account Details</h2>
                <p class="content-desc">Manage your public information and choose a custom character avatar.</p>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf @method('PATCH')
                    
                    <label class="form-group"><label>Character Avatar</label></label>
                    <div class="avatar-grid">
                        <input type="hidden" name="avatar" id="avatar-input" value="{{ Auth::user()->avatar ?? 'avatar1.png' }}">
                        @for ($i = 1; $i <= 6; $i++)
                            @php $imgName = 'avatar'.$i.'.png'; @endphp
                            <img src="{{ asset('img/avatars/'.$imgName) }}" 
                                 class="avatar-option {{ Auth::user()->avatar == $imgName ? 'selected' : '' }}" 
                                 onclick="selectAvatar(this, '{{ $imgName }}')">
                        @endfor
                    </div>

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <button type="submit" class="btn-save">Save Changes</button>
                </form>
            </div>

            <div id="tab-security" class="tab-content">
                <h2 class="content-title">Security & Password</h2>
                <p class="content-desc">Ensure your account is protected with a strong password.</p>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf @method('PUT')
                    <div class="form-group"><label>Current Password</label><input type="password" name="current_password" required></div>
                    <div class="form-group"><label>New Password</label><input type="password" name="password" required></div>
                    <div class="form-group"><label>Confirm Password</label><input type="password" name="password_confirmation" required></div>
                    <button type="submit" class="btn-save">Update Password</button>
                </form>
            </div>

            <div id="tab-bookings" class="tab-content">
                <h2 class="content-title">My Tickets</h2>
                <p class="content-desc">Review your upcoming and past movie experiences.</p>

                @if($bookings->isEmpty())
                    <div style="text-align: center; padding: 40px; color: #666; background: rgba(0,0,0,0.2); border-radius: 12px; border: 1px dashed #333;">
                        <p>You haven't booked any tickets yet.</p>
                        <a href="/#cartelera" style="color: var(--color-amarillo); text-decoration: none; margin-top: 10px; display: inline-block; font-weight: bold;">Browse Movies</a>
                    </div>
                @else
                    <div style="display: flex; gap: 30px; margin-bottom: 30px; border-bottom: 1px solid #333;">
                        <button class="ticket-tab" onclick="filterTickets('active', this)" 
                                style="background: none; border: none; border-bottom: 3px solid var(--color-amarillo); color: #fff; padding-bottom: 10px; font-family: 'Arial Black', sans-serif; font-size: 14px; cursor: pointer; text-transform: uppercase; transition: all 0.3s;">
                            Active Tickets
                        </button>
                        <button class="ticket-tab" onclick="filterTickets('expired', this)" 
                                style="background: none; border: none; border-bottom: 3px solid transparent; color: #888; padding-bottom: 10px; font-family: 'Arial Black', sans-serif; font-size: 14px; cursor: pointer; text-transform: uppercase; transition: all 0.3s;">
                            Expired Tickets
                        </button>
                    </div>

                    @foreach($bookings as $booking)
                        @php
                            $movie = $movieData[$booking->movie_id] ?? ['title' => 'Película Desconocida', 'poster' => ''];
                            
                            // Lógica de expiración
                            $sessionDateTime = \Carbon\Carbon::parse($booking->movie_date . ' ' . $booking->movie_time);
                            $isExpired = $sessionDateTime->isPast();
                            
                            // Clase CSS dinámica para el filtro de Javascript
                            $statusClass = $isExpired ? 'ticket-expired' : 'ticket-active';
                        @endphp

                        <div class="booking-card {{ $statusClass }}" style="padding: 20px; border: 1px solid #333; border-radius: 8px; margin-bottom: 20px; background: #111; display: flex; gap: 20px; align-items: flex-start; {{ $isExpired ? 'filter: grayscale(1); opacity: 0.6;' : '' }} transition: all 0.3s;">
                            
                            <div style="width: 100px; flex-shrink: 0;">
                                <img src="{{ $movie['poster'] }}" alt="Poster" onerror="this.src='https://via.placeholder.com/100x150/222/ffd000'" style="width: 100%; border-radius: 6px; object-fit: cover;">
                            </div>

                            <div style="flex: 1; display: flex; flex-direction: column;">
                                
                                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                    <div>
                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                                            <span style="font-size: 11px; color: var(--color-amarillo); font-weight: bold; letter-spacing: 1px;">BOOKING ID: #BKG-{{ $booking->id }}</span>
                                            
                                            @if($isExpired)
                                                <span style="background: #d32f2f; color: #fff; font-size: 10px; font-family: 'Arial Black', sans-serif; padding: 2px 8px; border-radius: 12px; letter-spacing: 1px;">EXPIRED</span>
                                            @else
                                                <span style="background: #388e3c; color: #fff; font-size: 10px; font-family: 'Arial Black', sans-serif; padding: 2px 8px; border-radius: 12px; letter-spacing: 1px;">ACTIVE</span>
                                            @endif
                                        </div>

                                        <h3 style="margin: 5px 0 10px 0; font-size: 24px; text-transform: uppercase;">{!! $movie['title'] !!}</h3>
                                        <p style="color: #ccc; font-size: 14px; margin: 0;">
                                            <strong>{{ \Carbon\Carbon::parse($booking->movie_date)->format('d M, Y') }}</strong> • 
                                            {{ \Carbon\Carbon::parse($booking->movie_time)->format('H:i') }} • 
                                            {{ $booking->room_name }}
                                        </p>
                                    </div>

                                    <div style="text-align: right;">
                                        <p style="font-family: 'Arial Black'; font-size: 24px; color: #fff; margin: 0 0 10px 0;">${{ number_format($booking->total_price, 2) }}</p>
                                        <button onclick="toggleDetails({{ $booking->id }})"
                                                style="background: transparent; border: 1px solid #555; color: #ccc; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-size: 11px; text-transform: uppercase; font-weight: bold; transition: all 0.3s;">
                                            View Details
                                        </button>
                                    </div>
                                </div>

                                <div id="details-{{ $booking->id }}" style="display: none; margin-top: 20px; padding-top: 15px; border-top: 1px dashed #444;">
                                    <h4 style="color: var(--color-amarillo); margin-bottom: 20px; font-size: 16px; font-family: 'Arial Black', 'Arial Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.5px;">Order Summary</h4>

                                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                                        <span style="color: #999; font-size: 12px; font-family: 'Arial Black', 'Arial Bold', sans-serif; text-transform: uppercase; letter-spacing: 1.5px;">Seats</span>
                                        <span style="color: #fff; font-size: 12px; font-family: 'Arial Black', 'Arial Bold', sans-serif; letter-spacing: 1px;">{{ $booking->seats }}</span>
                                    </div>

                                    @php
                                        $foodItems = !empty($booking->food) ? json_decode($booking->food, true) : [];
                                    @endphp

                                    @if(!empty($foodItems))
                                        <div style="margin-top: 20px;">
                                            <span style="color: #999; font-size: 12px; font-family: 'Arial Black', 'Arial Bold', sans-serif; text-transform: uppercase; margin-bottom: 12px; display: block; letter-spacing: 1.5px;">Food & Drinks</span>
                                            @foreach($foodItems as $item)
                                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                                    <span style="color: #ddd; font-size: 14px; font-family: 'Arial Black', 'Arial Bold', sans-serif;">{{ $item['qty'] }}x {{ $item['name'] }}</span>
                                                    <span style="color: #fff; font-size: 14px; font-family: 'Arial Black', 'Arial Bold', sans-serif;">${{ number_format($item['total'], 2) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </main>
    </div>

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
            <p class="footer-credits">Design with <svg style="width:14px; color:red; display:inline;" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg> for <span>Beni</span></p>
        </div>
    </footer>

    <script>
        // Creamos una llave única basada en el ID del usuario logueado. 
        // Si no está logueado, usará la caja "guest".
        const CART_KEY = 'screenbites_cart_{{ Auth::check() ? Auth::id() : "guest" }}';

        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById(btn.dataset.target).classList.add('active');
            });
        });

        function selectAvatar(img, filename) {
            document.querySelectorAll('.avatar-option').forEach(i => i.classList.remove('selected'));
            img.classList.add('selected');
            document.getElementById('avatar-input').value = filename;
            document.getElementById('sidebar-avatar').src = img.src;
        }

        function updateCartBadge() {
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            const badge = document.getElementById('nav-cart-counter');
            if(badge) badge.innerText = globalCart.length;
        }
        document.addEventListener('DOMContentLoaded', updateCartBadge);

        function showReceipt(movieId, seats, total) {
            document.getElementById('modal-movie-title').innerText = "Movie ID: " + movieId;
            document.getElementById('modal-seats').innerText = seats;
            document.getElementById('modal-total').innerText = "$" + parseFloat(total).toFixed(2);
            
            document.getElementById('receipt-modal').classList.add('active');
        }

        function closeReceipt() {
            document.getElementById('receipt-modal').classList.remove('active');
        }

        // Estilo extra para el botón de detalles
        document.addEventListener('DOMContentLoaded', () => {
            const style = document.createElement('style');
            style.innerHTML = `
                .view-details-btn:hover {
                    border-color: var(--color-amarillo) !important;
                    color: var(--color-amarillo) !important;
                }
            `;
            document.head.appendChild(style);
        });

        function toggleDetails(bookingId) {
            const detailsDiv = document.getElementById('details-' + bookingId);
            
            // Si está oculto, lo mostramos. Si está visible, lo ocultamos.
            if (detailsDiv.style.display === 'none') {
                detailsDiv.style.display = 'block';
            } else {
                detailsDiv.style.display = 'none';
            }
        }

        // Filtro de tickets
        function filterTickets(status, btnElement) {
            // 1. Quitar el estado 'activo' de todos los botones y ponérselo al que hemos clicado
            const allTabs = document.querySelectorAll('.ticket-tab');
            allTabs.forEach(tab => {
                tab.style.borderBottom = '3px solid transparent';
                tab.style.color = '#888';
            });
            btnElement.style.borderBottom = '3px solid var(--color-amarillo)';
            btnElement.style.color = '#fff';

            // 2. Mostrar u ocultar las tarjetas según su clase
            const allCards = document.querySelectorAll('.booking-card');
            allCards.forEach(card => {
                if (card.classList.contains('ticket-' + status)) {
                    card.style.display = 'flex'; // Usamos flex porque tu diseño depende de ello
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Ejecutar el filtro nada más cargar la página para que muestre los Activos por defecto
        document.addEventListener('DOMContentLoaded', () => {
            const activeTabBtn = document.querySelector('.ticket-tab'); // Selecciona el primer botón (Activos)
            if(activeTabBtn) {
                filterTickets('active', activeTabBtn);
            }
        });
    </script>

    <div id="receipt-modal" class="custom-modal-overlay">
        <div class="custom-modal-box" style="max-width: 350px; border-color: #fff;">
            <h3 id="modal-movie-title">Order Summary</h3>
            <div style="text-align: left; background: #111; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px dashed #333;">
                <p style="font-size: 12px; margin-bottom: 10px;">SEATS: <span id="modal-seats" style="color: var(--color-amarillo); font-weight: bold;"></span></p>
                <p style="font-size: 12px; margin-bottom: 10px;">STATUS: <span style="color: #4ade80;">● Confirmed</span></p>
                <hr style="border: 0; border-top: 1px solid #222; margin: 15px 0;">
                <p style="display: flex; justify-content: space-between; font-weight: bold;">
                    <span>TOTAL PAID</span>
                    <span id="modal-total" style="color: var(--color-amarillo);"></span>
                </p>
            </div>
            <button onclick="closeReceipt()" id="close-modal-btn">CLOSE</button>
        </div>
    </div>
</body>
</html>