<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic 35mm - Screenbites</title>
    <style>
        /* Estilos con tonos sepia/blanco para lo clásico */
        :root { --color-negro: #000000; --color-vintage: #f5f5f5; }
        body { background: var(--color-negro); color: white; font-family: 'Arial', sans-serif; margin: 0; }
        .movie-hero { position: relative; padding: 150px 5% 100px; display: flex; align-items: center; min-height: 80vh; }
        .backdrop-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?q=80&w=1920') center/cover; opacity: 0.2; z-index: -1; }
        .backdrop-gradient { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 20%, transparent, var(--color-negro) 80%); z-index: -1; }
        .movie-content { display: flex; gap: 60px; max-width: 1200px; margin: 0 auto; align-items: center; }
        .mystery-poster { width: 300px; height: 450px; border: 2px solid #555; display: flex; align-items: center; justify-content: center; background: #050505; border-radius: 12px; font-size: 100px; }
        .movie-title { font-size: 48px; font-family: 'Arial Black'; text-transform: uppercase; margin: 20px 0; }
        .btn-buy { background: white; color: black; border: none; padding: 15px 40px; font-family: 'Arial Black'; cursor: pointer; border-radius: 6px; }
        .btn-buy:disabled { background: #333; color: #666; cursor: not-allowed; }
    </style>
</head>
<body>
    <div class="movie-hero">
        <div class="backdrop-img"></div>
        <div class="backdrop-gradient"></div>
        <div class="movie-content">
            <div class="mystery-poster">🎞</div>
            <div class="movie-info">
                <span style="border: 1px solid white; color: white; padding: 4px 12px; font-weight: 900; font-size: 12px; border-radius: 4px;">VINTAGE EXPERIENCE</span>
                <h1 class="movie-title">Classic 35mm: Casablanca</h1>
                <div style="display: flex; gap: 20px; color: #888; font-weight: bold; margin-bottom: 30px;">
                    <span>B&W PROJECTION</span>
                    <span style="color: white">DEC 01 • 20:00</span>
                </div>
                <p>Cine analógico real. La magia del grano original en pantalla grande.</p>
                
                <div style="display: flex; align-items: center; margin-top: 40px;">
                    <span style="font-size: 32px; font-family: 'Arial Black'; color: white; margin-right: 20px;">$8.00</span>
                    @php
                        $eventDate = \Carbon\Carbon::create(2026, 12, 1, 20, 0, 0);
                        $isOpen = now()->greaterThanOrEqualTo($eventDate);
                    @endphp

                    @if($isOpen)
                        <button class="btn-buy" onclick="addToCart('35mm-01')">BOOK TICKETS</button>
                    @else
                        <div style="position: relative;">
                            <button class="btn-buy" disabled>BOOKING NOT YET OPEN</button>
                            <div style="position: absolute; top: 100%; left: 0; color: #888; font-size: 10px; margin-top: 8px; font-family: 'Arial Black';">
                                AVAILABLE ON: DEC 01, 2026
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>