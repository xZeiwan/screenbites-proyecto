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
        
        .contact-info { 
            flex: 1; 
        }

        .contact-info h1 { 
            font-size: 55px; 
            text-transform: uppercase; 
            margin-bottom: 20px; 
            line-height: 1; 
        }

        .contact-info h1 span { 
            color: var(--color-amarillo); 
        }

        .contact-info p { 
            color: #888; 
            font-family: Arial, sans-serif; 
            font-size: 16px; 
            margin-bottom: 40px; 
            line-height: 1.6; 
            max-width: 500px; 
        }
        
        .contact-details-list { 
            list-style: none; 
        }

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
            width: 28px;
            height: 28px; 
            flex-shrink: 0; 
        }

        .contact-form-box { 
            flex: 1; 
            background: #111; 
            padding: 50px; 
            border-radius: 12px; 
            border: 1px solid #333; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.5); 
        }

        .form-group {
            margin-bottom: 25px; 
        }

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

        .form-control:focus { 
            border-color: var(--color-amarillo); 
        }

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
            .contact-wrapper { 
                flex-direction: column; 
                gap: 40px; 
            }

            .page-container { 
                padding-top: 120px; 
            }
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
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Message sent successfully! (This is a preview)');">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="YOUR NAME" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="YOUR EMAIL" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" required style="appearance: none; cursor: pointer;">
                            <option value="" disabled selected>SELECT A TOPIC...</option>
                            <option value="events">Special Events Inquiry</option>
                            <option value="private">Private VIP Booking</option>
                            <option value="support">General Support / Lost Items</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="TELL US MORE..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">SEND MESSAGE</button>
                </form>
            </div>
        </div>
    </div>

    </body>
</html>