<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarantino Q&A - Screenbites</title>
    <style>
        /* Estilos similares pero con toques amarillos/dorados */
        :root { --color-negro: #000000; --color-amarillo: #ffd000; }
        body { background: var(--color-negro); color: white; font-family: 'Arial', sans-serif; margin: 0; }
        .movie-hero { position: relative; padding: 150px 5% 100px; display: flex; align-items: center; min-height: 80vh; }
        .backdrop-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1485846234645-a62644f84728?q=80&w=1920') center/cover; opacity: 0.3; z-index: -1; }
        .backdrop-gradient { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 20%, transparent, var(--color-negro) 80%); z-index: -1; }
        .movie-content { display: flex; gap: 60px; max-width: 1200px; margin: 0 auto; align-items: center; }
        .mystery-poster { width: 300px; height: 450px; border: 2px solid var(--color-amarillo); display: flex; align-items: center; justify-content: center; background: #050505; border-radius: 12px; font-size: 100px; color: var(--color-amarillo); }
        .movie-title { font-size: 48px; font-family: 'Arial Black'; text-transform: uppercase; margin: 20px 0; }
        .btn-buy { background: var(--color-amarillo); color: black; border: none; padding: 15px 40px; font-family: 'Arial Black'; cursor: pointer; border-radius: 6px; }
        .btn-buy:disabled { background: #333; color: #666; cursor: not-allowed; }
    </style>
</head>
<body>
    <div class="movie-hero">
        <div class="backdrop-img"></div>
        <div class="backdrop-gradient"></div>
        <div class="movie-content">
            <div class="mystery-poster">🎙</div>
            <div class="movie-info">
                <span style="background: var(--color-amarillo); color: black; padding: 4px 12px; font-weight: 900; font-size: 12px; border-radius: 4px;">EXCLUSIVE</span>
                <h1 class="movie-title">Director's Q&A: Tarantino</h1>
                <div style="display: flex; gap: 20px; color: #888; font-weight: bold; margin-bottom: 30px;">
                    <span>SPECIAL EVENT</span>
                    <span style="color: var(--color-amarillo)">NOV 18 • 19:30</span>
                </div>
                <p>Proyección de Pulp Fiction seguida de charla en directo con el director.</p>
                
                <div style="display: flex; align-items: center; margin-top: 40px;">
                    <span style="font-size: 32px; font-family: 'Arial Black'; color: var(--color-amarillo); margin-right: 20px;">$15.00</span>
                    @php
                        $eventDate = \Carbon\Carbon::create(2026, 11, 18, 19, 30, 0);
                        $isOpen = now()->greaterThanOrEqualTo($eventDate);
                    @endphp

                    @if($isOpen)
                        <button class="btn-buy" onclick="addToCart('tarantino-01')">BOOK TICKETS</button>
                    @else
                        <div style="position: relative;">
                            <button class="btn-buy" disabled>BOOKING NOT YET OPEN</button>
                            <div style="position: absolute; top: 100%; left: 0; color: #888; font-size: 10px; margin-top: 8px; font-family: 'Arial Black';">
                                AVAILABLE ON: NOV 18, 2026
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>