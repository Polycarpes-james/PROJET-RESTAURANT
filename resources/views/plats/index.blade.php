@extends('layout.second')

@section('title', "PLATS")

@section('main-style')

@section('body-style', 'body-header-others')


@section('header-content')
    <div class="container-plats-info">
        <h1>Decouvrez nos plats, pour le gout et le plaisir</h1>
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus earum distinctio nisi ut eligendi. Nobis doloremque nostrum placeat deleniti sapiente quo culpa necessitatibus sed dolorem, repellat minus aspernatur praesentium veritatis.
        </p>
    </div>
@endsection

@section('content_second')
    <div class="container-plats">
        <div class="plats-items">
            <div class="content-plats">
                @foreach ($plats as $plat) 
                    <div class="item">
                        <div class="items">
                            <div class="disponible-plat" >
                                <div style="display: flex; flex-direction:column;gap:1em;margin-bottom: 1em">
                                    <p style="color:#c26214; font-size:17px;font-weight:bold;letter-spacing:1px;text-transform:uppercase;">{{ $plat->category->name }}</p>
                                    <h3>{{ $plat->name }}</h3>
                                </div>
                                <div class="comments-side">
                                    @if ($plat->sumNotes() !== 0)
                                        <div class="stars-display-item mb-2" data-note="{{ $plat->sumNotes() }}">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="star" data-index="{{ $i }}"></span>
                                            @endfor
                                        </div>
                                    @endif
                                    <div class="avis">
                                        <p>{{ $plat->nombreAvis() > 1 ? "( " . $plat->nombreAvis() . " avis )" : "( " . $plat->nombreAvis() . " avi )"}}</p>
                                    </div>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg> --}}
                                    {{ $plat->sumNotes() }}
                                </div>
                            </div>
                            <p class="description">{{ $plat->description }}</p>
                            <p class="price">{{ $plat->price }} €</p>
                            <div class="btns-panier">
                                <a href="{{ route('rettine.plats.show', ['plat' => $plat, 'slug' => $plat->getSlug()]) }}">Voir plus</a>
                            </div>
                        </div>
                        <div class="pictures-parts">
                            @if ($plat->getPicture())
                                <img src="{{ $plat->getPicture()->getPictureUrl(500, 400) }}" alt="">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection