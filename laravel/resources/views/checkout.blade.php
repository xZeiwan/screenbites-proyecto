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

                    &:hover { color: var(--color-amarillo); }
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
                            border-top: 3px solid var(--color-amarillo); 
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
            0% { transform: rotate(0deg); } 
            100% { transform: rotate(360deg); } 
        }

        /* --- PANTALLA DE ÉXITO DE PAGO --- */
        .success-overlay {
            position: fixed; 
            top: 0; left: 0; width: 100%; height: 100%;
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
            color: var(--color-amarillo); 
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
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

    </style>
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
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Visa_Inc._logo_%282021%E2%80%93present%29.svg?utm_source=commons.wikimedia.org&utm_campaign=index&utm_content=original" alt="Visa" style="height: 14px; filter: brightness(0) invert(1);">
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
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Bizum.svg?utm_source=commons.wikimedia.org&utm_campaign=index&utm_content=original" alt="Bizum" style="height: 20px; filter: brightness(0) invert(1);">
                    </div>
                    <div>Bizum</div>
                </div>
            </div>

            <form id="payment-form" onsubmit="processPayment(event)">
                
                <div id="form-card" style="display: block;">
                    <div class="form-group">
                        <label>Cardholder Name</label>
                        <input type="text" id="card-name" placeholder="e.g. Martín Pérez Fernández" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" id="card-number" placeholder="0000 0000 0000 0000" maxlength="19" minlength="19" pattern=".{19,}" title="Please enter all 16 digits" required>                    
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="text" id="card-expiry" placeholder="MM/YY" maxlength="5" minlength="5" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" title="Format must be MM/YY" required>
                        </div>
                        <div class="form-group">
                            <label>CVC</label>
                            <input type="password" id="card-cvc" placeholder="123" maxlength="3" minlength="3" pattern=".{3,}" title="Please enter 3 digits" required>
                        </div>
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
            <div class="summary-movie">{{ $movie['title'] ?? 'Movie' }} • Today, 20:30</div>

            <div class="final-cart" id="final-cart-list">
                </div>

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
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <h2>Payment Successful!</h2>
        <p>Generating your digital tickets...</p>
    </div>

    <script>
        // 1. LA CLAVE MAESTRA (Igual que en el resto de tu web)
        const CART_KEY = 'screenbites_cart_{{ Auth::check() ? Auth::id() : "guest" }}';
        
        // 2. LEER LOS DATOS DEL CARRITO GLOBAL DEL USUARIO
        const cartData = localStorage.getItem(CART_KEY);

        // --- 1. SELECCIÓN DE MÉTODO DE PAGO ---
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
            document.getElementById('card-number').required = false;
            document.getElementById('card-expiry').required = false;
            document.getElementById('card-cvc').required = false;
            document.getElementById('paypal-email').required = false;
            document.getElementById('bizum-phone').required = false;

            document.getElementById('form-' + method).style.display = 'block';
            
            if (method === 'card') {
                document.getElementById('card-name').required = true;
                document.getElementById('card-number').required = true;
                document.getElementById('card-expiry').required = true;
                document.getElementById('card-cvc').required = true;
            } else if (method === 'paypal') {
                document.getElementById('paypal-email').required = true;
            } else if (method === 'bizum') {
                document.getElementById('bizum-phone').required = true;
            }
        }

        // --- VALIDACIÓN PARA BIZUM ---
        document.getElementById('bizum-phone').addEventListener('input', function (e) {
            let value = this.value.replace(/\D/g, ''); 
            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i === 3 || i === 6) formattedValue += ' ';
                formattedValue += value[i];
            }
            this.value = formattedValue;
        });

        // --- VALIDACIONES DE LA TARJETA ---
        document.getElementById('card-name').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^A-Za-z\s]/g, '').toUpperCase();
        });

        document.getElementById('card-number').addEventListener('input', function (e) {
            let value = this.value.replace(/\D/g, '');
            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) formattedValue += ' ';
                formattedValue += value[i];
            }
            this.value = formattedValue;
        });

        document.getElementById('card-expiry').addEventListener('input', function (e) {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 2) {
                this.value = value.substring(0, 2) + '/' + value.substring(2, 4);
            } else {
                this.value = value;
            }
        });

        document.getElementById('card-cvc').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '');
        });

        // --- 2. RENDERIZAR EL RESUMEN DEL CARRITO (TICKET) ---
        const cartContainer = document.getElementById('final-cart-list');
        const totalDisplay = document.getElementById('final-total');
        let grandTotal = 0;

        if (cartData) {
            const globalCart = JSON.parse(cartData);
            
            if(globalCart.length > 0) {
                cartContainer.innerHTML = ''; 

                globalCart.forEach(order => {
                    grandTotal += order.orderTotal;

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

        // --- 3. SIMULAR EL PROCESO DE PAGO Y ENVIAR A BD ---
        function processPayment(e) {
            e.preventDefault(); 
            
            // --- PASO 1: VALIDACIONES ESTRICTAS ANTES DE SEGUIR ---
            if (currentMethod === 'card') {
                const num = document.getElementById('card-number').value.replace(/\s/g, '');
                const exp = document.getElementById('card-expiry').value;
                const cvc = document.getElementById('card-cvc').value;
                
                if (num.length < 16) return alert("Please enter all 16 digits of your card number.");
                if (exp.length < 5) return alert("Please enter a valid expiry date (MM/YY).");
                if (cvc.length < 3) return alert("Please enter the 3-digit CVC.");
                
            } else if (currentMethod === 'bizum') {
                const phone = document.getElementById('bizum-phone').value.replace(/\s/g, '');
                if (phone.length < 9) return alert("Please enter a valid 9-digit phone number.");
                
            } else if (currentMethod === 'paypal') {
                const email = document.getElementById('paypal-email').value;
                if (!email.includes('@') || !email.includes('.')) {
                    return alert("Please enter a valid PayPal email address.");
                }
            }

            // --- PASO 2: ACTUALIZAR INTERFAZ (Botón cargando) ---
            const btn = document.getElementById('btn-pay');
            const btnText = document.getElementById('btn-text');
            const loader = document.getElementById('pay-loader');
            const successScreen = document.getElementById('success-screen');

            btn.disabled = true;
            btnText.innerText = 'Processing...';
            loader.style.display = 'block';

            // --- PASO 3: PREPARAR DATOS PARA EL SERVIDOR ---
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            let paymentData = {};

            if (currentMethod === 'card') {
                paymentData = {
                    cardNumber: document.getElementById('card-number').value.replace(/\s/g, ''),
                    cardExpiry: document.getElementById('card-expiry').value,
                    cardCVC: document.getElementById('card-cvc').value
                };
            } else if (currentMethod === 'bizum') {
                paymentData = { phone: document.getElementById('bizum-phone').value.replace(/\s/g, '') };
            } else if (currentMethod === 'paypal') {
                paymentData = { email: document.getElementById('paypal-email').value };
            }

            // --- PASO 4: ENVIAR A LARAVEL ---
            fetch('/process-payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    cart: globalCart,
                    method: currentMethod,       // Le decimos si usó card, bizum o paypal
                    payment_data: paymentData    // Le pasamos los números limpios
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    successScreen.classList.add('show');
                    localStorage.removeItem(CART_KEY); // Vaciamos el carrito tras el éxito
                    
                    setTimeout(() => {
                        window.location.href = "/profile"; 
                    }, 2500);
                } else {
                    // Si el servidor (Laravel) rechaza los datos, mostramos error
                    alert("Error processing payment. Please check your details.");
                    btn.disabled = false;
                    btnText.innerText = 'Confirm Payment';
                    loader.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Server error. Please try again later.");
                btn.disabled = false;
                btnText.innerText = 'Confirm Payment';
                loader.style.display = 'none';
            });
        }
    </script>
</body>
</html>