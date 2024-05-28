<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil </title>
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
<script src="https://mediafiles.botpress.cloud/9f4cfe4a-8d92-4354-8a27-7c21db6fb8a4/webchat/config.js" defer></script>

</head>

<body>

    <header>
        @if (session('statut'))
            <div class="statut">
                {{ session('statut') }}
            </div>
        @endif
        <div class="logo">
            <h4 class="btn">
                <strong>ODISHA-AVENGERS</strong>
                <div id="container-stars">
                    <div id="stars"></div>
                </div>

                <div id="glow">
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
            </h4>
        </div>

        <div class="begin">
            {{-- <p><img src="{{ asset('storage/photos/property-photo.jpg') }}" alt=""></p> --}}
        </div>
        <h3> Expert dans l'immobilier</h3>
    </header>
    <nav>

        <div class="navbar">
            <ul>

                <li> <a href="{{ route('presentation') }}">Presentation</a> </li>
                <li> <a href="{{ route('nos_biens') }}">Nos Biens</a> </li>
                {{-- <li> <a href="{{ route('contact') }}">Contact</a> </li> --}}
                <li> <a href="{{ route('estimation') }}">Estimer son bien</a> </li>

            </ul>
        </div>


    </nav>

    <h1> Nos Derniers Biens </h1>
    <div class="container">
        @foreach ($appartements as $appartement)
            <div class="global" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                <div class="picture" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                    <img src="{{ asset('storage/' . $appartement->image) }}" alt="">
                </div>

                <div class="description">
                    <h3> ville : {{ $appartement->ville }}</h3>
                    <h3> Titre : {{ $appartement->titre }} </h3>
                    <h3> {{ 'surface : ' . $appartement->surface . 'm3   ' . ' -  prix : ' . $appartement->prix . ' FCFA' }}
                    </h3>
                </div>
                @php
                    $appartement->titre = Str::slug($appartement->titre, '-');
                @endphp

                <a class="view"
                    href="{{ route('show.immeuble', ['titre' => $appartement->titre, 'appartement' => $appartement->id]) }}">
                    Voir
                </a>
            </div>
        @endforeach


    </div>

    <div class="etat" data-aos="fade-up" data-aos-duration="2000">
        <ul>
            @guest
                <li> <a href="{{ route('register') }}">Inscription</a></li>
                <li> <a href="{{ route('login') }}">connexion</a></li>
            @endguest
            @auth
                <li> <a href="{{ route('logout') }}">deconnecion</a></li>
            @endauth
        </ul>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
