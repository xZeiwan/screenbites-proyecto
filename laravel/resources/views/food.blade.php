<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmet & Snacks - Screenbites</title>
    <style>
        :root {
            --color-principal: {{ request()->query('color', '#ffd000') }};
            --color-texto-btn: {{ request()->query('textColor', 'black') }};
            --bg-color: #050505;
            --card-bg: #0f0f0f;
            --border-color: #222;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--bg-color);
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

        header .back-btn:hover { color: var(--color-principal); }

        /* --- HERO SECTION --- */
        .food-hero {
            text-align: center;
            padding: 60px 20px 40px;
        }

        .food-hero h1 {
            font-size: 38px;
            letter-spacing: 2px;
            margin-bottom: 15px;
            background: linear-gradient(to right, #fff, #888);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .food-hero p {
            color: #888;
            font-size: 15px;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* --- LAYOUT CONTENEDOR --- */
        .content-wrapper {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 5%;
        }

        /* --- SECCIÓN EXCLUSIVOS --- */
        .exclusive-section {
            background: linear-gradient(145deg, #0d0d0d, #050505);
            border: 1px solid var(--color-principal);
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 60px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5), inset 0 0 20px rgba(255, 208, 0, 0.05);
        }

        .exclusive-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .exclusive-header h2 {
            color: var(--color-principal);
            font-size: 26px;
            letter-spacing: 2px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .exclusive-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .exclusive-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .exclusive-card.locked {
            opacity: 0.5;
            filter: grayscale(90%);
        }

        .exclusive-card.unlocked {
            border-color: var(--color-principal);
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            transform: translateY(-5px);
        }

        .exclusive-card.unlocked:hover {
            box-shadow: 0 15px 35px rgba(255, 208, 0, 0.15);
        }

        .img-container {
            position: relative;
            width: 100%;
            height: 220px;
            background-color: #0a0a0a;
            border-bottom: 2px solid #222;
        }

        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .locked-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(2px);
        }

        .locked-overlay svg { width: 45px; height: 45px; color: #fff; }

        .exclusive-info {
            padding: 25px;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .exclusive-info h3 { font-size: 18px; margin-bottom: 10px; letter-spacing: 1px; color: #fff; }
        .exclusive-info p { color: #aaa; font-size: 13px; line-height: 1.5; margin-bottom: 25px; min-height: 40px; }

        .badge {
            font-size: 10px;
            font-family: 'Arial Black', sans-serif;
            padding: 6px 14px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: inline-block;
        }

        .btn-exclusive {
            background: transparent;
            color: var(--color-principal);
            border: 2px solid var(--color-principal);
            padding: 10px 20px;
            font-weight: bold;
            font-size: 13px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            width: 100%;
        }

        .btn-exclusive:hover, .btn-exclusive.added {
            background: var(--color-principal);
            color: var(--color-texto-btn);
        }

        /* --- MENÚ REGULAR --- */
        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
        }

        .category-title {
            font-size: 20px;
            margin-bottom: 30px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 15px;
            letter-spacing: 2px;
        }

        .category-title::after {
            content: '';
            flex-grow: 1;
            height: 1px;
            background: linear-gradient(to right, var(--color-principal), transparent);
            opacity: 0.5;
        }

        .menu-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .menu-item {
            display: flex;
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 15px;
            border: 1px solid var(--border-color);
            transition: transform 0.3s, border-color 0.3s, box-shadow 0.3s;
            align-items: center;
            gap: 20px;
        }

        .menu-item:hover {
            transform: translateX(5px);
            border-color: #444;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .item-image-wrapper {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            background-color: #111;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .item-image-wrapper img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            transition: padding 0.3s;
        }

        .item-info { flex-grow: 1; }
        
        .item-name {
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            display: block;
            margin-bottom: 5px;
        }

        .price-tag {
            color: var(--color-principal);
            font-size: 16px;
            font-family: 'Arial Black', sans-serif;
            margin-bottom: 15px;
            display: block;
        }

        /* Controles de Cantidad */
        .qty-wrapper {
            display: flex;
            align-items: center;
            background: #000;
            border: 1px solid #333;
            border-radius: 6px;
            width: fit-content;
        }

        .btn-qty {
            background: transparent;
            border: none;
            color: #888;
            width: 35px;
            height: 35px;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s, background 0.3s;
        }

        .btn-qty:hover { color: #fff; background: rgba(255,255,255,0.1); }

        .qty-input {
            width: 30px;
            background: transparent;
            border: none;
            color: white;
            text-align: center;
            font-weight: bold;
            font-family: Arial, sans-serif;
            pointer-events: none;
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

        .totals { display: flex; gap: 40px; }
        .total-block { display: flex; flex-direction: column; }
        .total-label { color: #888; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .total-value { font-size: 20px; font-weight: bold; font-family: 'Arial Black', sans-serif; color: #fff; }
        .grand-total { color: var(--color-principal); font-size: 26px; }

        .btn-checkout {
            background: var(--color-principal);
            color: var(--color-texto-btn);
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

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 208, 0, 0.3);
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
            BACK TO TICKETS
        </a>
        <div class="logo">
            <a href="/"><img src="{{ asset('img/img/Logo-Blanco.png') }}" alt="Screenbites Logo"></a>
        </div>
        <div style="width: 130px;"></div>
    </header>

    <div class="food-hero">
        <h1 class="font-black">Elevate Your Experience</h1>
        <p>Complete your cinematic journey with our gourmet snacks, signature drinks, and exclusive movie collectibles delivered straight to your seat.</p>
    </div>

    <div class="content-wrapper">
        
        <!-- SECCIÓN DE EXCLUSIVOS -->
        <div class="exclusive-section">
            <div class="exclusive-header">
                <h2 class="font-black">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    EXCLUSIVE COLLECTIBLES
                </h2>
                <p style="color:#aaa;">Unlock these limited edition combos when purchasing a ticket for their respective movie.</p>
            </div>

            <div class="exclusive-grid">
                <!-- 1. VENGEANCE COMBO (Kill Bill - ID 01) -->
                <div class="exclusive-card {{ $id == '01' ? 'unlocked' : 'locked' }}">
                    <div class="img-container">
                        <!-- Usando la ruta correcta de tu index -->
                        <img src="{{ asset('img/1-Kill-Bill/kill-bill.jpeg') }}" alt="Vengeance Combo">
                        @if($id != '01') <div class="locked-overlay"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></div> @endif
                    </div>
                    <div class="exclusive-info">
                        <div>
                            <h3 class="font-black">VENGEANCE COMBO</h3>
                            <p>Yellow suit design popcorn bucket + XL Katana Cup.</p>
                        </div>
                        <div>
                            <span class="badge" style="background: #ffd000; color: #000;">KILL BILL ONLY</span>
                            <!-- Hidden input con data-image -->
                            <input type="hidden" id="qty-ex-01" class="qty-input" data-id="ex-01" data-name="Vengeance Combo" data-price="14.99" data-image="{{ asset('img/1-Kill-Bill/kill-bill.jpeg') }}" value="0">
                            
                            @if($id == '01')
                                <button id="btn-ex-01" class="btn-exclusive" onclick="toggleExclusive('ex-01', 14.99)">+ ADD 14.99</button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 2. ATOMIC COMBO (Oppenheimer - ID 04) -->
                <div class="exclusive-card {{ $id == '04' ? 'unlocked' : 'locked' }}">
                    <div class="img-container">
                        <!-- Usando la ruta correcta de tu index -->
                        <img src="{{ asset('img/4-Oppenheimer/oppenheimer.png') }}" alt="Atomic Combo">
                        @if($id != '04') <div class="locked-overlay"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></div> @endif
                    </div>
                    <div class="exclusive-info">
                        <div>
                            <h3 class="font-black">ATOMIC COMBO</h3>
                            <p>Extra Spicy Popcorn + Limited Edition Black Soda.</p>
                        </div>
                        <div>
                            <span class="badge" style="background: #e85d04; color: #fff;">OPPENHEIMER ONLY</span>
                            <!-- Hidden input con data-image -->
                            <input type="hidden" id="qty-ex-04" class="qty-input" data-id="ex-04" data-name="Atomic Combo" data-price="15.50" data-image="{{ asset('img/4-Oppenheimer/oppenheimer.png') }}" value="0">
                            
                            @if($id == '04')
                                <button id="btn-ex-04" class="btn-exclusive" onclick="toggleExclusive('ex-04', 15.50)">+ ADD 15.50</button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 3. DREAMHOUSE SNACK (Barbie - ID 09) -->
                <div class="exclusive-card {{ $id == '09' ? 'unlocked' : 'locked' }}">
                    <div class="img-container">
                        <!-- Usando la ruta correcta de tu index -->
                        <img src="{{ asset('img/9-Barbie/barbie.png') }}" alt="Dreamhouse Snack">
                        @if($id != '09') <div class="locked-overlay"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></div> @endif
                    </div>
                    <div class="exclusive-info">
                        <div>
                            <h3 class="font-black">DREAMHOUSE SNACK</h3>
                            <p>Sparkly pink bucket with sweet popcorn + Cotton Candy Drink.</p>
                        </div>
                        <div>
                            <span class="badge" style="background: #ffcf75; color: #000;">BARBIE ONLY</span>
                            <!-- Hidden input con data-image -->
                            <input type="hidden" id="qty-ex-09" class="qty-input" data-id="ex-09" data-name="Dreamhouse Snack" data-price="13.99" data-image="{{ asset('img/9-Barbie/barbie.png') }}" value="0">
                            
                            @if($id == '09')
                                <button id="btn-ex-09" class="btn-exclusive" onclick="toggleExclusive('ex-09', 13.99)">+ ADD 13.99</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN SECCIÓN DE EXCLUSIVOS -->

        <!-- MENÚ REGULAR -->
        <div class="menu-container">
            @foreach($menu as $categoryName => $items)
                @php
                    // Elegir el icono SVG correcto basándonos en el nombre de la categoría
                    $catIcon = 'popcorn.svg';
                    if(stripos($categoryName, 'drink') !== false || stripos($categoryName, 'bebida') !== false) {
                        $catIcon = 'drinks.svg';
                    } elseif(stripos($categoryName, 'sweet') !== false || stripos($categoryName, 'snack') !== false || stripos($categoryName, 'dulce') !== false) {
                        $catIcon = 'sweets.svg';
                    }
                @endphp
                
                <div class="menu-column">
                    <div class="category-title font-black">
                        <!-- Icono SVG en el título de la categoría -->
                        <img src="{{ asset('img/svg/' . $catIcon) }}" alt="Icon" style="width: 32px; height: 32px; object-fit: contain;">
                        {{ $categoryName }}
                    </div>
                    
                    <div class="menu-list">
                        @foreach($items as $item)
                            <div class="menu-item">
                                <div class="item-image-wrapper">
                                    <!-- Si no hay imagen en BD, se muestra el icono SVG de su categoría -->
                                    <img src="{{ !empty($item['image']) ? $item['image'] : asset('img/svg/' . $catIcon) }}" 
                                         onerror="this.src='{{ asset('img/svg/' . $catIcon) }}'; this.style.padding='18px';" 
                                         alt="{{ $item['name'] }}"
                                         style="{{ empty($item['image']) ? 'padding: 18px;' : '' }}">
                                </div>

                                <div class="item-info">
                                    <span class="item-name">{{ $item['name'] }}</span>
                                    <span class="price-tag">${{ number_format($item['price'], 2) }}</span>
                                    
                                    <div class="qty-wrapper">
                                        <button class="btn-qty" onclick="updateItem('{{ $item['id'] }}', -1, {{ $item['price'] }})">-</button>
                                        <!-- Input normal con data-image -->
                                        <input type="text" id="qty-{{ $item['id'] }}" class="qty-input" data-id="{{ $item['id'] }}" data-name="{{ $item['name'] }}" data-price="{{ $item['price'] }}" data-image="{{ !empty($item['image']) ? $item['image'] : '' }}" value="0">
                                        <button class="btn-qty" onclick="updateItem('{{ $item['id'] }}', 1, {{ $item['price'] }})">+</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="summary-bar">
        <div class="totals">
            <div class="total-block">
                <span class="total-label">Tickets</span>
                <span class="total-value">${{ number_format($ticketsTotal, 2) }}</span>
            </div>
            <div class="total-block">
                <span class="total-label">Food & Extras</span>
                <span class="total-value">$<span id="food-total">0.00</span></span>
            </div>
            <div class="total-block" style="padding-left: 20px; border-left: 1px solid #333;">
                <span class="total-label">Grand Total</span>
                <span class="total-value grand-total">$<span id="grand-total">{{ number_format($ticketsTotal, 2) }}</span></span>
            </div>
        </div>
        <button class="btn-checkout" onclick="addToCart()">
            ADD TO CART 
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
        </button>
    </div>

    <!-- TOAST -->
    <div id="cart-toast" style="position: fixed; top: 100px; right: 5%; background-color: var(--color-principal); color: var(--color-texto-btn); padding: 15px 25px; border-radius: 8px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; z-index: 9999; box-shadow: 0 10px 30px rgba(0,0,0,0.5); transform: translateX(150%); opacity: 0; transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);">
        <div style="display: flex; align-items: center; gap: 10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            Added to cart successfully!
        </div>
    </div>

    <script>
        // 1. AÑADIMOS LA DEFINICIÓN DE LA LLAVE MÁGICA AQUÍ TAMBIÉN
        const CART_KEY = 'screenbites_cart_{{ Auth::check() ? Auth::id() : "guest" }}';

        // Variables desde PHP
        let ticketsTotal = {{ $ticketsTotal }};
        let foodTotal = 0;

        // Función para comida normal
        function updateItem(id, change, price) {
            const input = document.getElementById(`qty-${id}`);
            let currentQty = parseInt(input.value);
            
            if (currentQty + change >= 0) {
                input.value = currentQty + change;
                foodTotal += (change * price);
                updateTotals();
            }
        }

        // Función para los combos exclusivos
        function toggleExclusive(id, price) {
            const input = document.getElementById(`qty-${id}`);
            const btn = document.getElementById(`btn-${id}`);
            
            if (input.value === "0") {
                input.value = "1";
                foodTotal += price;
                btn.innerHTML = "ADDED ✓";
                btn.classList.add("added");
            } else {
                input.value = "0";
                foodTotal -= price;
                btn.innerHTML = `+ ADD ${price.toFixed(2)}`;
                btn.classList.remove("added");
            }
            updateTotals();
        }

        function updateTotals() {
            document.getElementById('food-total').innerText = foodTotal.toFixed(2);
            document.getElementById('grand-total').innerText = (ticketsTotal + foodTotal).toFixed(2);
        }

        function addToCart() {
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];

            const urlParams = new URLSearchParams(window.location.search);
            const seatsSelected = urlParams.get('seats') || 'None';
            const colorParam = urlParams.get('color') || '#ffd000';
            const textColorParam = urlParams.get('textColor') || 'black';
            const movieTitleParam = urlParams.get('title') || 'Movie';
            
            // 1. CAPTURAMOS LA SESIÓN DE LA URL
            const sessionIdParam = urlParams.get('session') || '';

            // 2. BUSCAMOS POR SESIÓN (para permitir comprar horarios distintos de la misma peli)
            let existingOrderIndex = globalCart.findIndex(order => order.sessionId === sessionIdParam);

            // Leer lo que hay seleccionado AHORA en pantalla y extraer el data-image
            let foodItemsToAdd = [];
            document.querySelectorAll('.qty-input').forEach(input => {
                let qty = parseInt(input.value);
                if (qty > 0) {
                    foodItemsToAdd.push({
                        id: input.dataset.id,
                        name: input.dataset.name,
                        price: parseFloat(input.dataset.price),
                        image: input.dataset.image,
                        qty: qty,
                        total: qty * parseFloat(input.dataset.price)
                    });
                }
            });

            if (existingOrderIndex > -1) {
                // --- REEMPLAZAR (SOBREESCRIBIR) EN LUGAR DE SUMAR ---
                let existingOrder = globalCart[existingOrderIndex];

                // Sobreescribimos los tickets
                existingOrder.tickets = {
                    seats: seatsSelected,
                    price: ticketsTotal
                };

                // Sobreescribimos la comida con lo que hay ahora en pantalla
                existingOrder.food = foodItemsToAdd;

                // Recalculamos el total exacto
                existingOrder.orderTotal = ticketsTotal + foodItemsToAdd.reduce((sum, item) => sum + item.total, 0);

            } else {
                // NUEVO PEDIDO
                let currentOrder = {
                    id: 'ORD-' + Date.now(),
                    movieId: '{{ $id }}',
                    sessionId: sessionIdParam, // 3. LO GUARDAMOS EN EL OBJETO DEL CARRITO
                    movieTitle: movieTitleParam,
                    color: colorParam,
                    textColor: textColorParam,
                    tickets: { seats: seatsSelected, price: ticketsTotal },
                    food: foodItemsToAdd,
                    orderTotal: ticketsTotal + foodItemsToAdd.reduce((sum, item) => sum + item.total, 0)
                };
                globalCart.push(currentOrder);
            }

            // Guardar y notificar
            localStorage.setItem(CART_KEY, JSON.stringify(globalCart));
            updateCartBadgeLocally();

            const toast = document.getElementById('cart-toast');
            toast.style.transform = 'translateX(0)';
            toast.style.opacity = '1';

            // Redirigir al carrito
            setTimeout(() => { window.location.href = '/cart'; }, 1000);
        }

        function updateCartBadgeLocally() {
            // 4. QUITAMOS LAS COMILLAS A CART_KEY
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            let totalOrders = globalCart.length;
            const badge = document.getElementById('nav-cart-counter');
            if(badge) {
                badge.innerText = totalOrders;
                if(totalOrders > 0) {
                    badge.style.transform = 'scale(1.3)';
                    setTimeout(() => badge.style.transform = 'scale(1)', 200);
                }
            }
        }

        // --- PRECARGAR DATOS AL ENTRAR A LA PÁGINA ---
        document.addEventListener('DOMContentLoaded', () => {
            updateCartBadgeLocally();

            // 5. QUITAMOS LAS COMILLAS A CART_KEY
            let globalCart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            let existingOrder = globalCart.find(order => order.movieId === '{{ $id }}');

            // Si hay un pedido previo, rellenamos las cantidades de comida
            if (existingOrder && existingOrder.food) {
                existingOrder.food.forEach(item => {
                    let input = document.getElementById(`qty-${item.id}`);
                    if (input) {
                        input.value = item.qty;
                        foodTotal += item.total;
                        
                        // Si es un combo exclusivo, actualizamos la vista del botón
                        if(item.id.startsWith('ex-')) {
                            let btn = document.getElementById(`btn-${item.id}`);
                            if(btn) {
                                btn.innerHTML = "ADDED ✓";
                                btn.classList.add("added");
                            }
                        }
                    }
                });
                updateTotals(); // Actualizamos los marcadores de precio del footer
            }
        });
    </script>
</body>
</html>