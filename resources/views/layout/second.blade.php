<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
      <p>📞 +242 06 555 1234</p>
      <p>📧 contact@larettine.com</p>

      <div class="social-links">
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
      </div>
    </div>

  </div>

  <div class="footer-bottom">
    <p>© {{ date('Y') }} La Rettine - Tous droits réservés.</p>
  </div>
</footer>

</html>