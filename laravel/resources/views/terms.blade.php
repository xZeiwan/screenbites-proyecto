<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screenbites Cinema - Terms and Conditions</title>
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
        <h1>Terms and Conditions</h1>
        <div class="last-updated">Last updated: May 13, 2026</div>

        <p>Welcome to Screenbites Cinema. These Terms and Conditions govern your use of our website and the services we offer. By accessing or using our website, you agree to be bound by these terms. If you do not agree with any part of these terms, please do not use our services.</p>

        <h2>1. User Accounts</h2>
        <p>To access certain features of our website, such as purchasing tickets or leaving movie reviews, you may be required to create an account. You agree to:</p>
        <ul>
            <li>Provide accurate, current, and complete information during the registration process.</li>
            <li>Maintain the security of your password and accept all risks of unauthorized access to your account.</li>
            <li>Notify us immediately if you discover or suspect any security breaches related to your account.</li>
        </ul>

        <h2>2. Ticket Purchases and Payments</h2>
        <p>All ticket sales are subject to availability. By completing a purchase, you agree to the following:</p>
        <ul>
            <li><strong>Pricing:</strong> All prices are listed in your local currency and include applicable taxes unless stated otherwise.</li>
            <li><strong>Payment Processing:</strong> Payments are securely processed through our third-party provider (Stripe). We do not store your full credit card information on our servers.</li>
            <li><strong>Refunds and Cancellations:</strong> Tickets are non-refundable unless a screening is canceled by Screenbites Cinema. In the event of a cancellation, you will receive a full refund to your original payment method.</li>
        </ul>

        <h2>3. User-Generated Content</h2>
        <p>Our platform allows users to post reviews, ratings, and comments about movies. By submitting content, you grant Screenbites Cinema a non-exclusive, royalty-free license to use, display, and reproduce your content. You agree that your content will not:</p>
        <ul>
            <li>Contain offensive, hateful, or discriminatory language.</li>
            <li>Include spoilers without proper warning.</li>
            <li>Violate the intellectual property rights of any third party.</li>
        </ul>
        <p>We reserve the right to remove any content that violates these guidelines without prior notice.</p>

        <h2>4. Intellectual Property</h2>
        <p>All content on this website, including but not limited to logos, text, graphics, images, and software, is the property of Screenbites Cinema or its content suppliers and is protected by copyright and trademark laws. You may not reproduce, distribute, or create derivative works without our express written consent.</p>

        <h2>5. Limitation of Liability</h2>
        <p>Screenbites Cinema shall not be liable for any indirect, incidental, special, or consequential damages resulting from the use or inability to use our website or services, including but not limited to technical failures, interruptions, or errors.</p>

        <h2>6. Changes to These Terms</h2>
        <p>We reserve the right to modify these Terms and Conditions at any time. Any changes will be effective immediately upon posting on this page. Your continued use of the website following the posting of changes constitutes your acceptance of those changes.</p>

        <h2>7. Contact Us</h2>
        <p>If you have any questions or concerns regarding these Terms and Conditions, please contact us at terms@screenbitescinema.com or visit our customer service desk at your local cinema.</p>
    </div>
    @include('cookie-banner')
</body>
</html>