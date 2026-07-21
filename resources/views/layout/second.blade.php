<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @vite(['resources/js/app.ts', 'resources/css/app.css'])
    <title>@yield('title') | RETTINE</title>
</head>
@php
    $route = request()->route()->getName();
    $background_header = trim($__env->yieldContent('background_header')); 
@endphp
<body>
    <div class="@yield('body-style', 'body-header')">
        @include('partials.nav', ['background_header' => $background_header])
        <div class="@yield('header-content-style', 'header-content')">
            @yield('header-content')
        </div>
    </div>
    <main class="@yield('main-style', 'main-container')">
        @yield('content_second')
    </main>
</body>

<footer class="footer">
  <div class="footer-container">

    <!-- Logo & Présentation -->
    <div class="footer-section logo-section">
      <h2 class="footer-logo">🍴 La Rettine</h2>
      <p>
        Une expérience culinaire unique avec des plats savoureux préparés avec passion.  
        Venez savourer nos créations dans un cadre chaleureux et moderne.
      </p>
    </div>

    <!-- Horaires -->
    <div class="footer-section">
      <h3>Horaires</h3>
      <ul>
        <li>Lundi - Vendredi : 10h - 22h</li>
        <li>Samedi : 10h - 23h</li>
        <li>Dimanche : Fermé</li>
      </ul>
    </div>

    <!-- Contact & Réseaux -->
    <div class="footer-section">
      <h3>Contact</h3>
      <p>📍 123 Rue des Saveurs, Brazzaville</p>
      <p><svg class="phone-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true">
    <circle cx="24" cy="24" r="20" fill="#34A853"/>
    <path fill="#FFF" d="M32.8,28.5l-3.4-1.5c-.5-.2-1-.1-1.3.3l-1.3,1.7c-3.1-1.6-5.5-4-7.1-7.1l1.7-1.3c.4-.3.5-.8.3-1.3l-1.5-3.4c-.2-.5-.7-.8-1.3-.7l-3.1.7c-.6.1-1,.6-1,1.2c0,9.2,7.5,16.7,16.7,16.7c.6,0,1.1-.4,1.2-1l.7-3.1C33.6,29.2,33.3,28.7,32.8,28.5z"/>
</svg> +242 06 555 1234</p>
      <p>📧 contact@larettine.com</p>

      <div class="social-links">
        <a href="#">
          <svg class="whatsapp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true">
              <path fill="#25D366" d="M24,4C12.95,4,4,12.95,4,24c0,3.9,1.1,7.5,3,10.6L4,44l9.7-2.9C16.6,42.9,20.2,44,24,44c11.05,0,20-8.95,20-20S35.05,4,24,4z"/>
              <path fill="#FFF" d="M32.5,28.2c-.5-.2-3-1.5-3.4-1.7c-.5-.2-.8-.2-1.2.2c-.3.5-1.3,1.7-1.6,2c-.3.3-.6.4-1.1.1c-.5-.2-2.1-.8-4-2.5c-1.5-1.3-2.5-2.9-2.8-3.4c-.3-.5,0-.8.2-1.1c.2-.2.5-.6.7-.9c.2-.3.3-.5.5-.8c.2-.3.1-.6,0-.8c-.1-.2-1.2-2.8-1.6-3.9c-.4-.9-.8-.8-1.1-.8h-.9c-.3,0-.8.1-1.2.5c-.4.5-1.6,1.5-1.6,3.7c0,2.2,1.6,4.3,1.8,4.6c.2.3,3.2,4.9,7.8,6.9c4.6,2,4.6,1.3,5.4,1.2c.8-.1,3-1.2,3.4-2.4c.4-1.2.4-2.2.3-2.4C33.3,28.5,33,28.4,32.5,28.2z"/>
          </svg>
        </a>
        <a href="#"
        ><svg class="instagram-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true">
              <defs>
                  <radialGradient id="ig-gradient" cx="30%" cy="107%" r="150%">
                      <stop offset="0%" stop-color="#fdf497"/>
                      <stop offset="5%" stop-color="#fdf497"/>
                      <stop offset="45%" stop-color="#fd5949"/>
                      <stop offset="60%" stop-color="#d6249f"/>
                      <stop offset="90%" stop-color="#285AEB"/>
                  </radialGradient>
              </defs>
              <rect x="6" y="6" width="36" height="36" rx="10" fill="url(#ig-gradient)"/>
              <circle cx="24" cy="24" r="8" fill="none" stroke="#fff" stroke-width="3"/>
              <circle cx="33" cy="15" r="2" fill="#fff"/>
          </svg>
        </a>
        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
      </div>
    </div>

  </div>

  <div class="footer-bottom">
    <p>© {{ date('Y') }} La Rettine - Tous droits réservés.</p>
  </div>
</footer>

</html>