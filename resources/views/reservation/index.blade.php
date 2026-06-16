@extends('layout.second')

@section('title', 'RESERVATION')

@section('main-style', 'reservation-main-contain')

@section('body-style', 'reservations-body')

@section('background_header', "reservations-header")

@section('header-content')
    <div class="content-commandes-header">
        <h1>Réservez votre table <br>en toute <span class="simplice">simplicité</span></h1>
        <p>
            Organisez votre prochaine visite en quelques clics. Que ce soit pour un repas en famille, <span style="color:#ffa55cad">un rendez-vous professionnel ou une occasion spéciale</span>, nous vous accueillons dans un cadre chaleureux pour une expérience mémorable.
        </p>
    </div>
@endsection

@section('content_second')
    <div class="horaires-reservation">
        <div class="horaires-item">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-icon lucide-clock"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock9-icon lucide-clock-9"><circle cx="12" cy="12" r="10"/><path d="M12 6v6H8"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-icon lucide-list"><path d="M3 5h.01"/><path d="M3 12h.01"/><path d="M3 19h.01"/><path d="M8 5h13"/><path d="M8 12h13"/><path d="M8 19h13"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-collapse-icon lucide-list-collapse"><path d="M10 5h11"/><path d="M10 12h11"/><path d="M10 19h11"/><path d="m3 10 3-3-3-3"/><path d="m3 20 3-3-3-3"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-bar-decreasing-icon lucide-chart-bar-decreasing"><path d="M3 3v16a2 2 0 0 0 2 2h16"/><path d="M7 11h8"/><path d="M7 16h3"/><path d="M7 6h12"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-plus-icon lucide-heart-plus"><path d="m14.479 19.374-.971.939a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5a5.2 5.2 0 0 1-.219 1.49"/><path d="M15 15h6"/><path d="M18 12v6"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-plus-inside-icon lucide-map-pin-plus-inside"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><path d="M12 7v6"/><path d="M9 10h6"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alarm-clock-check-icon lucide-alarm-clock-check"><circle cx="12" cy="13" r="8"/><path d="M5 3 2 6"/><path d="m22 6-3-3"/><path d="M6.38 18.7 4 21"/><path d="M17.64 18.67 20 21"/><path d="m9 13 2 2 4-4"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eraser-icon lucide-eraser"><path d="M21 21H8a2 2 0 0 1-1.42-.587l-3.994-3.999a2 2 0 0 1 0-2.828l10-10a2 2 0 0 1 2.829 0l5.999 6a2 2 0 0 1 0 2.828L12.834 21"/><path d="m5.082 11.09 8.828 8.828"/></svg> --}}
            <div class="item-part">
                <div class="picture-part">
                    <h1><a href="{{ route('.rettine') }}">La <span class="logo_R">R</span>ettine  horaires</a></h1>
                    <img src="{{ asset('img/outil-de-reveil-circulaire.png') }}" width="60%" alt="">
                </div>
                <div class="horaires-part">
                    <div class="opening-horaires">
                        <h1>Ouvert toute la semaine</h1>
                        <h2 class="hours-opening">heures d'ouvertures</h2>
                        <div class="mon-sat-hours hours">
                            <p>Lundi & Samedi</p>
                            <small>19H-23H</small>
                        </div>
                        <div class="sund-hours hours">
                            <p>Dimanche</p>
                            <small>12H-15H • 19H-23H</small>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="informations-reservations">
            <h3>Renseignez vos informations pour la reservation</h3>
            <form action="{{ route('rettine.reservations.store') }}" method="post">
                @csrf
                <div class="time_part">
                    <x-form.index name="name" label="Entrer votre nom complet" value="{{ $reservation->name ?? null }}" placeholder="John Dohe" paragraphe="votre nom, permet de vous identifier avec coutoisi lors de la livraison" />
                    <x-form.index name="phone" label="Entrer votre numero de téléphone" value="{{ $reservation->phone ?? null }}" placeholder="06 700 60 00" paragraphe="votre nom, permet de vous identifier avec coutoisi lors de la livraison" />
                </div>
                <x-form.index name="email" label="Entrer votre numero adresse email" value="{{ $reservation->email ??  null}}" placeholder="joedoe@do.fr" paragraphe="votre adresse email peut aider à vous contacter en cas de difficulté" />
                <x-form.index name="guests" type="number" value="{{ $reservation->guests ??  null}}" label="Entrer le nombre de personne pour votre reservation" paragraphe="preciser le nombre de personne nous permet de vous reserver autant de table et d'espace que possible" />
                <div class="time_part">
                    <x-form.index name="reservation_date" type="date" value="{{ $reservation->reservation_date ??  null}}" label="Entrer la date de votre reservation" paragraphe="preciser le nombre de personne nous permet de vous reserver autant de table et d'espace que possible" />
                    <x-form.index name="reservation_time" type="time" value="{{ $reservation->reservation_time ??  null}}" label="Entrer l'heure de votre reservation " paragraphe="preciser le nombre de personne nous permet de vous reserver autant de table et d'espace que possible" />
                </div>
                <x-form.index name="message" type="textarea" value="{{ $reservation->message ??  null}}" label="Entrer le nombre de personne pour votre reservation" paragraphe="preciser le nombre de personne nous permet de vous reserver autant de table et d'espace que possible" />
                <div class="reservation-containt-btn">
                    <button type="submit" class="reservation-btn">
                        @if (!$reservation)
                            Envoyer vos information pour votre Reservation
                        @else
                            Modifier vos information pour votre Reservation
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
