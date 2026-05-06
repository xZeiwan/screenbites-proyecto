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
            padding-bottom: 120px; 
        }

        /* --- HEADER (Igual que en Booking) --- */
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
            font-family: 'Arial', sans-serif;
            color: var(--color-blanco, #ffffff); 
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
            color: var(--color-principal); 
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
        <a href="javascript:history.back()" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
        <button class="btn-checkout" onclick="addToCart()">
            ADD TO CART 
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px; vertical-align: middle;">
                <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
        </button>
    </div>

    <div id="cart-toast" style="position: fixed; top: 120px; right: 5%; background-color: var(--color-principal); color: var(--color-texto-btn); padding: 15px 25px; border-radius: 6px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; z-index: 9999; box-shadow: 0 10px 30px rgba(0,0,0,0.8); transform: translateX(150%); opacity: 0; transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);">
        <div style="display: flex; align-items: center; gap: 10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            Added to cart successfully!
        </div>
    </div>

    <script>
        // Variables desde PHP
        let ticketsTotal = {{ $ticketsTotal }};
        let foodTotal = 0;

        function updateItem(id, change, price) {
            const input = document.getElementById(`qty-${id}`);
            let currentQty = parseInt(input.value);
            
            if (currentQty + change >= 0) {
                input.value = currentQty + change;
                
                foodTotal += (change * price);
                let grandTotal = ticketsTotal + foodTotal;

                document.getElementById('food-total').innerText = foodTotal.toFixed(2);
                document.getElementById('grand-total').innerText = grandTotal.toFixed(2);
            }
        }

        function addToCart() {
            let globalCart = JSON.parse(localStorage.getItem('screenbites_global_cart')) || [];

            const urlParams = new URLSearchParams(window.location.search);
            const seatsSelected = urlParams.get('seats') || 'None';
            const colorParam = urlParams.get('color') || '#ffd000';
            const textColorParam = urlParams.get('textColor') || 'black';
            const movieTitleParam = urlParams.get('title') || 'Movie';

            // 1. Buscamos si ya existe un pedido para ESTA misma película (por ID)
            let existingOrderIndex = globalCart.findIndex(order => order.movieId === '{{ $id }}');

            if (existingOrderIndex > -1) {
                // --- ¡FUSIÓN! Ya existe la película en el carrito ---
                let existingOrder = globalCart[existingOrderIndex];

                // Sumamos los asientos (evitando duplicados si el usuario vuelve atrás)
                if (ticketsTotal > 0 && !existingOrder.tickets.seats.includes(seatsSelected)) {
                    existingOrder.tickets.seats += ", " + seatsSelected;
                    existingOrder.tickets.price += ticketsTotal;
                }

                // Procesamos la comida seleccionada
                const inputs = document.querySelectorAll('.qty-input');
                inputs.forEach(input => {
                    let qty = parseInt(input.value);
                    if (qty > 0) {
                        let itemId = input.id.replace('qty-', '');
                        let itemRow = input.closest('.menu-item');
                        let name = itemRow.querySelector('.item-name').innerText;
                        let price = parseFloat(itemRow.querySelector('.price-tag').innerText.replace('$', ''));

                        // ¿Ya teníamos este snack en esta película?
                        let existingFoodIndex = existingOrder.food.findIndex(f => f.id === itemId);
                        if (existingFoodIndex > -1) {
                            existingOrder.food[existingFoodIndex].qty += qty;
                            existingOrder.food[existingFoodIndex].total = existingOrder.food[existingFoodIndex].qty * price;
                        } else {
                            existingOrder.food.push({
                                id: itemId, name: name, price: price, qty: qty, total: price * qty
                            });
                        }
                    }
                });

                // Recalculamos el total del pedido fusionado
                let foodSum = existingOrder.food.reduce((sum, item) => sum + item.total, 0);
                existingOrder.orderTotal = existingOrder.tickets.price + foodSum;

            } else {
                // --- NUEVO TICKET: La película no estaba en el carrito ---
                let currentOrder = {
                    id: 'ORD-' + Date.now(),
                    movieId: '{{ $id }}',
                    movieTitle: movieTitleParam,
                    color: colorParam,
                    textColor: textColorParam,
                    tickets: { seats: seatsSelected, price: ticketsTotal },
                    food: [],
                    orderTotal: 0
                };

                const inputs = document.querySelectorAll('.qty-input');
                inputs.forEach(input => {
                    let qty = parseInt(input.value);
                    if (qty > 0) {
                        let itemRow = input.closest('.menu-item');
                        currentOrder.food.push({
                            id: input.id.replace('qty-', ''),
                            name: itemRow.querySelector('.item-name').innerText,
                            price: parseFloat(itemRow.querySelector('.price-tag').innerText.replace('$', '')),
                            qty: qty,
                            total: qty * parseFloat(itemRow.querySelector('.price-tag').innerText.replace('$', ''))
                        });
                    }
                });

                currentOrder.orderTotal = ticketsTotal + currentOrder.food.reduce((s, f) => s + f.total, 0);
                globalCart.push(currentOrder);
            }

            // 2. Guardamos y notificamos
            localStorage.setItem('screenbites_global_cart', JSON.stringify(globalCart));
            updateCartBadgeLocally();

            const toast = document.getElementById('cart-toast');
            toast.style.transform = 'translateX(0)';
            toast.style.opacity = '1';

            setTimeout(() => { window.location.href = '/#cartelera'; }, 1500);
        }

        // --- AHORA EL BADGE CUENTA LOS PEDIDOS, NO LOS PRODUCTOS ---
        function updateCartBadgeLocally() {
            let globalCart = JSON.parse(localStorage.getItem('screenbites_global_cart')) || [];
            
            // Cada elemento del array es un pedido completo (película + asientos + comida)
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

        document.addEventListener('DOMContentLoaded', updateCartBadgeLocally);
    </script>
</body>
</html>