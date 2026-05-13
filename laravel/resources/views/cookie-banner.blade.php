@if(!Auth::check() || is_null(Auth::user()->cookie_consent))
<div id="cookie-banner" class="cookie-banner">
    <div class="cookie-content">
        <div class="cookie-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffd000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"></path>
                <path d="M8.5 8.5v.01"></path>
                <path d="M16 12.5v.01"></path>
                <path d="M12 16v.01"></path>
                <path d="M11 12.5v.01"></path>
            </svg>
            <strong>Cookie Consent</strong>
        </div>
        <p>We use cookies to improve Screenbites. Your choice will be saved in your profile.</p>
    </div>
    <div class="cookie-actions">
        <button onclick="saveConsent('rejected')" class="btn-cookie-reject">Decline</button>
        <button onclick="saveConsent('accepted')" class="btn-cookie-accept">Accept All</button>
    </div>
</div>
@endif

<style>
    .cookie-banner {
        position: fixed; bottom: 0; left: 0; width: 100%;
        background: #0a0a0a; border-top: 2px solid #ffd000;
        padding: 20px 5%; display: flex; justify-content: space-between;
        align-items: center; z-index: 99999; box-shadow: 0 -10px 30px rgba(0,0,0,0.8);
        visibility: hidden; opacity: 0; transition: all 0.5s ease;
    }
    .cookie-banner.show { visibility: visible; opacity: 1; }
    
    .cookie-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 5px;
    }

    .cookie-content p {
        margin: 0;
        font-size: 13px;
        color: #aaa;
        max-width: 800px;
        line-height: 1.5;
    }
    
    .cookie-header strong {
        color: #ffffff;
        font-family: 'Arial Black', sans-serif;
        text-transform: uppercase;
        font-size: 15px;
        letter-spacing: 0.5px;
    }

    .btn-cookie-accept { background: #ffd000; color: black; border: none; padding: 10px 20px; font-weight: bold; cursor: pointer; border-radius: 4px; text-transform: uppercase; font-size: 11px; transition: all 0.3s; }
    .btn-cookie-accept:hover { transform: scale(1.05); }
    
    .btn-cookie-reject { background: transparent; color: white; border: 1px solid #444; padding: 10px 20px; cursor: pointer; border-radius: 4px; margin-right: 10px; text-transform: uppercase; font-size: 11px; transition: all 0.3s; }
    .btn-cookie-reject:hover { background: #333; }

    @media (max-width: 768px) {
        .cookie-banner { flex-direction: column; text-align: center; gap: 15px; }
        .cookie-header { justify-content: center; }
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const banner = document.getElementById('cookie-banner');
    
    // Si el banner existe en el HTML
    if (banner) {
        // Comprobamos si el usuario es invitado y ya tiene una cookie guardada en LocalStorage
        @if(!Auth::check())
            if (!localStorage.getItem('screenbites_cookie_consent')) {
                // Si no hay respuesta guardada en localStorage, lo mostramos
                banner.classList.add('show');
            }
        @else
            // Si el usuario ESTÁ logueado y el banner se ha impreso (significa que en DB es null), lo mostramos
            banner.classList.add('show');
        @endif
    }
});

function saveConsent(type) {
    const banner = document.getElementById('cookie-banner');

    @if(Auth::check())
        // USUARIO REGISTRADO: Guardar en la Base de Datos
        fetch("{{ route('cookie.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ consent: type })
        })
        .then(response => {
            if(response.ok) {
                banner.classList.remove('show');
            } else {
                console.error("Error saving cookie consent to DB.");
                // Ocultar de todos modos para mejorar la UX
                banner.classList.remove('show');
            }
        })
        .catch(error => console.error("Fetch error:", error));
    @else
        // USUARIO INVITADO (NO REGISTRADO): Guardar en LocalStorage
        localStorage.setItem('screenbites_cookie_consent', type);
        banner.classList.remove('show');
    @endif
}
</script>