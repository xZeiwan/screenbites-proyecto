<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Screenbites</title>
    <style>
        :root {
            --color-negro: #000000;
            --color-gris-oscuro: #0a0a0a;
            --color-gris-tarjeta: #111111;
            --color-gris-claro: #333333;
            --color-blanco: #ffffff;
            --color-amarillo: #ffd000;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--color-negro);
            background-image: radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.03) 0%, transparent 70%);
            color: #fff;
            margin: 0;
            padding: 0;
            padding-bottom: 140px; 
            overflow-x: hidden;
        }

        h1, h2, h3, .font-black {
            font-family: 'Arial Black', sans-serif;
            text-transform: uppercase;
        }

        /* --- HEADER GLASSMORPHISM --- */
        header { 
            padding: 20px 5%; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 1px solid rgba(255,255,255,0.05); 
            background: rgba(5, 5, 5, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header .logo img { height: 40px; }

        header .back-btn { 
            color: #aaa; 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            font-weight: bold; 
            font-size: 13px; 
            letter-spacing: 1px;
            transition: color 0.3s ease; 
        }

        header .back-btn:hover { color: var(--color-amarillo); }

        /* --- CART LAYOUT --- */
        .cart-container {
            max-width: 1000px;
            margin: 60px auto;
            padding: 0 5%;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 15px;
            margin-bottom: 40px;
        }

        .cart-header h1 {
            font-size: 32px;
            margin: 0;
            letter-spacing: 1px;
            border-left: 5px solid var(--color-amarillo);
            padding-left: 15px;
        }

        .empty-cart-msg {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(145deg, #111, #050505);
            border-radius: 12px;
            border: 1px dashed #333;
            color: #888;
        }

        .empty-cart-msg a {
            color: var(--color-amarillo);
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border: 1px solid var(--color-amarillo);
            border-radius: 6px;
            transition: all 0.3s;
            display: inline-block;
            margin-top: 15px;
        }

        .empty-cart-msg a:hover {
            background: var(--color-amarillo);
            color: #000;
        }

        /* --- ORDER CARDS REDISEÑO PREMIUM --- */
        #orders-wrapper {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .order-card {
            background: linear-gradient(145deg, var(--color-gris-tarjeta), #050505);
            border-radius: 16px;
            border: 1px solid #222;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(0,0,0,0.8);
        }

        /* Barra de color superior */
        .order-color-bar {
            height: 6px;
            width: 100%;
        }

        .order-main-content {
            display: flex;
            padding: 30px;
            gap: 30px;
        }

        /* Zona Izquierda: Póster */
        .order-poster-container {
            width: 180px;
            flex-shrink: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            border: 1px solid #333;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .order-poster-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
            display: block;
        }

        /* Zona Derecha: Detalles */
        .order-details-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #222;
            padding-bottom: 15px;
        }

        .order-header h3 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .order-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn-icon {
            background: rgba(255,255,255,0.05);
            border: 1px solid #333;
            color: #aaa;
            cursor: pointer;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .btn-icon:hover {
            background: #222;
            color: #fff;
            transform: scale(1.05);
        }

        .btn-icon.delete:hover {
            background: rgba(255, 68, 68, 0.1);
            color: #ff4444;
            border-color: #ff4444;
        }

        /* Lista de Productos con Imágenes */
        .items-grid {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .product-row {
            display: flex;
            align-items: center;
            background: rgba(0,0,0,0.4);
            border: 1px solid #222;
            border-radius: 10px;
            padding: 12px 15px;
            transition: border-color 0.3s;
        }

        .product-row:hover {
            border-color: #444;
        }

        .product-thumb {
            width: 50px;
            height: 50px;
            border-radius: 6px;
            object-fit: cover;
            background: #111;
            margin-right: 15px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Poner padding a los SVG para que no ocupen todo el cuadrado */
        .product-thumb.svg-icon {
            padding: 8px;
            object-fit: contain;
        }

        .product-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .product-name {
            font-weight: bold;
            font-size: 15px;
            color: #eee;
        }

        .product-meta {
            font-size: 12px;
            color: #888;
        }

        .product-controls-price {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Controles de Cantidad Modificados */
        .qty-controls {
            display: flex;
            align-items: center;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 6px;
            padding: 2px;
        }

        .qty-btn {
            background: transparent;
            border: none;
            color: #aaa;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            width: 28px;
            height: 28px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }

        .item-price {
            font-family: 'Arial Black', sans-serif;
            font-size: 16px;
            min-width: 70px;
            text-align: right;
        }

        /* Subtotal */
        .order-subtotal {
            text-align: right;
            font-size: 20px;
            border-top: 1px dashed #333;
            margin-top: 20px;
            padding-top: 20px;
            font-family: 'Arial Black', sans-serif;
        }

        /* --- BOTTOM SUMMARY BAR --- */
        .summary-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(10, 10, 10, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
            z-index: 1000;
            box-shadow: 0 -10px 30px rgba(0,0,0,0.5);
        }

        .grand-total-box { display: flex; flex-direction: column; }
        .grand-total-label { color: #888; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }
        .grand-total-value { font-size: 32px; color: var(--color-amarillo); font-family: 'Arial Black', sans-serif; }

        .btn-checkout {
            background: var(--color-amarillo);
            color: #000;
            padding: 16px 40px;
            border: none;
            border-radius: 6px;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            font-size: 14px;
            letter-spacing: 1.5px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-checkout:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 208, 0, 0.3);
            background: #fff;
        }

        .btn-checkout:disabled {
            background: #333;
            color: #666;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        @media (max-width: 768px) {
            .order-main-content {
                flex-direction: column;
            }
            .order-poster-container {
                width: 100%;
                height: 200px;
            }
            .order-poster-container img {
                object-position: center 20%;
            }
            .product-controls-price {
                flex-direction: column;
                align-items: flex-end;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

    <header>
        <a href="javascript:history.back()" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            BACK TO BROWSING
        </a>
        <div class="logo">
            <a href="/"><img src="{{ asset('img/img/Logo-Blanco.png') }}" alt="Screenbites Logo"></a>
        </div>
        <div style="width: 150px;"></div>
    </header>

    <div class="cart-container">
        <div class="cart-header">
            <h1 class="font-black">Your Order</h1>
            <span id="order-count" style="color: #888; font-weight: bold;">0 items</span>
        </div>

        <div id="orders-wrapper">
            <!-- Los pedidos se inyectarán aquí vía JS -->
        </div>
    </div>

    <div class="summary-bar">
        <div class="grand-total-box">
            <span class="grand-total-label">Grand Total</span>
            <span class="grand-total-value" id="grand-total-display">$0.00</span>
        </div>
        <button class="btn-checkout" id="btn-proceed" onclick="proceedToPayment()">
            PROCEED TO PAYMENT
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>

    <script>
        // Creamos una llave única basada en el ID del usuario logueado. 
        // Si no está logueado, usará la caja "guest".
        const CART_KEY = 'screenbites_cart_{{ Auth::check() ? Auth::id() : "guest" }}';

        // Diccionario de Pósters basado en el ID de la película
        const moviePosters = {
            "01": "{{ asset('img/1-Kill-Bill/Mini.png') }}",
            "02": "{{ asset('img/2-Five-Nights/Mini.png') }}",
            "03": "{{ asset('img/3-Godzilla/Mini.png') }}",
            "04": "{{ asset('img/4-Oppenheimer/Mini.png') }}",
            "05": "{{ asset('img/5-Up/Mini.png') }}",
            "06": "{{ asset('img/6-The-Joker/Mini.png') }}",
            "07": "{{ asset('img/7-Alien/Mini.png') }}",
            "08": "{{ asset('img/8-Interstellar/Mini.png') }}",
            "09": "{{ asset('img/9-Barbie/Mini.png') }}",
            "10": "{{ asset('img/10-MammaMia/Mini.jpg') }}",
            "11": "{{ asset('img/11-Deadpool/Mini.jpg') }}",
            "12": "{{ asset('img/12-Gladiator/Mini.jpg') }}",
            "13": "{{ asset('img/13-Venom/Mini.png') }}",
            "14": "{{ asset('img/14-Mufasa/Mini.jpg') }}",
            "15": "{{ asset('img/15-Kraven/Mini.png') }}"
        };

        const currentUserRole = "{{ Auth::check() ? Auth::user()->role : 'guest' }}";

        // Función de respaldo por si el producto no trae imagen o es un pedido viejo
        function getFallbackFoodImage(name) {
            const n = name.toLowerCase();
            if (n.includes('popcorn') || n.includes('dog') || n.includes('nachos') || n.includes('pizza') || n.includes('bucket')) {
                return { src: "{{ asset('img/svg/popcorn.svg') }}", isSvg: true };
            }
            if (n.includes('cola') || n.includes('fanta') || n.includes('sprite') || n.includes('slush') || n.includes('water') || n.includes('beer') || n.includes('coffee') || n.includes('tea')) {
                return { src: "{{ asset('img/svg/drinks.svg') }}", isSvg: true };
            }
            return { src: "{{ asset('img/svg/sweets.svg') }}", isSvg: true };
        }

        document.addEventListener('DOMContentLoaded', renderCart);

        function renderCart() {
            const wrapper = document.getElementById('orders-wrapper');
            const grandTotalDisplay = document.getElementById('grand-total-display');
            const orderCountDisplay = document.getElementById('order-count');
            const btnProceed = document.getElementById('btn-proceed');

            let rawCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            let globalCart = rawCart.filter(item => item.movieId !== undefined);
            
            if (rawCart.length !== globalCart.length) {
                localStorage.setItem(CART_KEY, JSON.stringify(globalCart));
            }

            if (globalCart.length === 0) {
                wrapper.innerHTML = `
                    <div class="empty-cart-msg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 20px;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <h2 class="font-black" style="color: #fff;">YOUR CART IS EMPTY</h2>
                        <p>You haven't added any tickets or snacks yet.</p>
                        <a href="/#cartelera">BROWSE FILMS</a>
                    </div>`;
                grandTotalDisplay.innerText = '$0.00';
                orderCountDisplay.innerText = '0 items';
                btnProceed.disabled = true;
                return;
            }

            let html = '';
            let grandTotal = 0;

            globalCart.forEach((order, index) => {
                let orderTotal = order.orderTotal;
                let discountHtml = '';
                
                // --- LÓGICA VIP ---
                if (currentUserRole === 'vip') {
                    let discount = orderTotal * 0.10; // 10% de descuento
                    orderTotal = orderTotal - discount;
                    discountHtml = `<div style="color: #4ade80; font-size: 14px; margin-top: 5px;">VIP Discount (10%): -$${discount.toFixed(2)}</div>`;
                }
                
                grandTotal += orderTotal;
                //... (resto de tu código: themeColor, title, posterSrc...)
                let themeColor = order.color || '#ffd000';
                let title = order.movieTitle ? order.movieTitle.toUpperCase() : "MOVIE";
                let posterSrc = moviePosters[order.movieId] || 'https://via.placeholder.com/200x300/111/333?text=Poster';

                html += `
                <div class="order-card">
                    <div class="order-color-bar" style="background-color: ${themeColor}"></div>
                    
                    <div class="order-main-content">
                        <!-- PÓSTER DE LA PELÍCULA -->
                        <div class="order-poster-container">
                            <img src="${posterSrc}" alt="${title} Poster" onerror="this.src='https://via.placeholder.com/200x300/111/333'">
                        </div>

                        <!-- DETALLES DEL PEDIDO -->
                        <div class="order-details-container">
                            <div class="order-header">
                                <h3 class="font-black" style="color: ${themeColor}">${title}</h3>
                                <div class="order-actions">
                                    <button class="btn-icon" onclick="window.location.href='/booking/${order.movieId}'" title="Edit Seats or Food">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <button class="btn-icon delete" onclick="removeOrder(${index})" title="Remove entire order">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="items-grid">`;
                
                // TICKETS
                if (order.tickets && order.tickets.price > 0) {
                    html += `
                                <div class="product-row">
                                    <img src="{{ asset('img/img/Ticket-amarillo.png') }}" class="product-thumb svg-icon" alt="Tickets" style="background: transparent;">
                                    <div class="product-info">
                                        <span class="product-name">Cinema Tickets</span>
                                        <span class="product-meta">Seats: <strong style="color: ${themeColor}">${order.tickets.seats}</strong></span>
                                    </div>
                                    <div class="product-controls-price">
                                        <span class="item-price" style="color: #fff;">$${order.tickets.price.toFixed(2)}</span>
                                    </div>
                                </div>`;
                }

                // FOOD ITEMS
                if (order.food && order.food.length > 0) {
                    order.food.forEach((item, foodIndex) => {
                        
                        // LÓGICA PRINCIPAL DE IMÁGENES:
                        // 1. Usar la imagen guardada de WordPress
                        // 2. Si no hay (o es pedido viejo), usar la función Fallback (SVG)
                        let imgSrc = item.image && item.image !== 'undefined' && item.image !== '' ? item.image : getFallbackFoodImage(item.name).src;
                        
                        // Si la URL contiene .svg, le ponemos la clase de padding para que quede bonita
                        let imgClass = imgSrc.includes('.svg') ? "product-thumb svg-icon" : "product-thumb";

                        html += `
                                <div class="product-row">
                                    <img src="${imgSrc}" class="${imgClass}" alt="${item.name}" onerror="this.src='{{ asset('img/svg/popcorn.svg') }}'">
                                    <div class="product-info">
                                        <span class="product-name">${item.name}</span>
                                        <span class="product-meta" style="color: ${themeColor}">Qty: ${item.qty}</span>
                                    </div>
                                    <div class="product-controls-price">
                                        <div class="qty-controls">
                                            <button class="qty-btn" onclick="updateFoodQty(${index}, ${foodIndex}, -1)">-</button>
                                            <span style="width: 20px; text-align: center; font-weight: bold; font-size: 14px;">${item.qty}</span>
                                            <button class="qty-btn" onclick="updateFoodQty(${index}, ${foodIndex}, 1)">+</button>
                                        </div>
                                        <span class="item-price" style="color: #fff;">$${item.total.toFixed(2)}</span>
                                    </div>
                                </div>`;
                    });
                }

                html += `
                            </div>
                            <div class="order-subtotal" style="color: ${themeColor}">
                                Subtotal: $${order.orderTotal.toFixed(2)}
                                ${discountHtml}
                            </div>
                            <div style="text-align: right; font-size: 24px; color: #fff; margin-top: 10px; font-family: 'Arial Black', sans-serif;">
                                Final: $${orderTotal.toFixed(2)}
                            </div>
                        </div>
                    </div>
                </div>`;
            });

            wrapper.innerHTML = html;
            grandTotalDisplay.innerText = '$' + grandTotal.toFixed(2);
            orderCountDisplay.innerText = globalCart.length + (globalCart.length === 1 ? ' order' : ' orders');
            btnProceed.disabled = false;

            const badge = document.getElementById('nav-cart-counter');
            if(badge) badge.innerText = globalCart.length;
        }

        function updateFoodQty(orderIndex, foodIndex, change) {
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            let order = globalCart[orderIndex];
            let foodItem = order.food[foodIndex];
            
            foodItem.qty += change;
            if (foodItem.qty <= 0) {
                order.food.splice(foodIndex, 1);
            } else {
                foodItem.total = foodItem.qty * foodItem.price;
            }
            
            let newFoodTotal = order.food.reduce((sum, item) => sum + item.total, 0);
            let ticketsTotal = order.tickets ? order.tickets.price : 0;
            order.orderTotal = ticketsTotal + newFoodTotal;
            
            localStorage.setItem(CART_KEY, JSON.stringify(globalCart));
            renderCart();
        }

        function removeOrder(index) {
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            globalCart.splice(index, 1);
            localStorage.setItem(CART_KEY, JSON.stringify(globalCart));
            renderCart();
            
            const badge = document.getElementById('nav-cart-counter');
            if(badge) badge.innerText = globalCart.length;
        }

        function proceedToPayment() {
            // Obtenemos el total del texto del DOM (quitando el símbolo $)
            let totalText = document.getElementById('grand-total-display').innerText;
            let totalValue = parseFloat(totalText.replace('$', ''));

            // Enviamos el dato al controlador mediante una petición Fetch
            fetch('{{ route("checkout.pay") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ total: totalValue })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Vaciamos el carrito local
                localStorage.removeItem(CART_KEY);
                // Redirigimos al inicio
                window.location.href = '/';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error processing your payment.');
            });
        }
    </script>
</body>
</html>