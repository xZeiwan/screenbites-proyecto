<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Screenbites - Checkout</title>
    <style>
        :root {
            --color-negro: #000000;
            --color-gris-oscuro: #0a0a0a;
            --color-gris-tarjeta: #141414;
            --color-blanco: #ffffff;
            --color-principal: {{ request()->query('color', '#ffd000') }}; 
            --color-texto-principal: {{ request()->query('textColor', 'black') }};
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
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
            overflow-x: hidden;

            .page-bg { 
                position: fixed; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                z-index: -2; 
                object-fit: cover; 
                opacity: 0.1; 
                filter: blur(10px); 
            }

            .page-bg-gradient { 
                position: fixed; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                z-index: -1; 
                background: radial-gradient(circle at center, transparent 0%, var(--color-negro) 80%); 
            }

            header { 
                padding: 20px 5%; 
                display: flex; 
                justify-content: space-between; 
                align-items: center; 
                border-bottom: 1px solid rgba(255,255,255,0.05); 
                background-color: rgba(0,0,0,0.8);
                backdrop-filter: blur(10px);

                .logo img { 
                    height: 40px; 
                }

                .back-btn { 
                    color: var(--color-blanco); 
                    text-decoration: none; 
                    display: flex; 
                    align-items: center; 
                    gap: 8px; 
                    font-weight: bold; 
                    font-size: 14px; 
                    text-transform: uppercase; 
                    transition: color 0.3s; 

                    &:hover { color: var(--color-principal); }
                }
            }

            .checkout-container { 
                display: flex; 
                flex: 1; 
                padding: 50px 5%; 
                gap: 60px; 
                max-width: 1200px; 
                margin: 0 auto; 
                width: 100%; 
                align-items: flex-start;

                /* --- ZONA IZQUIERDA: FORMULARIO DE PAGO --- */
                .payment-section { 
                    flex: 2; 
                    background-color: rgba(20,20,20,0.8); 
                    backdrop-filter: blur(10px);
                    border: 1px solid rgba(255,255,255,0.1);
                    border-radius: 12px;
                    padding: 40px;

                    h1 { 
                        font-family: 'Arial Black', sans-serif; 
                        font-size: 28px; 
                        text-transform: uppercase; 
                        margin-bottom: 30px; 
                        border-bottom: 2px solid var(--color-principal);
                        padding-bottom: 15px;
                    }

                    .payment-methods { 
                        display: flex; 
                        gap: 15px; 
                        margin-bottom: 30px; 

                        .method-card { 
                            flex: 1; 
                            border: 1px solid #333; 
                            border-radius: 8px; 
                            padding: 15px; 
                            text-align: center; 
                            cursor: pointer; 
                            transition: all 0.3s; 
                            opacity: 0.6; 

                            &.active { 
                                border-color: var(--color-principal); 
                                opacity: 1; 
                                background: rgba(255,208,0,0.05); 
                            }

                            svg { 
                                width: 30px; 
                                height: 30px; 
                                margin-bottom: 5px; 
                                color: var(--color-blanco); 
                            }

                            div {
                                font-size: 12px; 
                                font-weight: bold; 
                                margin-top: 5px;
                            }
                        }
                    }

                    .form-group { 
                        margin-bottom: 25px; 

                        label { 
                            display: block; 
                            font-size: 12px; 
                            color: #888; 
                            text-transform: uppercase; 
                            font-weight: bold; 
                            margin-bottom: 8px; 
                            letter-spacing: 1px; 
                        }

                        input { 
                            width: 100%; 
                            background: #0a0a0a; 
                            border: 1px solid #333; 
                            color: white; 
                            padding: 15px; 
                            border-radius: 6px; 
                            font-size: 16px; 
                            font-family: monospace; 
                            transition: all 0.3s;

                            &:focus { 
                                outline: none; 
                                border-color: var(--color-principal); 
                                box-shadow: 0 0 10px rgba(255,208,0,0.2); 
                            }
                        }

                        /* --- ESTILO PARA STRIPE --- */
                        #card-element {
                            background: #0a0a0a;
                            border: 1px solid #333;
                            padding: 16px;
                            border-radius: 6px;
                            transition: all 0.3s;
                        }

                        #card-element.StripeElement--focus {
                            border-color: var(--color-principal);
                            box-shadow: 0 0 10px rgba(255,208,0,0.2);
                        }
                    }

                    .form-row { 
                        display: flex; 
                        gap: 20px; 

                        .form-group { flex: 1; }
                    }
                }

                /* --- RESUMEN FINAL (TICKET) --- */
                .summary-section { 
                    flex: 1; 
                    min-width: 350px; 
                    background-color: var(--color-principal); 
                    color: var(--color-negro);
                    border-radius: 12px; 
                    padding: 40px; 
                    box-shadow: 0 20px 50px rgba(0,0,0,0.5);

                    h2 { 
                        font-family: 'Arial Black', sans-serif; 
                        font-size: 24px; 
                        text-transform: uppercase; 
                        margin-bottom: 5px; 
                    }

                    .summary-movie { 
                        font-size: 14px; 
                        font-weight: bold; 
                        margin-bottom: 25px; 
                        opacity: 0.8; 
                    }

                    .final-cart { 
                        margin-bottom: 30px; 
                        border-top: 1px solid rgba(0,0,0,0.1); 
                        border-bottom: 1px solid rgba(0,0,0,0.1); 
                        padding: 20px 0; 
                        
                        .final-item { 
                            display: flex; 
                            justify-content: space-between; 
                            margin-bottom: 10px; 
                            font-size: 14px; 
                            font-weight: bold; 

                            span:first-child { opacity: 0.8; }
                        }
                    }

                    .total-box { 
                        display: flex; 
                        justify-content: space-between; 
                        align-items: center; 

                        span { 
                            font-size: 16px; 
                            font-weight: bold; 
                            text-transform: uppercase; 
                        }

                        strong { 
                            font-family: 'Arial Black', sans-serif; 
                            font-size: 36px; 
                        }
                    }

                    .btn-pay { 
                        width: 100%; 
                        background-color: var(--color-negro); 
                        color: var(--color-principal); 
                        border: none; 
                        padding: 20px; 
                        border-radius: 6px; 
                        font-family: 'Arial Black', sans-serif; 
                        font-size: 16px; 
                        text-transform: uppercase; 
                        cursor: pointer; 
                        transition: all 0.3s ease; 
                        margin-top: 30px; 
                        display: flex; 
                        justify-content: center; 
                        align-items: center; 
                        gap: 10px; 

                        &:hover { 
                            background-color: #222; 
                            transform: translateY(-3px); 
                            box-shadow: 0 10px 20px rgba(0,0,0,0.3); 
                        }

                        &:disabled { 
                            opacity: 0.7; 
                            cursor: wait; 
                            transform: none; 
                        }

                        /* Loader */
                        .loader { 
                            border: 3px solid rgba(255,208,0,0.3); 
                            border-top: 3px solid var(--color-principal); 
                            border-radius: 50%; 
                            width: 20px; 
                            height: 20px; 
                            animation: spin 1s linear infinite; 
                            display: none; 
                        }
                    }

                    .terms-text {
                        text-align: center; 
                        font-size: 11px; 
                        margin-top: 15px; 
                        opacity: 0.7;
                    }
                }
            }
        }

        @keyframes spin { 
            0% { 
                transform: rotate(0deg); 
            } 

            100% { 
                transform: rotate(360deg); 
            } 
        }

        /* --- PANTALLA DE ÉXITO DE PAGO ESTÁNDAR --- */
        .success-overlay {
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background: var(--color-negro); 
            color: var(--color-principal);
            z-index: 9999; 
            display: none; 
            flex-direction: column;
            justify-content: center; 
            align-items: center; 
            text-align: center;
            opacity: 0; 
            transition: opacity 0.5s ease;
        }

        .success-overlay.show { 
            display: flex;
            opacity: 1; 
        }

        .success-overlay svg { 
            width: 100px; 
            height: 100px; 
            color: var(--color-principal); 
            margin-bottom: 20px; 
            animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .success-overlay h2 { 
            font-family: 'Arial Black', sans-serif; 
            font-size: 36px; 
            margin-bottom: 10px; 
            text-transform: uppercase; 
        }

        .success-overlay p { 
            color: #aaa; 
            font-size: 18px; 
        }

        @keyframes popIn {
            0% { 
                transform: scale(0); 
                opacity: 0; 
            }

            100% { 
                transform: scale(1); 
                opacity: 1; 
            }
        }

        /* --- PANTALLA DE REVELACIÓN (BLIND TICKET) --- */
        .blind-reveal-overlay {
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background: #050505; 
            z-index: 10000; 
            display: none;
            flex-direction: column; 
            align-items: center; 
            justify-content: center;
            color: #fff; 
            overflow: hidden;
        }
        
        .blind-reveal-overlay.show { 
            display: flex; 
        }
        
        .mystery-box {
            position: relative; 
            width: 300px; 
            height: 450px;
            display: flex; 
            align-items: center; 
            justify-content: center;
            perspective: 1000px;
        }
        
        .mystery-question {
            font-family: 'Arial Black', sans-serif; 
            font-size: 200px; 
            font-weight: 900; 
            color: var(--color-principal); 
            animation: intenseGlitch 0.15s linear infinite;
            position: absolute; 
            z-index: 10;
        }
        
        .revealed-poster {
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            border-radius: 12px;
            box-shadow: 0 0 50px rgba(255,208,0,0.5);
            opacity: 0; transform: scale(0.8); 
            transition: all 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 3px solid var(--color-principal); 
            z-index: 5;
        }
        
        .reveal-text {
            margin-top: 30px; 
            text-align: center; 
            opacity: 0; 
            transform: translateY(20px);
            transition: all 1s ease; 
            transition-delay: 0.5s; 
            z-index: 30;
        }
        
        .reveal-text h2 { 
            font-family: 'Arial Black', sans-serif; 
            font-size: 32px; 
            color: var(--color-principal); 
            margin-bottom: 10px; 
            text-transform: uppercase; 
        }

        .reveal-text p { 
            color: #aaa; 
            font-size: 16px; 
            margin-bottom: 25px; 
        }
        
        .btn-home {
            background: var(--color-blanco); 
            color: var(--color-negro); 
            padding: 15px 35px;
            font-family: 'Arial Black', sans-serif; 
            font-size: 13px; 
            font-weight: 900; 
            text-transform: uppercase; 
            border: none; 
            border-radius: 6px;
            cursor: pointer; 
            letter-spacing: 1px; 
            transition: all 0.3s;
        }

        .btn-home:hover { 
            background: var(--color-principal); 
            transform: scale(1.05); 
        }

        @keyframes intenseGlitch {
            0% { transform: translate(0) skew(0deg); text-shadow: 4px 0 red, -4px 0 blue; }
            20% { transform: translate(-4px, 4px) skew(-10deg); text-shadow: -4px 0 red, 4px 0 blue; }
            40% { transform: translate(4px, -4px) skew(10deg); text-shadow: 4px 0 red, -4px 0 blue; }
            60% { transform: translate(-4px, -4px) skew(-5deg); text-shadow: -4px 0 red, 4px 0 blue; }
            80% { transform: translate(4px, 4px) skew(5deg); text-shadow: 4px 0 red, -4px 0 blue; }
            100% { transform: translate(0) skew(0deg); text-shadow: -4px 0 red, 4px 0 blue; }
        }

        /* Flash de luz blanca para la transición */
        .flash-bang {
            position: absolute; 
            top:0; 
            left:0;
            width:100%; 
            height:100%;
            background: white; 
            z-index: 20; 
            opacity: 0; 
            pointer-events: none;
        }

        .flash-bang.active { 
            animation: flashAnim 1s ease-out forwards; 
        }
        
        @keyframes flashAnim {
            0% { 
                opacity: 1; 
            }
            100% { 
                opacity: 0; 
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
            border: 2px solid var(--color-principal);
            padding: 40px; 
            border-radius: 12px; 
            text-align: center; 
            max-width: 420px; width: 90%;
            box-shadow: 0 25px 50px rgba(0,0,0,0.9); 
            transform: translateY(30px);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .custom-modal-overlay.active .custom-modal-box { 
            transform: translateY(0); 
        }

        .custom-modal-box .modal-icon { 
            color: #ff4444; 
            margin-bottom: 20px; 
        }

        .custom-modal-box h3 { 
            font-family: 'Arial Black', sans-serif; 
            font-size: 22px; 
            margin-bottom: 15px; 
            color: var(--color-blanco); 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }
        .custom-modal-box p { 
            color: #aaa; 
            font-size: 15px; 
            line-height: 1.6; 
            margin-bottom: 30px; 
        }

        #close-error-btn {
            background: var(--color-blanco); 
            color: var(--color-negro);
            border: none;
            padding: 14px 35px; 
            font-family: 'Arial Black', sans-serif; 
            font-size: 13px; 
            border-radius: 6px; 
            cursor: pointer;
            text-transform: uppercase; 
            letter-spacing: 1px; 
            transition: all 0.3s ease;
        }
        
        #close-error-btn:hover { 
            background: var(--color-principal); 
            color: var(--color-texto-principal); 
            transform: scale(1.05); 
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

    <img src="{{ asset($movie['bgImg'] ?? '') }}" class="page-bg" onerror="this.src=''">
    <div class="page-bg-gradient"></div>

    <header>
        <a href="/cart" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Cart
        </a>
        <div class="logo"><a href="/"><img src="{{ asset('img/img/Logo-Blanco.png') }}" alt="Screenbites Logo"></a></div>
        <div style="width: 130px;"></div>
    </header>

    <div class="checkout-container">
        
        <div class="payment-section">
            <h1>Payment Details</h1>

            <div class="payment-methods">
                <div class="method-card active" id="method-card" onclick="selectPaymentMethod('card')">
                    <div style="height: 35px; display: flex; justify-content: center; align-items: center; gap: 8px; margin-bottom: 5px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Visa_Inc._logo_%282021%E2%80%93present%29.svg" alt="Visa" style="height: 14px; filter: brightness(0) invert(1);">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" style="height: 22px;">
                    </div>
                    <div>Credit Card</div>
                </div>
                
                <div class="method-card" id="method-paypal" onclick="selectPaymentMethod('paypal')">
                    <div style="height: 35px; display: flex; justify-content: center; align-items: center; margin-bottom: 5px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" style="height: 22px;">
                    </div>
                    <div>PayPal</div>
                </div>
                
                <div class="method-card" id="method-bizum" onclick="selectPaymentMethod('bizum')">
                    <div style="height: 35px; display: flex; justify-content: center; align-items: center; margin-bottom: 5px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Bizum.svg" alt="Bizum" style="height: 20px; filter: brightness(0) invert(1);">
                    </div>
                    <div>Bizum</div>
                </div>
            </div>

            <form id="payment-form" onsubmit="processPayment(event)">
                
                <div id="form-card" style="display: block;">
                    <div class="form-group">
                        <label>Cardholder Name</label>
                        <input type="text" id="card-name" placeholder="e.g. Miguel Pérez Fernández" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Secure Card Details</label>
                        <div id="card-element"></div>
                        <div id="card-errors" role="alert" style="color: #ff4444; font-size: 12px; margin-top: 8px; font-weight: bold;"></div>
                    </div>
                </div>

                <div id="form-paypal" style="display: none;">
                    <div class="form-group">
                        <label>PayPal Account Email</label>
                        <input type="email" id="paypal-email" placeholder="your.email@example.com">
                    </div>
                    <p style="font-size: 12px; color: #888; margin-bottom: 20px;">You will be redirected to PayPal to complete the purchase securely.</p>
                </div>

                <div id="form-bizum" style="display: none;">
                    <div class="form-group">
                        <label>Bizum Phone Number</label>
                        <input type="tel" id="bizum-phone" placeholder="600 000 000" maxlength="11" minlength="11" pattern=".{11,}" title="Please enter 9 digits">
                    </div>
                    <p style="font-size: 12px; color: #888; margin-bottom: 20px;">Enter your phone number registered with Bizum. You will receive a notification in your bank's app.</p>
                </div>

            </form>
        </div>

        <div class="summary-section">
            <h2>Your Order</h2>
            <div class="summary-movie" id="checkout-title">Reviewing your cart items</div>

            <div class="final-cart" id="final-cart-list"></div>

            <div class="total-box">
                <span>Total to Pay</span>
                <strong id="final-total">$0.00</strong>
            </div>

            <button type="submit" form="payment-form" class="btn-pay" id="btn-pay">
                <span id="btn-text">Confirm Payment</span>
                <div class="loader" id="pay-loader"></div>
            </button>
            <p class="terms-text">By confirming, you agree to our Terms & Conditions.</p>
        </div>
    </div>

    <div class="success-overlay" id="success-screen">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        <h2>Payment Successful!</h2>
        <p>Generating your digital tickets...</p>
    </div>

    <div class="blind-reveal-overlay" id="blind-reveal-screen">
        <div class="flash-bang" id="flash-bang"></div>
        <div class="mystery-box">
            <div class="mystery-question" id="mystery-question">?</div>
            <img src="" class="revealed-poster" id="revealed-poster">
        </div>
        <div class="reveal-text" id="reveal-text">
            <h2>Loading...</h2>
            <p>Payment successful. Get ready for the ultimate experience.</p>
            <button class="btn-home" onclick="window.location.href='/'">RETURN TO HOME</button>
        </div>
    </div>

    <div id="error-modal" class="custom-modal-overlay">
        <div class="custom-modal-box">
            <div class="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <h3 id="error-modal-title">Error</h3>
            <p id="error-modal-message">Something went wrong.</p>
            <button id="close-error-btn">UNDERSTOOD</button>
        </div>
    </div>

    <script>
        const CART_KEY = 'screenbites_cart_{{ Auth::check() ? Auth::id() : "guest" }}';
        const cartData = localStorage.getItem(CART_KEY);
        const currentUserRole = "{{ Auth::check() ? Auth::user()->role : 'guest' }}";

        // ==========================================
        // 1. FUNCIONES DE LA INTERFAZ (UI)
        // ==========================================
        let currentMethod = 'card';
        function selectPaymentMethod(method) {
            currentMethod = method;
            
            document.getElementById('method-card').classList.remove('active');
            document.getElementById('method-paypal').classList.remove('active');
            document.getElementById('method-bizum').classList.remove('active');
            
            document.getElementById('method-' + method).classList.add('active');

            document.getElementById('form-card').style.display = 'none';
            document.getElementById('form-paypal').style.display = 'none';
            document.getElementById('form-bizum').style.display = 'none';

            document.getElementById('card-name').required = false;
            document.getElementById('paypal-email').required = false;
            document.getElementById('bizum-phone').required = false;

            document.getElementById('form-' + method).style.display = 'block';
            
            if (method === 'card') {
                document.getElementById('card-name').required = true;
            } else if (method === 'paypal') {
                document.getElementById('paypal-email').required = true;
            } else if (method === 'bizum') {
                document.getElementById('bizum-phone').required = true;
            }
        }

        function showErrorModal(title, message) {
            document.getElementById('error-modal-title').innerText = title;
            document.getElementById('error-modal-message').innerText = message;
            document.getElementById('error-modal').classList.add('active');
        }

        document.getElementById('close-error-btn').addEventListener('click', () => {
            document.getElementById('error-modal').classList.remove('active');
        });

        function resetPayButton() {
            const btn = document.getElementById('btn-pay');
            document.getElementById('btn-text').innerText = 'Confirm Payment';
            document.getElementById('pay-loader').style.display = 'none';
            btn.disabled = false;
        }

        document.getElementById('bizum-phone').addEventListener('input', function (e) {
            let value = this.value.replace(/\D/g, ''); 
            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i === 3 || i === 6) formattedValue += ' ';
                formattedValue += value[i];
            }
            this.value = formattedValue;
        });

        // ==========================================
        // 2. RENDERIZADO DEL CARRITO
        // ==========================================
        const cartContainer = document.getElementById('final-cart-list');
        const totalDisplay = document.getElementById('final-total');
        let grandTotal = 0;

        if (cartData) {
            const globalCart = JSON.parse(cartData);
            if(globalCart.length > 0) {
                cartContainer.innerHTML = ''; 
                globalCart.forEach(order => {
                    let orderTotal = order.orderTotal;
                    let discountHtml = '';

                    if (currentUserRole === 'vip') {
                        let discount = orderTotal * 0.10;
                        orderTotal = orderTotal - discount;
                        discountHtml = `
                            <div class="final-item" style="color: #4ade80; font-size: 12px; margin-top: 10px; font-weight: bold; border-top: 1px dashed rgba(255,255,255,0.1); padding-top: 5px;">
                                <span>VIP Discount (10%)</span>
                                <span>-$${discount.toFixed(2)}</span>
                            </div>`;
                    }
                    grandTotal += orderTotal;

                    let title = order.movieTitle ? order.movieTitle.toUpperCase() : "MOVIE TICKET";
                    cartContainer.innerHTML += `
                        <div style="font-size: 13px; color: #000000; margin-top: 15px; margin-bottom: 5px; text-transform: uppercase; font-family: 'Arial Black', sans-serif; border-bottom: 1px solid rgba(0,0,0,0.2); padding-bottom: 3px;">
                            ${title}
                        </div>
                    `;

                    if (order.tickets && order.tickets.price > 0) {
                        cartContainer.innerHTML += `
                            <div class="final-item">
                                <span>Seats: ${order.tickets.seats}</span>
                                <span>$${order.tickets.price.toFixed(2)}</span>
                            </div>
                        `;
                    }
                    if (order.food && order.food.length > 0) {
                        order.food.forEach(item => {
                            cartContainer.innerHTML += `
                                <div class="final-item">
                                    <span>${item.qty}x ${item.name}</span>
                                    <span>$${item.total.toFixed(2)}</span>
                                </div>
                            `;
                        });
                    }
                    if (discountHtml !== '') cartContainer.innerHTML += discountHtml;
                });
                totalDisplay.innerText = `$${grandTotal.toFixed(2)}`;
            } else {
                cartContainer.innerHTML = '<div style="text-align:center; font-style:italic;">No items found.</div>';
                document.getElementById('btn-pay').disabled = true;
            }
        } else {
            cartContainer.innerHTML = '<div style="text-align:center; font-style:italic;">No items found.</div>';
            document.getElementById('btn-pay').disabled = true;
        }

        // ==========================================
        // 3. INICIALIZACIÓN SEGURA DE STRIPE
        // ==========================================
        const stripeKey = '{{ config("services.stripe.key") }}';
        let stripe = null;
        let elements = null;
        let cardElement = null;

        if (typeof Stripe !== 'undefined' && stripeKey !== '') {
            stripe = Stripe(stripeKey);
            elements = stripe.elements();
            
            cardElement = elements.create('card', {
                style: {
                    base: {
                        color: '#ffffff',
                        fontFamily: '"Arial", sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': { color: '#888888' }
                    },
                    invalid: { color: '#ff4444', iconColor: '#ff4444' }
                }
            });
            
            cardElement.mount('#card-element');

            cardElement.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
        } else {
            console.error("❌ ERROR CRÍTICO: No se ha podido inicializar Stripe.");
        }

        // ==========================================
        // 4. PROCESO DE PAGO AL SERVIDOR
        // ==========================================
        async function processPayment(e) {
            e.preventDefault(); 
            
            const btn = document.getElementById('btn-pay');
            const btnText = document.getElementById('btn-text');
            const loader = document.getElementById('pay-loader');

            btn.disabled = true;
            btnText.innerText = 'Processing...';
            loader.style.display = 'block';

            let paymentData = {};

            if (currentMethod === 'card') {
                if (!stripe || !cardElement) {
                    resetPayButton();
                    return showErrorModal("System Error", "The payment gateway is not initialized correctly.");
                }

                const cardName = document.getElementById('card-name').value;
                if (!cardName) {
                    resetPayButton();
                    return showErrorModal("Incomplete Data", "Please enter the cardholder name.");
                }

                const { paymentMethod, error } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                    billing_details: { name: cardName }
                });

                if (error) {
                    resetPayButton();
                    return showErrorModal("Payment Error", error.message);
                }

                paymentData = { paymentMethodId: paymentMethod.id };

            } else if (currentMethod === 'bizum') {
                const phone = document.getElementById('bizum-phone').value.replace(/\s/g, '');
                if (phone.length < 9) { resetPayButton(); return showErrorModal("Invalid Phone", "Please enter a valid phone number."); }
                paymentData = { phone: phone };

            } else if (currentMethod === 'paypal') {
                const email = document.getElementById('paypal-email').value;
                if (!email.includes('@')) { resetPayButton(); return showErrorModal("Invalid Email", "Please enter a valid email."); }
                paymentData = { email: email };
            }

            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            let payloadCart = globalCart.map(item => {
                if (!item.sessionId) item.sessionId = "1";
                return item;
            });

            fetch('/process-payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    cart: payloadCart,
                    method: currentMethod,       
                    payment_data: paymentData    
                })
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) throw data; 
                return data;
            })
            .then(data => {
                // REDIRECCIÓN (PAYPAL / BIZUM)
                if(data.status === 'redirect') {
                    localStorage.removeItem(CART_KEY); 
                    window.location.href = data.url; 
                } 
                // ÉXITO DIRECTO (TARJETA)
                else if(data.status === 'success') {
                    localStorage.removeItem(CART_KEY); 
                    const hasBlindTicket = globalCart.some(order => order.movieId === 'blind-01');

                    if (hasBlindTicket && data.revealed_movie_id) {
                        localStorage.setItem('purchased_blind_{{ Auth::check() ? Auth::id() : "guest" }}', 'true');
                        
                        const movieCatalog = {
                            "01": { title: "Kill Bill", img: "{{ asset('img/1-Kill-Bill/Mini.png') }}" },
                            "02": { title: "Five Nights At Freddy's", img: "{{ asset('img/2-Five-Nights/Mini.png') }}" },
                            "03": { title: "Godzilla", img: "{{ asset('img/3-Godzilla/Mini.png') }}" },
                            "04": { title: "Oppenheimer", img: "{{ asset('img/4-Oppenheimer/Mini.png') }}" },
                            "05": { title: "Up", img: "{{ asset('img/5-Up/Mini.png') }}" },
                            "06": { title: "The Joker", img: "{{ asset('img/6-The-Joker/Mini.png') }}" },
                            "07": { title: "Alien", img: "{{ asset('img/7-Alien/Mini.png') }}" },
                            "08": { title: "Interstellar", img: "{{ asset('img/8-Interstellar/Mini.png') }}" },
                            "09": { title: "Barbie", img: "{{ asset('img/9-Barbie/Mini.png') }}" },
                            "10": { title: "Mamma Mia!", img: "{{ asset('img/10-MammaMia/Mini.jpg') }}" },
                            "11": { title: "Deadpool", img: "{{ asset('img/11-Deadpool/Mini.jpg') }}" },
                            "12": { title: "Gladiator", img: "{{ asset('img/12-Gladiator/Mini.jpg') }}" },
                            "13": { title: "Venom", img: "{{ asset('img/13-Venom/Mini.png') }}" },
                            "14": { title: "Mufasa", img: "{{ asset('img/14-Mufasa/Mini.jpg') }}" },
                            "15": { title: "Kraven", img: "{{ asset('img/15-Kraven/Mini.png') }}" }
                        };

                        let recId = String(data.revealed_movie_id).padStart(2, '0');
                        let revealedMovie = movieCatalog[recId] || { title: "Mystery Screenbites Film", img: "https://via.placeholder.com/300x450/111/ffd000?text=Top+Secret" };

                        document.getElementById('revealed-poster').src = revealedMovie.img;
                        document.querySelector('#reveal-text h2').innerText = revealedMovie.title;

                        const revealScreen = document.getElementById('blind-reveal-screen');
                        revealScreen.classList.add('show');
                        
                        setTimeout(() => {
                            document.getElementById('flash-bang').classList.add('active');
                            document.getElementById('mystery-question').style.display = 'none';
                            
                            const poster = document.getElementById('revealed-poster');
                            poster.style.opacity = '1';
                            poster.style.transform = 'scale(1)';
                            
                            const text = document.getElementById('reveal-text');
                            text.style.opacity = '1';
                            text.style.transform = 'translateY(0)';
                        }, 3000); 
                    } else {
                        document.getElementById('success-screen').classList.add('show');
                        setTimeout(() => { window.location.href = "/profile"; }, 2500);
                    }
                }
            })
            .catch(error => {
                console.error('Error del backend:', error);
                let errorMsg = "An unexpected error occurred processing your payment.";
                if (error.errors) {
                    errorMsg = Object.values(error.errors)[0][0]; 
                } else if (error.message) {
                    errorMsg = error.message;
                }
                showErrorModal("Payment Failed", errorMsg);
                resetPayButton();
            });
        }
    </script>
</body>
</html>