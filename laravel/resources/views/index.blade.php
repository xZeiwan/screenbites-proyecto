<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screenbites Cinema - Home</title>

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
                    color: var(--header-text-color, var(--color-negro));
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
                color: var(--header-text-color, var(--color-negro));
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
                    color: var(--header-text-color, var(--color-negro));
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
                color: var(--header-text-color, var(--color-negro));
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

        /* --- HERO SECTION --- */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            padding: 0 5%;
            position: relative;
            color: var(--color-negro);
            transition: color 0.3s ease;
        }

        .hero-container {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: flex-end;
            padding-bottom: 5vh;
            position: relative;
            z-index: 10;

            .hero-info {
                width: 35%;

                .title-wrapper {
                    display: flex;
                    align-items: flex-end;
                    gap: 20px;

                    .number {
                        font-size: 150px;
                        font-weight: 100;
                        font-family: Arial, sans-serif;
                        color: transparent;
                        -webkit-text-stroke: 2px currentColor;
                        line-height: 0.75;
                        transition: all 0.3s ease;
                    }

                    .title-details {
                        padding-bottom: 5px;

                        h1 {
                            font-size: 50px;
                            margin: 0 0 5px 0;
                            font-weight: 900;
                            display: flex;
                            align-items: center;
                            gap: 15px;
                            letter-spacing: -1px;
                            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);

                            .age-rating {
                                font-size: 14px;
                                border: 2px solid currentColor;
                                padding: 3px 8px;
                                border-radius: 4px;
                                letter-spacing: 1px;
                                text-shadow: none;
                            }
                        }

                        .stars {
                            display: flex;
                            align-items: center;
                            gap: 4px;
                            margin-top: 5px;
                            filter: drop-shadow(1px 1px 2px rgba(0, 0, 0, 0.5));

                            .star-icon {
                                width: 18px;
                                height: auto;
                            }
                        }

                        .genre {
                            font-size: 12px;
                            margin-top: 8px;
                            font-weight: bold;
                            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
                        }
                    }
                }

                .hero-buttons {
                    margin-top: 40px;
                    display: flex;
                    gap: 20px;

                    .btn-primary,
                    .btn-secondary {
                        padding: 12px 25px;
                        font-weight: 900;
                        font-size: 12px;
                        letter-spacing: 1px;
                        text-transform: uppercase;
                        cursor: pointer;
                        border-radius: 4px;
                        border: none;
                        transition: all 0.3s ease;
                        display: flex;
                        align-items: center;
                        justify-content: center;

                        &:hover {
                            transform: scale(1.05);
                        }
                    }

                    .btn-primary {
                        background: var(--color-negro);
                        color: #ffd000;
                        gap: 10px;

                        img {
                            width: 20px;
                        }
                    }

                    .btn-secondary {
                        background: transparent;
                        border: 2px solid currentColor;
                        color: inherit;
                        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
                    }
                }
            }

            .hero-slider-section {
                width: 45%;
                position: relative;
                height: 400px;

                .custom-slider {
                    position: relative;
                    width: 100%;
                    height: 100%;

                    .slide-item {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 220px;
                        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
                        pointer-events: none;

                        img.poster-img {
                            width: 100%;
                            border-radius: 4px;
                            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                            border: 4px solid transparent;
                            transition: border-color 0.3s ease;
                            background-color: #111;
                        }

                        &.active {
                            transform: translate(-50%, -60%) scale(1.15);
                            opacity: 1;
                            z-index: 10;
                            pointer-events: auto;

                            .progress-track {
                                opacity: 1;
                            }

                            .progress-fill {
                                animation: fillBar 6s linear forwards;
                            }
                        }

                        &.prev {
                            transform: translate(-140%, -50%) scale(0.85);
                            opacity: 0.5;
                            z-index: 5;
                            pointer-events: auto;
                            cursor: pointer;
                        }

                        &.next {
                            transform: translate(40%, -50%) scale(0.85);
                            opacity: 0.5;
                            z-index: 5;
                            pointer-events: auto;
                            cursor: pointer;
                        }

                        &.hidden-left {
                            transform: translate(-250%, -50%) scale(0.5);
                            opacity: 0;
                            z-index: 1;
                        }

                        &.hidden-right {
                            transform: translate(150%, -50%) scale(0.5);
                            opacity: 0;
                            z-index: 1;
                        }

                        .progress-track {
                            position: absolute;
                            bottom: -15px;
                            left: 0;
                            width: 100%;
                            height: 4px;
                            background: rgba(128, 128, 128, 0.3);
                            border-radius: 2px;
                            opacity: 0;
                            transition: opacity 0.3s ease;

                            .progress-fill {
                                height: 100%;
                                width: 0%;
                                background: currentColor;
                                border-radius: 2px;
                            }
                        }
                    }
                }

                .hero-navigation {
                    position: absolute;
                    bottom: -40px;
                    width: 100%;
                    display: flex;
                    justify-content: center;
                    gap: 25px;
                    z-index: 20;

                    .nav-btn {
                        background: transparent;
                        border: none;
                        color: inherit;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 10px;
                        opacity: 1;

                        svg {
                            width: 32px;
                            height: 32px;
                            stroke-width: 3;
                            transition: transform 0.3s ease;
                        }

                        &:hover {
                            transform: scale(1.15);
                        }

                        &#btn-prev:hover svg {
                            transform: translateX(-5px);
                        }

                        &#btn-next:hover svg {
                            transform: translateX(5px);
                        }
                    }
                }
            }
        }

        @keyframes fillBar {
            0% {
                width: 0%;
            }
            100% {
                width: 100%;
            }
        }

        /* --- MOVIES SECTION --- */
        .movies-section {
            padding: 80px 5%;
            background-color: var(--color-gris-oscuro);
            display: flex;
            flex-direction: column;
            align-items: center;

            .movies-container {
                width: 100%;
                max-width: 1300px;
                margin-bottom: 60px;

                .row-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-end;
                    margin-bottom: 30px;
                    border-bottom: 1px solid var(--color-gris-claro);
                    padding-bottom: 15px;

                    .row-title {
                        font-size: 30px;
                        font-weight: 900;
                        text-transform: uppercase;
                        letter-spacing: -1px;
                        color: var(--color-blanco);
                        border-left: 5px solid var(--color-amarillo);
                        padding-left: 15px;
                        line-height: 1;
                    }
                }

                .movies-grid-full {
                    display: grid;
                    grid-template-columns: repeat(5, 1fr);
                    gap: 20px;
                    width: 100%;

                    .movie-card {
                        position: relative;
                        border-radius: 6px;
                        overflow: hidden;
                        background-color: var(--color-negro);
                        transition: transform 0.3s ease, box-shadow 0.3s ease;

                        img {
                            width: 100%;
                            aspect-ratio: 2 / 3;
                            object-fit: cover;
                            display: block;
                            background-color: #111;
                            cursor: pointer;
                        }

                        .date-badge {
                            position: absolute;
                            top: 10px;
                            right: 10px;
                            background-color: var(--color-amarillo);
                            color: var(--color-negro);
                            font-size: 11px;
                            font-weight: 900;
                            padding: 4px 8px;
                            border-radius: 4px;
                            text-transform: uppercase;
                            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
                            z-index: 5;
                        }

                        .movie-card-overlay {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.4) 60%, transparent 100%);
                            display: flex;
                            flex-direction: column;
                            justify-content: flex-end;
                            align-items: center;
                            opacity: 0;
                            transition: opacity 0.3s ease;
                            padding: 20px;
                            text-align: center;
                            z-index: 4;
                            pointer-events: none;

                            .movie-card-title {
                                font-size: 18px;
                                margin-bottom: 5px;
                                color: var(--color-blanco);
                                line-height: 1.1;
                                cursor: pointer;
                            }

                            .movie-card-genre {
                                font-size: 11px;
                                color: var(--color-amarillo);
                                font-family: Arial, sans-serif;
                                margin-bottom: 15px;
                            }

                            .btn-card {
                                background: var(--color-amarillo);
                                color: var(--color-negro);
                                padding: 10px;
                                font-size: 11px;
                                font-weight: 900;
                                text-transform: uppercase;
                                border: none;
                                border-radius: 4px;
                                cursor: pointer;
                                letter-spacing: 1px;
                                transition: background 0.2s;
                                width: 100%;
                                pointer-events: auto;

                                &:hover {
                                    background: #ffffff;
                                    color: black;
                                    border-color: transparent;
                                }

                                &.btn-outline {
                                    background: transparent;
                                    color: var(--color-blanco);
                                    border: 2px solid var(--color-blanco);
                                    margin-top: 5px;
                                }
                            }
                        }

                        &:hover {
                            transform: translateY(-8px);
                            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.9);
                            z-index: 2;

                            .movie-card-overlay {
                                opacity: 1;
                                pointer-events: auto;
                            }
                        }
                    }
                }
            }
        }

        /* --- FOOD SECTION --- */
        .food-section {
            padding: 80px 5%;
            background-color: var(--color-negro);
            display: flex;
            flex-direction: column;
            align-items: center;
            border-top: 1px solid #222;

            .food-container {
                width: 100%;
                max-width: 1200px;

                .food-header {
                    text-align: center;
                    margin-bottom: 50px;

                    h2 {
                        font-size: 40px;
                        color: var(--color-blanco);
                        text-transform: uppercase;
                        letter-spacing: -1px;
                        margin-bottom: 10px;

                        span {
                            color: var(--color-amarillo);
                        }
                    }

                    p {
                        font-family: Arial, sans-serif;
                        color: #888888;
                        font-size: 16px;
                        max-width: 600px;
                        margin: 0 auto;
                    }
                }
            }
        }

        /* --- NUEVO DISEÑO ELEGANTE COMIDA DINÁMICO (WORDPRESS) --- */
        .food-tabs {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .tab-btn {
            background: transparent;
            border: 1px solid #333;
            color: #888;
            padding: 12px 30px;
            border-radius: 30px;
            font-family: 'Arial Black', sans-serif;
            font-size: 13px;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .tab-btn img {
            width: 22px;
            height: 22px;
            filter: grayscale(1) opacity(0.5);
            transition: all 0.3s ease;
        }

        .tab-btn.active, .tab-btn:hover {
            border-color: var(--color-amarillo);
            color: var(--color-blanco);
            background: rgba(255, 208, 0, 0.05);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .tab-btn.active img, .tab-btn:hover img {
            filter: none;
            opacity: 1;
        }

        .tab-content {
            display: none;
            animation: fadeInTab 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeInTab {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .elegant-food-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 70px;
        }

        .elegant-food-card {
            background: #0f0f0f;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #222;
            transition: all 0.4s ease;
            position: relative;
        }

        .elegant-food-card:hover {
            border-color: #555;
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.8);
        }

        .elegant-food-card .img-wrapper {
            position: relative;
            width: 100%;
            height: 220px;
            overflow: hidden;
            background-color: #050505;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .elegant-food-card .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .elegant-food-card:hover .img-wrapper img {
            transform: scale(1.1);
        }

        .elegant-food-card .img-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 70%;
            background: linear-gradient(to top, #0f0f0f 0%, transparent 100%);
            pointer-events: none;
        }

        .elegant-food-card .price-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--color-amarillo);
            color: var(--color-negro);
            font-weight: 900;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 14px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
            z-index: 2;
        }

        .elegant-food-card .card-info {
            padding: 0 25px 25px 25px;
            position: relative;
            z-index: 2;
            margin-top: -30px;
        }

        .elegant-food-card h3 {
            font-size: 18px;
            color: var(--color-blanco);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.8);
        }

        .elegant-food-card p {
            font-family: Arial, sans-serif;
            color: #888;
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
        }

        /* --- EXCLUSIVE SECTION --- */
        .exclusive-section {
            width: 100%;
            background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
            border-radius: 8px;
            border: 1px solid #333;
            padding: 50px;
            position: relative;
            overflow: hidden;

            &::before {
                content: '';
                position: absolute;
                top: -50px;
                right: -50px;
                width: 150px;
                height: 150px;
                background: var(--color-amarillo);
                filter: blur(100px);
                opacity: 0.1;
            }

            .exclusive-title {
                text-align: center;
                margin-bottom: 40px;
                position: relative;
                z-index: 2;

                h3 {
                    font-size: 30px;
                    color: var(--color-amarillo);
                    text-transform: uppercase;
                    margin-bottom: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                    
                    svg {
                        width: 28px;
                        height: 28px;
                    }
                }

                p {
                    color: #aaa;
                    font-family: Arial, sans-serif;
                    font-size: 15px;
                }
            }

            .exclusive-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
                position: relative;
                z-index: 2;

                .exclusive-card {
                    background-color: #0a0a0a;
                    border: 1px solid #333;
                    border-radius: 8px;
                    overflow: hidden;
                    transition: transform 0.3s ease, border-color 0.3s;
                    text-align: center;
                    padding-bottom: 20px;

                    .exclusive-img {
                        width: 100%;
                        height: 200px;
                        background-color: #111;
                        object-fit: cover;
                        border-bottom: 2px solid #222;
                    }

                    h4 {
                        font-size: 18px;
                        color: #fff;
                        margin: 15px 0 5px;
                        text-transform: uppercase;
                    }

                    p {
                        font-size: 13px;
                        color: #888;
                        font-family: Arial, sans-serif;
                        padding: 0 15px;
                        margin-bottom: 15px;
                        height: 40px;
                    }

                    .exclusive-tag {
                        display: inline-block;
                        background-color: var(--color-amarillo);
                        color: #000;
                        font-size: 11px;
                        font-weight: bold;
                        padding: 3px 10px;
                        border-radius: 12px;
                        text-transform: uppercase;
                    }

                    &:hover {
                        transform: translateY(-5px);
                        border-color: var(--color-amarillo);
                        box-shadow: 0 10px 20px rgba(255, 208, 0, 0.1);
                    }
                }
            }
        }

        /* --- EVENTS SECTION --- */
        .events-section {
            padding: 80px 5%;
            background-color: var(--color-gris-oscuro);
            display: flex;
            flex-direction: column;
            align-items: center;
            border-top: 1px solid #222;
        }

        .events-container {
            width: 100%;
            max-width: 1200px;
        }

        .events-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .events-header h2 {
            font-size: 40px;
            color: var(--color-blanco);
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }

        .events-header h2 span {
            color: var(--color-amarillo);
        }

        .events-header p {
            font-family: Arial, sans-serif;
            color: #888888;
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Active Event: Blind Ticket */
        .blind-ticket-card {
            background: linear-gradient(135deg, #111111 0%, #000000 100%);
            border: 1px solid var(--color-amarillo);
            border-radius: 12px;
            display: flex;
            overflow: hidden;
            margin-bottom: 50px;
            box-shadow: 0 15px 30px rgba(255, 208, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .blind-ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(255, 208, 0, 0.2);
        }

        .blind-poster {
            width: 300px;
            background: #050505;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 1px dashed #333;
            position: relative;
            flex-shrink: 0;
            overflow: hidden;
        }

        .blind-poster svg {
            width: 80px;
            height: 80px;
            color: var(--color-amarillo);
            opacity: 0.8;
            position: relative;
            z-index: 2;
        }

        .blind-poster .glitch {
            position: absolute;
            font-size: 150px;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.05);
            font-family: 'Arial Black', sans-serif;
            z-index: 1;
        }

        @keyframes jumpRotate {
            0% { transform: translateY(0) rotate(0deg); }
            40% { transform: translateY(-40px) rotate(180deg); }
            60% { transform: translateY(-40px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        .glitch.animating {
            animation: jumpRotate 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .blind-info {
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .blind-tag {
            display: inline-block;
            background: var(--color-amarillo);
            color: #000;
            font-size: 11px;
            font-weight: 900;
            padding: 4px 10px;
            border-radius: 4px;
            text-transform: uppercase;
            margin-bottom: 15px;
            width: fit-content;
            letter-spacing: 1px;
        }

        .blind-info h3 {
            font-size: 32px;
            color: #fff;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        .blind-info p {
            color: #aaa;
            font-family: Arial, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 30px;
            max-width: 600px;
        }

        .blind-actions {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .blind-price-btn {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .blind-price {
            font-size: 28px;
            color: var(--color-amarillo);
            font-family: 'Arial Black', sans-serif;
        }

        .btn-blind {
            background: var(--color-amarillo);
            color: #000;
            border: none;
            padding: 12px 30px;
            font-weight: 900;
            text-transform: uppercase;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-blind:hover {
            background: #fff;
            transform: scale(1.05);
        }

        .btn-view-event {
            background: transparent;
            color: var(--color-blanco);
            text-decoration: none;
            padding: 10px 25px;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            border: 2px solid var(--color-blanco);
            border-radius: 4px;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-view-event:hover {
            background: var(--color-blanco);
            color: var(--color-negro);
        }

        .upcoming-header {
            font-size: 24px;
            color: #fff;
            border-bottom: 1px solid #333;
            padding-bottom: 15px;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .upcoming-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .upcoming-card {
            background: #111;
            border: 1px solid #222;
            border-radius: 8px;
            padding: 30px;
            transition: border-color 0.3s ease, transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .upcoming-card:hover {
            border-color: #555;
            transform: translateY(-5px);
        }

        .upcoming-content {
            margin-bottom: 25px;
        }

        .upcoming-date {
            color: var(--color-amarillo);
            font-size: 12px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            margin-bottom: 15px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .upcoming-card h4 {
            font-size: 18px;
            color: #fff;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .upcoming-card p {
            color: #888;
            font-size: 13px;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .btn-outline-small {
            background: transparent;
            color: #aaa;
            border: 1px solid #444;
            padding: 10px 15px;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            letter-spacing: 1px;
        }

        .upcoming-card:hover .btn-outline-small {
            color: var(--color-blanco);
            border-color: var(--color-blanco);
        }

        .btn-outline-small:hover {
            background: var(--color-blanco) !important;
            color: var(--color-negro) !important;
        }

        @media (max-width: 900px) {
            .blind-ticket-card {
                flex-direction: column;
            }
            .blind-poster {
                width: 100%;
                height: 200px;
                border-right: none;
                border-bottom: 1px dashed #333;
            }
            .upcoming-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        /* --- TEAM SECTION --- */
        .team-section {
            padding: 80px 5%;
            background-color: var(--color-negro);
            display: flex;
            flex-direction: column;
            align-items: center;
            border-top: 1px solid #222;
        }

        .team-container {
            width: 100%;
            max-width: 1200px;
        }

        .team-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .team-header h2 {
            font-size: 40px;
            color: var(--color-blanco);
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }

        .team-header h2 span {
            color: var(--color-amarillo);
        }

        .team-header p {
            font-family: Arial, sans-serif;
            color: #888888;
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .team-card {
            background-color: var(--color-gris-tarjeta);
            border: 1px solid #333;
            border-radius: 6px;
            padding: 30px 20px;
            text-align: center;
            transition: transform 0.3s ease, border-color 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .team-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: var(--color-amarillo);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-10px);
            border-color: #555;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
        }

        .team-card:hover::before {
            transform: scaleX(1);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: var(--color-negro);
            border: 3px solid #333;
            margin: 0 auto 20px;
            object-fit: cover;
            transition: border-color 0.3s ease;
        }

        .team-card:hover .team-avatar {
            border-color: var(--color-amarillo);
        }

        .team-name {
            font-size: 20px;
            color: var(--color-blanco);
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .team-role {
            font-family: Arial, sans-serif;
            color: var(--color-amarillo);
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .team-description {
            font-family: Arial, sans-serif;
            color: #aaa;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .team-socials {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-link {
            color: #666;
            transition: color 0.3s ease, transform 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-link svg {
            width: 20px;
            height: 20px;
        }

        .social-link:hover {
            color: var(--color-amarillo);
            transform: scale(1.1);
        }

        @media (max-width: 1024px) {
            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .team-grid {
                grid-template-columns: 1fr;
            }
        }

        /* --- FOOTER --- */
        footer {
            background-color: var(--color-gris-oscuro);
            padding: 60px 5% 40px;
            border-top: 1px solid var(--color-gris-claro);

            .footer-content {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 40px;
                max-width: 1200px;
                margin: 0 auto;

                .footer-col {
                    flex: 1;
                    min-width: 200px;

                    &:first-child {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        text-align: center;
                        
                        .footer-logo img {
                            height: 60px;
                            margin-bottom: 20px;
                            display: block;
                        }

                        p {
                            max-width: 250px;
                        }
                    }

                    p {
                        font-family: Arial, sans-serif;
                        color: #888;
                        font-size: 13px;
                        line-height: 1.6;
                    }

                    h4 {
                        font-size: 16px;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        margin-bottom: 20px;
                        color: var(--color-amarillo);
                    }

                    .footer-links {
                        list-style: none;

                        li {
                            margin-bottom: 10px;

                            a {
                                color: var(--color-blanco);
                                text-decoration: none;
                                font-family: Arial, sans-serif;
                                font-size: 14px;
                                transition: color 0.3s ease;

                                &:hover {
                                    color: var(--color-amarillo);
                                }
                            }
                        }
                    }
                }
            }

            .footer-bottom {
                max-width: 1200px;
                margin: 40px auto 0;
                padding-top: 20px;
                border-top: 1px solid var(--color-gris-claro);
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-family: Arial, sans-serif;
                font-size: 12px;
                color: #666;

                .footer-credits {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    color: #888;
                    font-family: Arial, sans-serif;

                    span {
                        color: var(--color-amarillo);
                        font-weight: bold;
                    }
                }
            }
        }

        /* --- CUSTOM MODAL ALERTS --- */
        .custom-modal-overlay {
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background: rgba(0, 0, 0, 0.85); 
            backdrop-filter: blur(8px);
            z-index: 10000; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            opacity: 0; 
            visibility: hidden; 
            transition: all 0.3s ease;
        }

        .custom-modal-overlay.active { 
            opacity: 1; 
            visibility: visible; 
        }
        
        .custom-modal-box {
            background: #0a0a0a; 
            border: 2px solid var(--color-amarillo, #ffd000);
            padding: 40px; 
            border-radius: 12px; 
            text-align: center;
            max-width: 420px; 
            width: 90%; 
            box-shadow: 0 25px 50px rgba(0,0,0,0.9);
            transform: translateY(30px); 
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .custom-modal-overlay.active .custom-modal-box { 
            transform: translateY(0);
         }
    </style>
</head>

<body>

    <main class="hero" id="main-hero">
        <img src="{{ asset('img/1-Kill-Bill/Portada.png') }}" alt="Background Image" class="hero-bg" id="hero-bg">

        <header id="main-header">
            <div class="logo"><img src="{{ asset('img/img/Logo-Negro.png') }}" alt="Cinema Logo" id="main-logo"></div>
            <nav>
                <ul>
                    <li id="sys-time" style="color: var(--color-amarillo); font-size: 12px; font-family: monospace; border: 1px dashed var(--color-amarillo); padding: 4px 10px; border-radius: 4px; letter-spacing: 1px;">
                        SYS: {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}
                    </li>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px; vertical-align: middle;">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
                                </svg>
                                Admin
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="/profile" class="user-profile" title="My Profile">
                                <img src="{{ asset('img/avatars/' . Auth::user()->avatar) }}" alt="Avatar"
                                    class="user-avatar" onerror="this.onerror=null; this.src='https://via.placeholder.com/35/333/ffd000';">
                                <span class="user-name">{{ strtoupper(Auth::user()->name) }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="chevron-icon" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                        </li>

                        <li>
                            <button class="nav-cart" onclick="window.location.href='/cart'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <div class="cart-badge" id="nav-cart-counter"></div>
                            </button>
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">                                
                                @csrf
                                <button type="submit" class="logout-btn" title="Sign Out">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                </button>
                            </form>
                        </li>
                    </div>
                    @else
                    <div class="user-nav">
                        <li>
                            <a href="{{ route('login') }}" title="Sign In">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" title="Create Account">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <line x1="19" y1="8" x2="19" y2="14"></line>
                                    <line x1="22" y1="11" x2="16" y2="11"></line>
                                </svg>
                            </a>
                        </li>
                    </div>
                    @endauth
                </ul>
            </nav>
        </header>

        @if (session('status'))
        <div id="toast-message" style="position: fixed; top: 120px; right: 5%; background-color: var(--color-amarillo); color: var(--color-negro); padding: 15px 25px; border-radius: 6px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; z-index: 9999; box-shadow: 0 10px 30px rgba(0,0,0,0.8); animation: slideIn 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                @if(session('status') === 'profile-updated')
                    Profile updated successfully!
                @else
                    {{ session('status') }}
                @endif
            </div>
        </div>

        <style>
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        </style>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-message');
                if(toast) {
                    toast.style.transition = 'all 0.5s ease';
                    toast.style.transform = 'translateX(100%)';
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 4000);
        </script>
        @endif

        <div class="hero-container">
            <div class="hero-info">
                <div class="title-wrapper">
                    <span class="number" id="movie-id">01</span>
                    <div class="title-details">
                        <h1 id="movie-title">Kill Bill <span class="age-rating" id="movie-age">+18</span></h1>
                        <div class="stars" id="movie-stars"></div>
                        <p class="genre" id="movie-genre">Genre: Action, Suspense</p>
                    </div>
                </div>
                <div class="hero-buttons">
                    @auth
                        <button class="btn-primary" id="btn-buy" onclick="window.location.href='/booking/01'">
                            <img src="{{ asset('img/img/Ticket-amarillo.png') }}" id="ticket-icon"> <span id="btn-buy-text">BUY TICKETS</span>
                        </button>
                    @else
                        <button class="btn-primary" id="btn-buy" onclick="window.location.href='/login'">
                            <img src="{{ asset('img/img/Ticket-amarillo.png') }}" id="ticket-icon"> <span id="btn-buy-text">LOGIN TO BUY</span>
                        </button>
                    @endauth
                    <button class="btn-secondary" id="btn-view-film">VIEW FILM</button>
                </div>
            </div>
            <div class="hero-slider-section">
                <div class="custom-slider" id="slider-track"></div>
                <div class="hero-navigation">
                    <button class="nav-btn" id="btn-prev" title="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                    <button class="nav-btn" id="btn-next" title="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <section class="movies-section" id="cartelera">
        <div class="movies-container">
            <div class="row-header">
                <h2 class="row-title">Now Playing</h2>
            </div>
            <div class="movies-grid-full" id="now-playing-grid"></div>
        </div>

        <div class="movies-container" style="margin-top: 40px;">
            <div class="row-header">
                <h2 class="row-title">Coming Soon</h2>
            </div>
            <div class="movies-grid-full" id="coming-soon-grid"></div>
        </div>
    </section>

    <section class="food-section" id="bar">
        <div class="food-container">
            <div class="food-header">
                <h2>Explore the <span>Menu</span></h2>
                <p>Discover our delicious snacks and drinks. You can add them to your order during the seat selection process.</p>
            </div>

            <div class="food-tabs">
                <button class="tab-btn active" onclick="openFoodTab('tab-popcorn', this)"><img src="{{ asset('img/svg/popcorn.svg') }}" alt="Popcorn"> Popcorn & Food</button>
                <button class="tab-btn" onclick="openFoodTab('tab-drinks', this)"><img src="{{ asset('img/svg/drinks.svg') }}" alt="Drinks"> Fresh Drinks</button>
                <button class="tab-btn" onclick="openFoodTab('tab-sweets', this)"><img src="{{ asset('img/svg/sweets.svg') }}" alt="Sweets"> Snacks & Sweets</button>
            </div>

            <div class="tab-content active" id="tab-popcorn">
                <div class="elegant-food-grid">
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/popcorn1.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/popcorn.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Popcorn">
                            <span class="price-badge">$5.50</span>
                        </div>
                        <div class="card-info">
                            <h3>Classic Salted Popcorn (M)</h3>
                            <p>Freshly popped, perfectly salted and golden. The classic cinema experience.</p>
                        </div>
                    </div>
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/popcorn2.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/popcorn.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Popcorn L">
                            <span class="price-badge">$7.00</span>
                        </div>
                        <div class="card-info">
                            <h3>Classic Salted Popcorn (L)</h3>
                            <p>Large portion for sharing. Freshly popped and perfectly salted.</p>
                        </div>
                    </div>
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/popcorn3.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/popcorn.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Butter Popcorn">
                            <span class="price-badge">$8.00</span>
                        </div>
                        <div class="card-info">
                            <h3>Extra Butter Popcorn (L)</h3>
                            <p>Large popcorn drenched in rich, melted cinema butter.</p>
                        </div>
                    </div>
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/popcorn4.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/popcorn.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Caramel Popcorn">
                            <span class="price-badge">$6.50</span>
                        </div>
                        <div class="card-info">
                            <h3>Sweet Caramel Popcorn (M)</h3>
                            <p>Coated in rich, buttery caramel for the perfect sweet treat.</p>
                        </div>
                    </div>
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/popcorn6.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/popcorn.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Hot Dog">
                            <span class="price-badge">$5.00</span>
                        </div>
                        <div class="card-info">
                            <h3>Classic Hot Dog</h3>
                            <p>Premium beef sausage in a soft, warm bun.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="tab-drinks">
                <div class="elegant-food-grid">
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/drink1.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/drinks.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Coca-Cola">
                            <span class="price-badge">$4.00</span>
                        </div>
                        <div class="card-info">
                            <h3>Coca-Cola / Zero (M)</h3>
                            <p>Medium ice-cold refreshing classic soda.</p>
                        </div>
                    </div>
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/drink2.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/drinks.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Sprite">
                            <span class="price-badge">$5.50</span>
                        </div>
                        <div class="card-info">
                            <h3>Sprite (L)</h3>
                            <p>Large crisp, refreshing lemon-lime soda.</p>
                        </div>
                    </div>
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/drink3.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/drinks.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Slushie">
                            <span class="price-badge">$5.00</span>
                        </div>
                        <div class="card-info">
                            <h3>Blue Icee Slush</h3>
                            <p>Blue Raspberry flavor. The ultimate brain-freeze treat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="tab-sweets">
                <div class="elegant-food-grid">
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/snack2.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/sweets.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="M&Ms">
                            <span class="price-badge">$3.50</span>
                        </div>
                        <div class="card-info">
                            <h3>Chocolate M&M's Bag</h3>
                            <p>Classic milk chocolate M&M's for a sweet crunch.</p>
                        </div>
                    </div>
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/snack4.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/sweets.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Gummy Bears">
                            <span class="price-badge">$3.00</span>
                        </div>
                        <div class="card-info">
                            <h3>Gummy Bears</h3>
                            <p>Assorted fruit flavors, soft and chewy.</p>
                        </div>
                    </div>
                    <div class="elegant-food-card">
                        <div class="img-wrapper">
                            <img src="http://localhost/screenbites-proyecto/wp/wp-content/uploads/2026/05/snack9.png" 
                                 onerror="this.onerror=null; this.src='{{ asset('img/svg/sweets.svg') }}'; this.style.padding='40px'; this.style.objectFit='contain';" 
                                 alt="Magnum">
                            <span class="price-badge">$4.00</span>
                        </div>
                        <div class="card-info">
                            <h3>Classic Magnum Ice Cream</h3>
                            <p>Vanilla ice cream encased in cracking Belgian chocolate.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="exclusive-section">
                <div class="exclusive-title">
                    <h3><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                            </polygon>
                        </svg> Exclusive Collectibles</h3>
                    <p>Unlock these limited edition combos when purchasing a ticket for their respective movie.</p>
                </div>

                <div class="exclusive-grid">
                    <div class="exclusive-card">
                        <img src="{{ asset('img/1-Kill-Bill/kill-bill.jpeg') }}" class="exclusive-img">
                        <h4>Vengeance Combo</h4>
                        <p>Yellow suit design popcorn bucket + XL Katana Cup.</p>
                        <span class="exclusive-tag">Kill Bill Only</span>
                    </div>

                    <div class="exclusive-card">
                        <img src="{{ asset('img/4-Oppenheimer/oppenheimer.png') }}" class="exclusive-img">
                        <h4>Atomic Combo</h4>
                        <p>Extra Spicy Popcorn + Limited Edition Black Soda.</p>
                        <span class="exclusive-tag">Oppenheimer Only</span>
                    </div>

                    <div class="exclusive-card">
                        <img src="{{ asset('img/9-Barbie/barbie.png') }}" class="exclusive-img">
                        <h4>Dreamhouse Snack</h4>
                        <p>Sparkly pink bucket with sweet popcorn + Cotton Candy Drink.</p>
                        <span class="exclusive-tag">Barbie Only</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="events-section" id="events">
        <div class="events-container">
            <div class="events-header">
                <h2>Special <span>Events</span></h2>
                <p>Discover unique cinematic experiences. From mysterious screenings to exclusive director Q&As.</p>
            </div>

            <div class="blind-ticket-card">
                <div class="blind-poster">
                    <span class="glitch">?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div class="blind-info">
                    <span class="blind-tag">Active Event</span>
                    <h3>Blind Ticket: 80s Sci-Fi Thriller</h3>
                    <p>Trust us, it's a masterpiece. You won't know what movie it is until the lights go out. A cult classic from the 1980s that redefined the sci-fi genre. Dare to book?</p>
                    
                    <div class="blind-actions">
                        <div class="blind-price-btn">
                            <span class="blind-price">$5.00</span>
                            
                            @auth
                                @php
                                    $yaTieneEsteEvento = \Illuminate\Support\Facades\DB::table('bookings')
                                        ->where('user_id', Auth::id())
                                        ->where('event_id', 'blind-01')
                                        ->exists();
                                @endphp

                                @if($yaTieneEsteEvento)
                                    <div style="position: relative;">
                                        <button class="btn-blind" style="background: #333; color: #888; cursor: not-allowed; box-shadow: none;" disabled>
                                            <img src="{{ asset('img/img/Ticket-amarillo.png') }}" style="width:20px; filter: grayscale(1) opacity(0.5);"> 
                                            <span>TICKET CLAIMED</span>
                                        </button>
                                        <div style="position: absolute; top: 100%; left: 0; margin-top: 8px; background: #388e3c; color: white; padding: 4px 10px; border-radius: 4px; font-size: 10px; font-family: 'Arial Black', sans-serif; letter-spacing: 1px; white-space: nowrap;">
                                            ✓ ALREADY PURCHASED
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <button class="btn-blind" onclick="addBlindTicketToCart()">
                                            <img src="{{ asset('img/img/Ticket-amarillo.png') }}" style="width:20px;"> 
                                            <span>BOOK TICKET</span>
                                        </button>
                                    </div>
                                @endif
                            @else
                                <button class="btn-blind" onclick="window.location.href='/login'">
                                    <img src="{{ asset('img/img/Ticket-amarillo.png') }}" style="width:20px;"> LOGIN TO BOOK
                                </button>
                            @endauth
                        </div>
                        
                        <a href="{{ route('events.blind') }}" class="btn-view-event">View Details</a>
                    </div>
                </div>
            </div>

            <h3 class="upcoming-header">Upcoming Events</h3>
            <div class="upcoming-grid">
                <div class="upcoming-card">
                    <div class="upcoming-content">
                        <span class="upcoming-date">Nov 12 • 23:00</span>
                        <h4>Horror Marathon</h4>
                        <p>Survive the night with 3 back-to-back terrifying modern horror hits.</p>
                    </div>
                    <a href="{{ route('events.horror') }}" class="btn-outline-small" style="text-decoration: none; text-align: center; display: block;">View Details</a>
                </div>

                <div class="upcoming-card">
                    <div class="upcoming-content">
                        <span class="upcoming-date">Nov 18 • 19:30</span>
                        <h4>Director's Q&A: Tarantino</h4>
                        <p>Exclusive screening of Pulp Fiction followed by a live virtual Q&A.</p>
                    </div>
                    <a href="{{ route('events.tarantino') }}" class="btn-outline-small" style="text-decoration: none; text-align: center; display: block;">View Details</a>
                </div>

                <div class="upcoming-card">
                    <div class="upcoming-content">
                        <span class="upcoming-date">Dec 01 • 20:00</span>
                        <h4>Classic 35mm Projection</h4>
                        <p>Experience the magic of authentic 35mm film projection with Casablanca.</p>
                    </div>
                    <a href="{{ route('events.35mm') }}" class="btn-outline-small" style="text-decoration: none; text-align: center; display: block;">View Details</a>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section" id="team">
        <div class="team-container">
            <div class="team-header">
                <h2>Meet The <span>Team</span></h2>
                <p>The developers behind Screenbites Cinema. A team dedicated to bringing the best web experience for movie lovers.</p>
            </div>

            <div class="team-grid">
                <div class="team-card">
                    <img src="{{ asset('img/img/team/1.jpg') }}" alt="Elena Rostova" class="team-avatar">
                    <h3 class="team-name">Elena Rostova</h3>
                    <p class="team-role">Chief Executive Producer</p>
                    <p class="team-description">Oversees all cinema operations, securing exclusive premieres and ensuring top-tier experiences for our VIP members.</p>
                    <div class="team-socials">
                        <a href="#" class="social-link" title="Portfolio"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg></a>
                        <a href="#" class="social-link" title="LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg></a>
                    </div>
                </div>

                <div class="team-card">
                    <img src="{{ asset('img/img/team/2.jpg') }}" alt="Marcus Sterling" class="team-avatar">
                    <h3 class="team-name">Marcus Sterling</h3>
                    <p class="team-role">Head of Projection</p>
                    <p class="team-description">The mastermind behind our IMAX and 70mm setups, guaranteeing flawless visual immersion in every room.</p>
                    <div class="team-socials">
                        <a href="#" class="social-link" title="Portfolio"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg></a>
                        <a href="#" class="social-link" title="LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg></a>
                    </div>
                </div>

                <div class="team-card">
                    <img src="{{ asset('img/img/team/3.jpg') }}" alt="Sofia Laurent" class="team-avatar">
                    <h3 class="team-name">Sofia Laurent</h3>
                    <p class="team-role">Culinary Director</p>
                    <p class="team-description">Curates the exclusive Screenbites menus, elegantly blending high-end gourmet gastronomy with classic cinema snacks.</p>
                    <div class="team-socials">
                        <a href="#" class="social-link" title="Portfolio"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg></a>
                        <a href="#" class="social-link" title="LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg></a>
                    </div>
                </div>

                <div class="team-card">
                    <img src="{{ asset('img/img/team/4.jpg') }}" alt="Julian Vance" class="team-avatar">
                    <h3 class="team-name">Julian Vance</h3>
                    <p class="team-role">Chief Film Curator</p>
                    <p class="team-description">Handpicks the weekly selections, balancing blockbuster hits with indie gems and classic 35mm retrospectives.</p>
                    <div class="team-socials">
                        <a href="#" class="social-link" title="Portfolio"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg></a>
                        <a href="#" class="social-link" title="LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg></a>
                    </div>
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
                    <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
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
                Design for <span>Enrique & Alex</span>
            </p>
        </div>
    </footer>

    <div id="duplicate-event-modal" class="custom-modal-overlay">
        <div class="custom-modal-box">
            <div class="modal-icon" style="color: var(--color-amarillo, #ffd000); margin-bottom: 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <h3 style="font-family: 'Arial Black', sans-serif; font-size: 22px; margin-bottom: 15px; color: #fff; text-transform: uppercase;">Already in Cart</h3>
            <p style="color: #aaa; font-size: 15px; line-height: 1.6; margin-bottom: 30px;">
                You already have a Blind Ticket in your cart! You can only book one per order.
            </p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <button onclick="closeDuplicateModal()" style="background: transparent; border: 1px solid #555; color: #fff; padding: 12px 25px; border-radius: 6px; font-family: 'Arial Black', sans-serif; cursor: pointer; text-transform: uppercase; transition: 0.3s; font-size: 13px;">
                    Close
                </button>
                <button onclick="window.location.href='/cart'" style="background: var(--color-amarillo, #ffd000); border: none; color: #000; padding: 12px 25px; border-radius: 6px; font-family: 'Arial Black', sans-serif; cursor: pointer; text-transform: uppercase; transition: 0.3s; font-size: 13px; box-shadow: 0 5px 15px rgba(255,208,0,0.2);">
                    Go to Cart
                </button>
            </div>
        </div>
    </div>
    
    <script>
        const CART_KEY = 'screenbites_cart_{{ Auth::check() ? Auth::id() : "guest" }}';
        const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};

        const movies = [
            { id: "01", title: "Kill Bill", age: "+18", rating: 4, genre: "Action, Suspense", bg: "#ffd000", textColor: "black", bgImg: "{{ asset('img/1-Kill-Bill/Portada.png') }}", poster: "{{ asset('img/1-Kill-Bill/Mini.png') }}" },
            { id: "02", title: "Five Nights", age: "+16", rating: 3, genre: "Horror, Thriller", bg: "#1a0429", textColor: "white", bgImg: "{{ asset('img/2-Five-Nights/Portada.png') }}", poster: "{{ asset('img/2-Five-Nights/Mini.png') }}" },
            { id: "03", title: "Godzilla", age: "+12", rating: 4, genre: "Action, Sci-Fi", bg: "#0a2233", textColor: "white", bgImg: "{{ asset('img/3-Godzilla/Portada.png') }}", poster: "{{ asset('img/3-Godzilla/Mini.png') }}" },
            { id: "04", title: "Oppenheimer", age: "+16", rating: 5, genre: "Biography, History", bg: "#2e1409", textColor: "white", bgImg: "{{ asset('img/4-Oppenheimer/Portada.png') }}", poster: "{{ asset('img/4-Oppenheimer/Mini.png') }}" },
            { id: "05", title: "Up", age: "TP", rating: 5, genre: "Animation, Adventure", bg: "#a1cce0", textColor: "black", bgImg: "{{ asset('img/5-Up/Portada.png') }}", poster: "{{ asset('img/5-Up/Mini.png') }}" },
            { id: "06", title: "The Joker", age: "+18", rating: 5, genre: "Crime, Drama", bg: "#120908", textColor: "white", bgImg: "{{ asset('img/6-The-Joker/Portada.png') }}", poster: "{{ asset('img/6-The-Joker/Mini.png') }}" },
            { id: "07", title: "Alien", age: "+18", rating: 4, genre: "Horror, Sci-Fi", bg: "#051417", textColor: "white", bgImg: "{{ asset('img/7-Alien/Portada.png') }}", poster: "{{ asset('img/7-Alien/Mini.png') }}" },
            { id: "08", title: "Interstellar", age: "+12", rating: 5, genre: "Adventure, Sci-Fi", bg: "#090a0a", textColor: "white", bgImg: "{{ asset('img/8-Interstellar/Portada.png') }}", poster: "{{ asset('img/8-Interstellar/Mini.png') }}" },
            { id: "09", title: "Barbie", age: "TP", rating: 4, genre: "Comedy, Fantasy", bg: "#51caf5", textColor: "white", bgImg: "{{ asset('img/9-Barbie/Portada.png') }}", poster: "{{ asset('img/9-Barbie/Mini.png') }}" },
            { id: "10", title: "Mamma Mia", age: "TP", rating: 5, genre: "Comedy, Musical", bg: "#b3d0e2", textColor: "black", bgImg: "{{ asset('img/10-MammaMia/Portada.jpg') }}", poster: "{{ asset('img/10-MammaMia/Mini.jpg') }}" }
        ];

        const comingSoonMovies = [
            { id: "11", title: "Deadpool & Wolverine", date: "JULY 25", genre: "Action, Comedy", poster: "{{ asset('img/11-Deadpool/Mini.jpg') }}" },
            { id: "12", title: "Gladiator II", date: "NOV 15", genre: "Action, Drama", poster: "{{ asset('img/12-Gladiator/Mini.jpg') }}" },
            { id: "13", title: "Venom 3", date: "OCT 24", genre: "Sci-Fi, Action", poster: "{{ asset('img/13-Venom/Mini.png') }}" },
            { id: "14", title: "Mufasa", date: "DEC 20", genre: "Adventure, Family", poster: "{{ asset('img/14-Mufasa/Mini.jpg') }}" },
            { id: "15", title: "Kraven", date: "DEC 13", genre: "Action, Thriller", poster: "{{ asset('img/15-Kraven/Mini.png') }}" }
        ];

        let currentIndex = 0;
        const totalMovies = movies.length;
        let autoPlayTimer;
        const AUTO_PLAY_DELAY = 6000;

        const sliderTrack = document.getElementById('slider-track');
        const mainHero = document.getElementById('main-hero');
        const heroBg = document.getElementById('hero-bg');
        const nowPlayingGrid = document.getElementById('now-playing-grid');
        const comingSoonGrid = document.getElementById('coming-soon-grid');
        const headerEl = document.getElementById('main-header');
        const logoEl = document.getElementById('main-logo');

        window.addEventListener('scroll', () => {
            const activeMovie = movies[currentIndex];
            const sysTime = document.getElementById('sys-time');
            
            if (window.scrollY >= window.innerHeight - 100) {
                headerEl.classList.add('scrolled');
                logoEl.src = "{{ asset('img/img/Logo-Blanco.png') }}";
                headerEl.style.setProperty('--header-text-color', 'white');
                headerEl.style.setProperty('--hover-color', 'var(--color-amarillo)');
                
                if(sysTime) {
                    sysTime.style.color = 'var(--color-amarillo)';
                    sysTime.style.borderColor = 'var(--color-amarillo)';
                }
            } else {
                headerEl.classList.remove('scrolled');
                logoEl.src = activeMovie.textColor === "white" ? "{{ asset('img/img/Logo-Blanco.png') }}" : "{{ asset('img/img/Logo-Negro.png') }}";
                headerEl.style.setProperty('--header-text-color', activeMovie.textColor);
                
                if (activeMovie.id === "01") {
                    headerEl.style.setProperty('--hover-color', '#000000'); 
                    if(sysTime) {
                        sysTime.style.color = '#000000';
                        sysTime.style.borderColor = '#000000';
                    }
                } else {
                    headerEl.style.setProperty('--hover-color', 'var(--color-amarillo)');
                    if(sysTime) {
                        sysTime.style.color = 'var(--color-amarillo)';
                        sysTime.style.borderColor = 'var(--color-amarillo)';
                    }
                }
            }
        });

        movies.forEach((movie, index) => {
            const slideDiv = document.createElement('div');
            slideDiv.classList.add('slide-item');
            slideDiv.innerHTML = `<img src="${movie.poster}" alt="${movie.title}" class="poster-img"><div class="progress-track"><div class="progress-fill"></div></div>`;
            slideDiv.addEventListener('click', () => {
                if (slideDiv.classList.contains('prev')) moveSlider(-1);
                if (slideDiv.classList.contains('next')) moveSlider(1);
            });
            sliderTrack.appendChild(slideDiv);

            const buyButtonHtml = isAuthenticated 
                ? `<button class="btn-card" onclick="window.location.href='/booking/${movie.id}'">Buy Tickets</button>`
                : `<button class="btn-card" onclick="window.location.href='/login'">Login to Buy</button>`;

            const npCard = document.createElement('div');
            npCard.classList.add('movie-card');
            npCard.innerHTML = `
                <img src="${movie.poster}" alt="${movie.title}" onclick="window.location.href='/pelicula/${movie.id}'">
                <div class="movie-card-overlay">
                    <h4 class="movie-card-title" onclick="window.location.href='/pelicula/${movie.id}'">${movie.title}</h4>
                    <p class="movie-card-genre">${movie.genre}</p>
                    ${buyButtonHtml}
                    <button class="btn-card btn-outline" style="margin-top:8px;" onclick="window.location.href='/pelicula/${movie.id}'">More Info</button>
                </div>
            `;
            nowPlayingGrid.appendChild(npCard);
        });

        comingSoonMovies.forEach((movie) => {
            const csCard = document.createElement('div');
            csCard.classList.add('movie-card');
            csCard.innerHTML = `
                <div class="date-badge">${movie.date}</div>
                <img src="${movie.poster}" alt="${movie.title}" onclick="window.location.href='/pelicula/${movie.id}'">
                <div class="movie-card-overlay">
                    <h4 class="movie-card-title" onclick="window.location.href='/pelicula/${movie.id}'">${movie.title}</h4>
                    <p class="movie-card-genre">${movie.genre}</p>
                    <button class="btn-card btn-outline" onclick="window.location.href='/pelicula/${movie.id}'">More Info</button>
                </div>
            `;
            comingSoonGrid.appendChild(csCard);
        });

        const slides = document.querySelectorAll('.slide-item');

        function updateCarousel() {
            slides.forEach((slide, index) => {
                slide.className = 'slide-item';
                let diff = (index - currentIndex + totalMovies) % totalMovies;
                if (diff === 0) slide.classList.add('active');
                else if (diff === 1) slide.classList.add('next');
                else if (diff === totalMovies - 1) slide.classList.add('prev');
                else if (diff > 1 && diff <= totalMovies / 2) slide.classList.add('hidden-right');
                else slide.classList.add('hidden-left');
            });

            const activeMovie = movies[currentIndex];
            heroBg.classList.add('fade');
            setTimeout(() => {
                heroBg.src = activeMovie.bgImg;
                heroBg.classList.remove('fade');
            }, 200);

            document.getElementById('movie-id').textContent = activeMovie.id;
            document.getElementById('movie-title').innerHTML = `${activeMovie.title} <span class="age-rating">${activeMovie.age}</span>`;
            document.getElementById('movie-genre').textContent = `Genre: ${activeMovie.genre}`;

            const isBlackStar = activeMovie.id === "01";
            const starFilled = isBlackStar ? "{{ asset('img/img/Estrella-Negra.svg') }}" : "{{ asset('img/img/Estrella-Amarilla.svg') }}";
            const starEmpty = isBlackStar ? "{{ asset('img/img/Estrella-Negra-Vacia.svg') }}" : "{{ asset('img/img/Estrella-Amarilla-Vacia.svg') }}";

            let starsHTML = '';
            for (let i = 0; i < 5; i++) {
                if (i < activeMovie.rating) starsHTML += `<img src="${starFilled}" alt="Star" class="star-icon">`;
                else starsHTML += `<img src="${starEmpty}" alt="Empty Star" class="star-icon">`;
            }
            document.getElementById('movie-stars').innerHTML = starsHTML;

            const color = activeMovie.textColor;
            mainHero.style.color = color;
            document.getElementById('movie-id').style.webkitTextStroke = `2px ${color}`;

            const btnBuyHero = document.getElementById('btn-buy');
            const btnBuyText = document.getElementById('btn-buy-text');
            
            if (isAuthenticated) {
                btnBuyHero.setAttribute('onclick', `window.location.href='/booking/${activeMovie.id}'`);
                if (btnBuyText) btnBuyText.innerText = 'BUY TICKETS';
            } else {
                btnBuyHero.setAttribute('onclick', `window.location.href='/login'`);
                if (btnBuyText) btnBuyText.innerText = 'LOGIN TO BUY';
            }

            const btnViewHero = document.getElementById('btn-view-film');
            btnViewHero.onclick = function () {
                window.location.href = '/pelicula/' + activeMovie.id;
            };

            if (!headerEl.classList.contains('scrolled')) {
                headerEl.style.setProperty('--header-text-color', color);
                const sysTime = document.getElementById('sys-time');
                if (activeMovie.id === "01") {
                    headerEl.style.setProperty('--hover-color', '#000000');
                    if(sysTime) {
                        sysTime.style.color = '#000000';
                        sysTime.style.borderColor = '#000000';
                    }
                } else {
                    headerEl.style.setProperty('--hover-color', 'var(--color-amarillo)');
                    if(sysTime) {
                        sysTime.style.color = 'var(--color-amarillo)';
                        sysTime.style.borderColor = 'var(--color-amarillo)';
                    }
                }
                logoEl.src = color === "white" ? "{{ asset('img/img/Logo-Blanco.png') }}" : "{{ asset('img/img/Logo-Negro.png') }}";
            }
        }

        function moveSlider(direction) {
            currentIndex = (currentIndex + direction + totalMovies) % totalMovies;
            updateCarousel();
            resetAutoPlay();
        }

        function resetAutoPlay() {
            clearInterval(autoPlayTimer);
            autoPlayTimer = setInterval(() => { moveSlider(1); }, AUTO_PLAY_DELAY);
        }

        document.getElementById('btn-prev').addEventListener('click', () => moveSlider(-1));
        document.getElementById('btn-next').addEventListener('click', () => moveSlider(1));

        updateCarousel();
        resetAutoPlay();

        document.addEventListener('DOMContentLoaded', () => {
            updateCartBadge();
        });

        function updateCartBadge() {
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            let totalOrders = globalCart.length;
            const badge = document.getElementById('nav-cart-counter');
            if(badge) {
                badge.innerText = totalOrders;
                if(totalOrders > 0) {
                    badge.style.transform = 'scale(1.2)';
                    setTimeout(() => badge.style.transform = 'scale(1)', 200);
                }
            }
        }

        const blindCard = document.querySelector('.blind-ticket-card');
        const glitchIcon = document.querySelector('.glitch');
        
        if (blindCard && glitchIcon) {
            blindCard.addEventListener('mouseenter', () => {
                if (!glitchIcon.classList.contains('animating')) {
                    glitchIcon.classList.add('animating');
                }
            });
            glitchIcon.addEventListener('animationend', () => {
                glitchIcon.classList.remove('animating');
            });
        }

        function addBlindTicketToCart() {
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            let existingIndex = globalCart.findIndex(order => order.movieId === 'blind-01');
            if(existingIndex > -1) {
                document.getElementById('duplicate-event-modal').classList.add('active');
                return;
            }
            let blindOrder = {
                id: 'ORD-BLIND-' + Date.now(),
                movieId: 'blind-01',
                movieTitle: 'Blind Ticket: Mystery Movie',
                color: '#ffd000',
                textColor: 'black',
                tickets: { seats: 'Mystery Seat', price: 5.00 },
                food: [],
                orderTotal: 5.00
            };
            globalCart.push(blindOrder);
            localStorage.setItem(CART_KEY, JSON.stringify(globalCart));
            if(typeof updateCartBadge === 'function') updateCartBadge(); 
            window.location.href = '/cart';
        }

        function closeDuplicateModal() {
            document.getElementById('duplicate-event-modal').classList.remove('active');
        }

        // FUNCIÓN PARA LAS PESTAÑAS DE COMIDA
        function openFoodTab(tabId, btnElement) {
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.remove('active'));
            const btns = document.querySelectorAll('.tab-btn');
            btns.forEach(btn => btn.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
            btnElement.classList.add('active');
        }
    </script>
    @include('cookie-banner')
</body>
</html>