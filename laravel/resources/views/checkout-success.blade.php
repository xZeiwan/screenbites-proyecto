<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Screenbites</title>
    <style>
        :root {
            --color-negro: #000000;
            --color-principal: #ffd000; 
            --color-blanco: #ffffff;
        }

        body { 
            margin: 0; 
            font-family: 'Arial Black', sans-serif;
            background-color: var(--color-negro); 
            color: var(--color-blanco); 
            height: 100vh;
            overflow: hidden; 
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* --- PANTALLA DE ÉXITO DE PAGO ESTÁNDAR --- */
        .success-overlay {
            display: none; 
            flex-direction: column;
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

        /* --- PANTALLA DE REVELACIÓN (BLIND TICKET) --- */
        .blind-reveal-overlay {
            display: none;
            flex-direction: column; 
            align-items: center; 
            justify-content: center;
            width: 100%;
            height: 100%;
        }
        
        .blind-reveal-overlay.show { display: flex; }
        
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
            opacity: 0; 
            transform: scale(0.8); 
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
            font-size: 32px; 
            color: var(--color-principal); 
            margin-bottom: 10px; 
            text-transform: uppercase; 
        }

        .reveal-text p { color: #aaa; font-size: 16px; margin-bottom: 25px; }
        
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

        .flash-bang {
            position: absolute; top:0; left:0; width:100%; height:100%;
            background: white; z-index: 20; opacity: 0; pointer-events: none;
        }

        .flash-bang.active { animation: flashAnim 1s ease-out forwards; }
        @keyframes flashAnim { 0% { opacity: 1; } 100% { opacity: 0; } }
    </style>
</head>
<body>

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
            <button class="btn-home" onclick="window.location.href='/profile'">SEE MY TICKETS</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hasBlindTicket = {{ $hasBlindTicket ? 'true' : 'false' }};
            const revealedId = "{{ $revealedMovieId ?? '' }}";
            const userId = "{{ Auth::check() ? Auth::id() : 'guest' }}";

            // Si compró el ticket ciego...
            if (hasBlindTicket && revealedId) {
                // 1. Guardamos la marca en su navegador para que la Portada sepa que ya lo compró
                localStorage.setItem('purchased_blind_' + userId, 'true');

                // 2. Diccionario de imágenes y nombres (Igual que en tu checkout)
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

                let recId = String(revealedId).padStart(2, '0');
                let revealedMovie = movieCatalog[recId] || { title: "Mystery Screenbites Film", img: "https://via.placeholder.com/300x450/111/ffd000?text=Top+Secret" };

                // 3. Cargamos los datos en pantalla
                document.getElementById('revealed-poster').src = revealedMovie.img;
                document.querySelector('#reveal-text h2').innerText = revealedMovie.title;

                // 4. Disparamos la animación
                document.getElementById('blind-reveal-screen').classList.add('show');
                
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

            } 
            else {
                document.getElementById('success-screen').classList.add('show');
                setTimeout(() => { 
                    window.location.href = "/profile"; 
                }, 2500);
            }
        });

        const CART_KEY = 'screenbites_cart_{{ Auth::check() ? Auth::id() : "guest" }}';
        localStorage.removeItem(CART_KEY);
    </script>
</body>
</html>