<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screenbites Cinema - Privacy Policy</title>
    <style>
        :root {
            --color-negro: #000000;
            --color-blanco: #ffffff;
            --color-amarillo: #ffd000;
        }

        body { 
            margin: 0; 
            font-family: Arial, sans-serif; 
            background-color: var(--color-negro); 
            color: #ccc; 
            line-height: 1.6; 
        }

        /* --- HEADER --- */
        header { 
            padding: 20px 5%; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 1px solid rgba(255,255,255,0.05); 
            background-color: rgba(0,0,0,0.8);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        header .logo img { 
            height: 40px; 
        }

        header .back-btn { 
            color: var(--color-blanco); 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            font-weight: bold; 
            font-size: 14px; 
            text-transform: uppercase; 
            transition: color 0.3s ease; 
        }

        header .back-btn:hover { 
            color: var(--color-amarillo); 
        }

        /* --- CONTENIDO DE LA PÁGINA --- */
        .container { max-width: 800px; margin: 50px auto; padding: 0 20px; }
        h1 { color: var(--color-amarillo); font-family: 'Arial Black', sans-serif; text-transform: uppercase; font-size: 32px; margin-bottom: 10px; }
        h2 { color: var(--color-blanco); font-family: 'Arial Black', sans-serif; text-transform: uppercase; font-size: 20px; margin-top: 40px; border-left: 4px solid var(--color-amarillo); padding-left: 15px; }
        p { margin-bottom: 20px; }
        .last-updated { color: #888; font-size: 13px; font-style: italic; margin-bottom: 40px; }
        ul { margin-bottom: 20px; }
        li { margin-bottom: 5px; }
    </style>
</head>
<body>

    <header>
        <a href="/" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Home
        </a>
        <div class="logo">
            <a href="/"><img src="{{ asset('img/img/Logo-Blanco.png') }}" alt="Screenbites Logo"></a>
        </div>
        <div style="width: 130px;"></div> 
    </header>

    <div class="container">
        <h1>Privacy Policy</h1>
        <div class="last-updated">Last updated: May 12, 2026</div>

        <p>Welcome to Screenbites Cinema. We are committed to protecting your personal information and your right to privacy. This privacy notice applies to all information collected through our website and related services.</p>

        <h2>1. Information We Collect</h2>
        <p>We collect personal information that you voluntarily provide to us when you register on the website, express an interest in obtaining information about us or our products and services, or when you participate in activities on the website (such as posting movie reviews).</p>
        <p>The personal information that we collect depends on the context of your interactions with us and the website, the choices you make, and the products and features you use. The personal information we collect may include the following: <strong>Names, Email Addresses, Passwords, and Payment Data (processed securely via Stripe).</strong></p>

        <h2>2. How We Use Your Information</h2>
        <p>We use personal information collected via our website for a variety of business purposes described below. We process your personal information for these purposes in reliance on our legitimate business interests, in order to enter into or perform a contract with you, with your consent, and/or for compliance with our legal obligations.</p>
        <ul>
            <li>To facilitate account creation and logon process.</li>
            <li>To manage user reviews and comments on movies.</li>
            <li>To fulfill and manage your orders, payments, and tickets.</li>
            <li>To send administrative information to you (e.g., 2FA codes, account verification).</li>
        </ul>

        <h2>3. Movie Reviews and Public Data</h2>
        <p>When you submit a review for a movie, you agree that your username, avatar, and the content of your review will be publicly visible to other users of the website. We reserve the right to moderate, approve, or delete reviews that violate our community guidelines.</p>

        <h2>4. Data Security</h2>
        <p>We have implemented appropriate technical and organizational security measures designed to protect the security of any personal information we process. However, despite our safeguards and efforts to secure your information, no electronic transmission over the Internet or information storage technology can be guaranteed to be 100% secure.</p>

        <h2>5. Contact Us</h2>
        <p>If you have questions or comments about this notice, you may email us at privacy@screenbitescinema.com or by post to our local cinemas.</p>
    </div>

</body>
</html>