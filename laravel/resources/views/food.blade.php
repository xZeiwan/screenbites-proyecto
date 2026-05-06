<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Food - Screenbites</title>
    <style>
        :root {
            --color-principal: {{ request()->query('color', '#ffd000') }};
            --color-texto-btn: {{ request()->query('textColor', 'black') }};
            --bg-color: #000000;
            --card-bg: #141414;
        }

        body {
            font-family: 'Arial Black', Arial, sans-serif;
            background-color: var(--bg-color);
            color: #fff;
            margin: 0;
            padding: 0;
            padding-bottom: 120px; /* Espacio para el footer fijo */
        }

        /* --- HEADER NAVBAR --- */
        header { 
            padding: 20px 5%; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 1px solid rgba(255,255,255,0.05); 
            background-color: rgba(0,0,0,0.8);
            backdrop-filter: blur(10px);
            top: 0;
            z-index: 100;

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
                transition: color 0.3s ease; 

                &:hover { 
                    color: var(--color-amarillo); 
                }
            }
        }

        /* --- MENU LAYOUT --- */
        .menu-container {
            max-width: 1400px;
            margin: 50px auto;
            padding: 0 5%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .menu-column {
            background-color: var(--card-bg);
            border-top: 4px solid var(--color-principal);
            border-radius: 4px;
            padding: 30px 20px;
        }

        .category-title {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            font-size: 24px;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--color-principal);
            text-align: center;
            border-bottom: 2px solid rgba(255,255,255,0.1);
            padding-bottom: 15px;
        }

        /* 1. Hacemos que cada ítem parezca una tarjeta individual */
        .menu-item {
            display: flex;
            flex-direction: column; /* Cambiamos a vertical para que la foto sea grande */
            background-color: #1a1a1a; /* Un gris un poco más claro que el fondo */
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #333;
            transition: transform 0.3s, border-color 0.3s;
            gap: 15px;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            border-color: var(--color-principal);
        }

        /* 2. Hacemos la imagen mucho más grande */
        .item-image-wrapper {
            width: 100%; /* Ocupa todo el ancho de la tarjeta */
            height: 180px; /* Altura fija para que todas sean iguales */
            border-radius: 8px;
            overflow: hidden;
            border: none;
            background-color: #000;
        }

        .item-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Esto hace que la imagen no se deforme */
        }

        /* 3. Ajustamos la información y los controles */
        .item-info {
            text-align: center;
            margin-bottom: 5px;
        }

        .item-name {
            font-size: 20px;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        .item-controls {
            display: flex;
            flex-direction: column; 
            align-items: center;
            justify-content: center;
            gap: 15px;
            width: 100%;
            border-top: 1px solid #333;
            padding-top: 20px;
        }

        /* Ajuste de las columnas para que las cards queden bien */
        .menu-list {
            display: grid;
            grid-template-columns: 1fr; /* Una card por fila dentro de cada columna */
            gap: 10px;
        }

        .price-tag {
            background: rgba(255, 208, 0, 0.1); /* Fondo suave del color principal */
            color: var(--color-principal);
            border: 1px solid var(--color-principal);
            padding: 6px 20px;
            border-radius: 4px;
            font-size: 18px;
            font-family: 'Arial Black', sans-serif;
        }

        /* Controles de Cantidad */
        .qty-wrapper {
            display: flex;
            align-items: center;
            background: #222;
            border: 1px solid #444;
            border-radius: 50px;
            padding: 5px 15px;
        }

        .btn-qty {
            background: transparent;
            border: none;
            color: var(--color-principal);
            width: 30px;
            height: 30px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-qty:hover {
            background: #333;
        }

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
            background: #0a0a0a;
            border-top: 1px solid #333;
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
            z-index: 100;
        }

        .totals {
            display: flex;
            gap: 40px;
            font-family: Arial, sans-serif;
        }

        .total-block {
            display: flex;
            flex-direction: column;
        }

        .total-label {
            color: #888;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .total-value {
            font-size: 24px;
            font-weight: bold;
            font-family: 'Arial Black', sans-serif;
        }

        .grand-total {
            color: var(--color-principal);
            font-size: 28px;
        }

        .btn-checkout {
            background: var(--color-principal);
            color: var(--color-texto-btn);
            padding: 15px 40px;
            border: none;
            border-radius: 4px;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            font-size: 14px;
            letter-spacing: 1px;
            transition: transform 0.3s, background 0.3s;
        }

        .btn-checkout:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <header>
        <a href="{{ route('booking.show', ['id' => $id]) }}" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Tickets
        </a>
        
        <div class="logo">
            <a href="/">
                <img src="{{ asset('img/img/Logo-Blanco.png') }}" alt="Screenbites Logo">
            </a>
        </div>
        
        <div style="width: 150px;"></div> 
    </header>

    <div class="menu-container">
        @foreach($menu as $categoryName => $items)
            <div class="menu-column">
                <div class="category-title">
                    {{ $categoryName }}
                </div>
                
                <div class="menu-list">
                    @foreach($items as $item)
                        <div class="menu-item">
                            <div class="item-image-wrapper">
                                <img src="{{ $item['image'] }}" onerror="this.src='https://via.placeholder.com/50x50/222/ffd000?text=+'" alt="{{ $item['name'] }}">
                            </div>

                            <div class="item-info">
                                <span class="item-name">{{ $item['name'] }}</span>
                            </div>
                            <div class="item-controls">
                                <div class="qty-wrapper">
                                    <button class="btn-qty" onclick="updateItem('{{ $item['id'] }}', -1, {{ $item['price'] }})">-</button>
                                        <input type="text" id="qty-{{ $item['id'] }}" class="qty-input" value="0">
                                    <button class="btn-qty" onclick="updateItem('{{ $item['id'] }}', 1, {{ $item['price'] }})">+</button>
                                </div>
                                <div class="price-tag">${{ number_format($item['price'], 2) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="summary-bar">
        <div class="totals">
            <div class="total-block">
                <span class="total-label">Tickets Total</span>
                <span class="total-value" style="color: #fff;">${{ number_format($ticketsTotal, 2) }}</span>
            </div>
            <div class="total-block">
                <span class="total-label">Food Total</span>
                <span class="total-value" style="color: #fff;">$<span id="food-total">0.00</span></span>
            </div>
            <div class="total-block">
                <span class="total-label">Grand Total</span>
                <span class="total-value grand-total">$<span id="grand-total">{{ number_format($ticketsTotal, 2) }}</span></span>
            </div>
        </div>
        <button class="btn-checkout" onclick="goToCheckout()">REVIEW CART & PAY</button>
    </div>

    <script>
        // Variables desde PHP
        let ticketsTotal = {{ $ticketsTotal }};
        let foodTotal = 0;

        function updateItem(id, change, price) {
            const input = document.getElementById(`qty-${id}`);
            let currentQty = parseInt(input.value);
            
            if (currentQty + change >= 0) {
                // Actualizar cantidad visual
                input.value = currentQty + change;
                
                // Actualizar totales de la barra inferior
                foodTotal += (change * price);
                let grandTotal = ticketsTotal + foodTotal;

                document.getElementById('food-total').innerText = foodTotal.toFixed(2);
                document.getElementById('grand-total').innerText = grandTotal.toFixed(2);
            }
        }

        function goToCheckout() {
            // 1. Preparamos el carrito vacío
            let cart = {};

            // 2. Metemos las entradas como el primer producto del carrito
            const urlParams = new URLSearchParams(window.location.search);
            const seatsSelected = urlParams.get('seats') || 'None';
            
            cart['tickets'] = {
                name: 'Movie Tickets (Seats: ' + seatsSelected + ')',
                price: ticketsTotal,
                qty: 1,
                isFixed: true // Tu checkout usa isFixed para no multiplicar por cantidad
            };

            // 3. Buscamos toda la comida que el usuario haya sumado (> 0)
            const inputs = document.querySelectorAll('.qty-input');
            inputs.forEach(input => {
                let qty = parseInt(input.value);
                if (qty > 0) {
                    let id = input.id.replace('qty-', ''); // Sacamos el id (ej: p1, d2)
                    let itemRow = input.closest('.menu-item');
                    let name = itemRow.querySelector('.item-name').innerText;
                    let priceText = itemRow.querySelector('.price-tag').innerText.replace('$', '');
                    let price = parseFloat(priceText);

                    // Lo añadimos al carrito
                    cart[id] = {
                        name: name,
                        price: price,
                        qty: qty,
                        isFixed: false
                    };
                }
            });

            // 4. Guardamos todo en el sessionStorage que usa tu checkout
            sessionStorage.setItem('screenbites_cart', JSON.stringify(cart));

            // 5. Redirigimos a la página de pago
            const colorParam = encodeURIComponent(urlParams.get('color') || '#ffd000');
            const textColorParam = encodeURIComponent(urlParams.get('textColor') || 'black');
            
            window.location.href = `/booking/{{ $id }}/checkout?color=${colorParam}&textColor=${textColorParam}`;
        }
    </script>
</body>
</html>