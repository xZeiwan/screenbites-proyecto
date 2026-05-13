<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Movie Not Found | Screenbites</title>
    <style>
        :root {
            --color-negro: #000000;
            --color-amarillo: #ffd000;
            --color-blanco: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--color-negro);
            color: var(--color-blanco);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            overflow: hidden;
        }

        /* Fondo elegante */
        .bg-gradient {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at center, #1a1a1a 0%, var(--color-negro) 80%);
            z-index: -1;
        }

        .error-container {
            z-index: 1;
            padding: 40px;
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* Icono de cine roto/cortado */
        .film-icon {
            color: var(--color-amarillo);
            margin-bottom: 20px;
            opacity: 0.8;
        }

        h1 {
            font-family: 'Arial Black', sans-serif;
            font-size: 120px;
            color: var(--color-blanco);
            line-height: 1;
            margin-bottom: 10px;
            text-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
            letter-spacing: -5px;
        }

        h2 {
            font-family: 'Arial Black', sans-serif;
            font-size: 32px;
            text-transform: uppercase;
            color: var(--color-amarillo);
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        p {
            color: #aaa;
            font-size: 16px;
            margin-bottom: 40px;
            max-width: 500px;
            line-height: 1.6;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background-color: var(--color-amarillo);
            color: var(--color-negro);
            text-decoration: none;
            padding: 16px 35px;
            border-radius: 6px;
            font-family: 'Arial Black', sans-serif;
            font-size: 14px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background-color: var(--color-blanco);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 208, 0, 0.2);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="bg-gradient"></div>

    <div class="error-container">
        <svg class="film-icon" xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
            <line x1="7" y1="2" x2="7" y2="22"></line>
            <line x1="17" y1="2" x2="17" y2="22"></line>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <line x1="2" y1="7" x2="7" y2="7"></line>
            <line x1="2" y1="17" x2="7" y2="17"></line>
            <line x1="17" y1="17" x2="22" y2="17"></line>
            <line x1="17" y1="7" x2="22" y2="7"></line>
            <line x1="2" y1="2" x2="22" y2="22"></line> </svg>

        <h1>404</h1>
        <h2>Oops! Cut.</h2>
        <p>The movie you are looking for doesn't exist, has been removed, or isn't screening right now.</p>
        
        <a href="/" class="btn-home">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Back to Home
        </a>
    </div>
    @include('cookie-banner')
</body>
</html>