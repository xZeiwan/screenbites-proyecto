<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horror Marathon - Screenbites</title>
    <style>
        :root { --color-negro: #000000; --color-terror: #ff4444; --color-gris: #111111; }
        body { background: var(--color-negro); color: white; font-family: 'Arial', sans-serif; margin: 0; }
        
        /* Hero Section */
        .movie-hero { position: relative; padding: 150px 5% 100px; display: flex; align-items: center; min-height: 80vh; overflow: hidden; }
        .backdrop-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1505635330303-d3f8462c8a01?q=80&w=1920') center/cover; opacity: 0.3; z-index: -1; filter: grayscale(0.5); }
        .backdrop-gradient { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 20%, transparent, var(--color-negro) 80%); z-index: -1; }
        
        .movie-content { display: flex; gap: 60px; max-width: 1200px; margin: 0 auto; align-items: center; }
        .mystery-poster { width: 300px; height: 450px; border: 2px solid var(--color-terror); display: flex; align-items: center; justify-content: center; background: #050505; border-radius: 12px; font-size: 100px; box-shadow: 0 0 30px rgba(255, 68, 68, 0.2); }
        
        .movie-info { flex: 1; }
        .movie-tag { background: var(--color-terror); color: black; padding: 4px 12px; font-weight: 900; font-size: 12px; border-radius: 4px; text-transform: uppercase; }
        .movie-title { font-size: 48px; font-family: 'Arial Black'; text-transform: uppercase; margin: 20px 0; line-height: 1; }
        .movie-meta { display: flex; gap: 20px; color: #888; font-weight: bold; margin-bottom: 30px; }
        .price-tag-big { font-size: 32px; font-family: 'Arial Black'; color: var(--color-terror); margin-right: 20px; }
        
        .btn-buy { background: var(--color-terror); color: black; border: none; padding: 15px 40px; font-family: 'Arial Black'; cursor: pointer; border-radius: 6px; transition: 0.3s; text-transform: uppercase; }
        .btn-buy:disabled { background: #333; color: #666; cursor: not-allowed; opacity: 0.7; }

        /* How it Works */
        .section-container { padding: 80px 10%; max-width: 1200px; margin: 0 auto; }
        .section-title { font-family: 'Arial Black'; font-size: 32px; text-transform: uppercase; margin-bottom: 40px; border-left: 5px solid var(--color-terror); padding-left: 15px; }
        .how-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .how-card { background: var(--color-gris); padding: 40px 30px; border-radius: 12px; text-align: center; border: 1px solid #222; }
        .how-card .icon { color: var(--color-terror); font-size: 30px; margin-bottom: 20px; }
        .how-card h3 { font-family: 'Arial Black'; font-size: 18px; margin-bottom: 15px; text-transform: uppercase; }
        .how-card p { color: #888; font-size: 14px; line-height: 1.6; }

        /* Clues Grid (2x2) */
        .details-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-top: 40px; }
        .detail-item { background: rgba(255,255,255,0.03); border-left: 3px solid var(--color-terror); padding: 25px; border-radius: 4px; }
        .detail-item p { font-style: italic; color: #ccc; font-size: 15px; line-height: 1.5; margin: 0; }
    </style>
</head>
<body>
    <div class="movie-hero">
        <div class="backdrop-img"></div>
        <div class="backdrop-gradient"></div>
        <div class="movie-content">
            <div class="mystery-poster">☠</div>
            <div class="movie-info">
                <span class="movie-tag">Special Event</span>
                <h1 class="movie-title">Horror Marathon: Survival</h1>
                <div class="movie-meta">
                    <span>+18</span> <span>Horror / Slahser</span> <span>Approx. 6h 00m</span> <span style="color: var(--color-terror)">Nov 12 • 23:00</span>
                </div>
                <p>Tres películas seguidas hasta el amanecer. Solo para los más valientes. ¿Podrás sobrevivir a la noche más oscura de Screenbites?</p>
                <div style="display: flex; align-items: center; margin-top: 40px;">
                    <span class="price-tag-big">$12.00</span>
                    @php
                        $eventDate = \Carbon\Carbon::create(2026, 11, 12, 23, 0, 0);
                        $isOpen = now()->greaterThanOrEqualTo($eventDate);
                    @endphp
                    <button class="btn-buy" {{ !$isOpen ? 'disabled' : '' }}>
                        {{ $isOpen ? 'BOOK MARATHON' : 'BOOKING NOT YET OPEN' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="section-container">
        <h2 class="section-title">How it works</h2>
        <div class="how-grid">
            <div class="how-card">
                <div class="icon">🔒</div>
                <h3>1. Take the challenge</h3>
                <p>Buy your marathon ticket. One single seat for three different terrifying experiences.</p>
            </div>
            <div class="how-card">
                <div class="icon">☕</div>
                <h3>2. Get your kit</h3>
                <p>Arrive early to collect your survival kit: unlimited coffee and themed snacks for the night.</p>
            </div>
            <div class="how-card">
                <div class="icon">🏆</div>
                <h3>3. Survive the night</h3>
                <p>Complete the 3 screenings to receive an exclusive "Survivor" digital badge and physical poster.</p>
            </div>
        </div>

        <div style="margin-top: 80px;">
            <h2 class="section-title">Survival Details</h2>
            <div class="details-grid">
                <div class="detail-item"><p>"The first film is a 70s slasher classic that defined the 'final girl' trope."</p></div>
                <div class="detail-item"><p>"Expect a 15-minute 'breathing break' between each movie to refill your coffee."</p></div>
                <div class="detail-item"><p>"The final screening is a modern supernatural masterpiece from the A24 studio."</p></div>
                <div class="detail-item"><p>"Strictly no exit allowed during screenings if you want to claim the final prize."</p></div>
            </div>
        </div>
    </section>
</body>
</html>