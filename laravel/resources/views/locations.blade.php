<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations - Screenbites</title>
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

        /* --- HERO BACKGROUND --- */
        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 1;
            transition: opacity 0.4s ease;

            &.fade {
                opacity: 0.2;
            }
        }

        /* --- HEADER --- */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5% 0 3%;
            height: 100px;
            z-index: 1000;
            background-color: transparent;
            border-bottom: 1px solid transparent;
            transition: background-color 0.3s ease, box-shadow 0.3s ease, border-bottom 0.3s ease;

            &.scrolled {
                background-color: rgba(0, 0, 0, 0.95);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .logo img {
                height: 60px;
            }

            nav {
                ul {
                    list-style: none;
                    display: flex;
                    align-items: center;
                    gap: 30px;
                }

                a,
                .logout-btn {
                    text-decoration: none;
                    color: var(--header-text-color);
                    text-transform: uppercase;
                    font-size: 13px;
                    font-weight: 900;
                    letter-spacing: 2px;
                    transition: color 0.3s ease, transform 0.2s ease;
                    background: none;
                    border: none;
                    cursor: pointer;
                    padding: 0;
                    display: flex;
                    align-items: center;
                    gap: 8px;

                    &:hover {
                        color: var(--hover-color, var(--color-amarillo)) !important;
                        transform: scale(1.05);
                    }
                }
            }
        }

        /* --- USER NAVIGATION --- */
        .user-nav {
            display: flex;
            align-items: center;
            gap: 20px;
            border-left: 2px solid rgba(255, 255, 255, 0.2);
            padding-left: 20px;
            margin-left: 10px;

            .user-profile {
                display: flex;
                align-items: center;
                gap: 10px;
                color: var(--header-text-color);
                transition: color 0.3s ease;

                .user-avatar {
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                    object-fit: cover;
                    border: none;
                    transition: transform 0.3s ease;
                }

                .user-name,
                .chevron-icon {
                    color: var(--header-text-color);
                    transition: color 0.3s ease;
                }

                .chevron-icon {
                    width: 16px;
                    height: 16px;
                }

                &:hover {
                    .user-avatar {
                        transform: scale(1.1);
                    }
                    .user-name,
                    .chevron-icon {
                        color: var(--hover-color, var(--color-amarillo)) !important;
                    }
                }
            }

            .nav-cart {
                position: relative;
                background: none;
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                padding: 5px;
                color: var(--header-text-color);
                transition: color 0.3s ease, transform 0.2s ease;

                svg {
                    width: 26px;
                    height: 26px;
                }

                .cart-badge {
                    position: absolute;
                    top: -5px;
                    right: -8px;
                    background-color: red;
                    color: white;
                    font-size: 11px;
                    font-weight: bold;
                    font-family: Arial, sans-serif;
                    width: 18px;
                    height: 18px;
                    border-radius: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
                    pointer-events: none;
                }

                &:hover {
                    color: var(--hover-color, var(--color-amarillo)) !important;
                    transform: scale(1.1);
                }
            }
        }

        /* ESTILOS DE LA SECCIÓN */
        .page-container { padding: 150px 5% 80px; min-height: 80vh; }
        .page-header { text-align: center; margin-bottom: 60px; }
        .page-header h1 { font-size: 50px; text-transform: uppercase; margin-bottom: 15px; }
        .page-header h1 span { color: var(--color-amarillo); }
        .page-header p { font-family: Arial, sans-serif; color: #888; font-size: 16px; max-width: 600px; margin: 0 auto; line-height: 1.6; }
        
        .locations-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; max-width: 1200px; margin: 0 auto; }
        .location-card { background: #111; border: 1px solid #333; border-radius: 8px; overflow: hidden; transition: transform 0.3s ease, border-color 0.3s; }
        .location-card:hover { transform: translateY(-10px); border-color: var(--color-amarillo); box-shadow: 0 15px 30px rgba(255,208,0,0.1); }
        .location-img { width: 100%; height: 250px; object-fit: cover; filter: grayscale(0.8); transition: 0.3s; }
        .location-card:hover .location-img { filter: grayscale(0); }
        .location-info { padding: 30px; text-align: center; }
        .location-info h3 { margin-bottom: 10px; font-size: 24px; text-transform: uppercase; }
        .location-info p { color: #aaa; font-family: Arial, sans-serif; font-size: 14px; margin-bottom: 25px; line-height: 1.6; }
        .btn-map { background: transparent; color: var(--color-amarillo); border: 1px solid var(--color-amarillo); padding: 12px 20px; font-size: 12px; font-weight: 900; cursor: pointer; text-transform: uppercase; border-radius: 4px; transition: 0.3s; width: 100%; letter-spacing: 1px; }
        .btn-map:hover { background: var(--color-amarillo); color: black; }
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

    <div class="page-container">
        <div class="page-header">
            <h1>Our <span>Cinemas</span></h1>
            <p>Find the closest Screenbites experience. Premium screens, immersive sound, and our signature gourmet menu waiting for you.</p>
        </div>
        
        <div class="locations-grid">
            <div class="location-card">
                <img src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=800" alt="Downtown Cinema" class="location-img">
                <div class="location-info">
                    <h3>SB Downtown</h3>
                    <p>123 Neon Avenue, Central District<br>Open: 10:00 AM - 02:00 AM<br>Screens: 12 (IMAX Available)</p>
                    <button class="btn-map" onclick="alert('Map preview mode!')">View on Map</button>
                </div>
            </div>
            
            <div class="location-card">
                <img src="https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?q=80&w=800" alt="Riverside Cinema" class="location-img">
                <div class="location-info">
                    <h3>SB Riverside</h3>
                    <p>45 Waterway Blvd, Westside<br>Open: 12:00 PM - 01:00 AM<br>Screens: 8 (Dolby Atmos)</p>
                    <button class="btn-map" onclick="alert('Map preview mode!')">View on Map</button>
                </div>
            </div>
            
            <div class="location-card">
                <img src="https://images.unsplash.com/photo-1598899134739-24c46f58b8c0?q=80&w=800" alt="Vintage Cinema" class="location-img">
                <div class="location-info">
                    <h3>SB Vintage</h3>
                    <p>88 Old Town Square, East Side<br>Open: 16:00 PM - 00:00 AM<br>Screens: 2 (35mm Analog Projectors)</p>
                    <button class="btn-map" onclick="alert('Map preview mode!')">View on Map</button>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>