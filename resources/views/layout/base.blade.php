<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite(['resources/js/app.ts', 'resources/css/app.css'])
    <title>@yield('title') | RETTINE</title>
</head>
@php
    $route = request()->route()->getName();
    $background_header = trim($__env->yieldContent('background_header')); 

@endphp
<body>
    <div class="@yield('body-style', 'body-header')" style="background: radial-gradient(600% 200px at 0% 0%, #000000bc 0, transparent 500%), @yield('image-header')">
        @include('partials.nav', ['background_header' => $background_header])
        @yield('firstpart')
    </div>
    <main class="@yield('main-style', 'main-container')">
        @yield('content')
    </main>
</body>
<footer class="footer">
  <div class="footer-container">
    
    <!-- Logo & Présentation -->
    <div class="footer-section">
      <h2 class="footer-logo">🍴 La Rettine</h2>
      <p>
        Découvrez une cuisine authentique et savoureuse, préparée avec passion et des ingrédients frais.  
        Venez vivre une expérience culinaire unique dans un cadre chaleureux.
      </p>
    </div>

    <!-- Horaires -->
    <div class="footer-section">
      <h3>Horaires</h3>
      <ul>
        <li>Lun - Ven : 10h - 22h</li>
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