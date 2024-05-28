<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nos-Biens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/listing/index.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    <div class="elect">

        <form action="" method="GET" data-aos="fade-up" data-aos-anchor-placement="top-center"
            data-aos-duration="1000">
            <div class="radio-group">
                <h3> Choisissez une Categorie</h3>

                @foreach ($categories as $category)
                    <input class="radio-input" name="category" id="radio{{ $category->id }}" type="radio"
                        value="{{ $category->id }} " {{ $category->id == $request->category ? 'checked' : null }}>
                    <label class="radio-label" for="radio{{ $category->id }}">
                        <span class="radio-inner-circle"></span>
                        {{ $category->nom }}
                    </label>
                @endforeach
                <input type="submit" value="Rechercher">

            </div>
            {{-- <button class="login-box"> Rechercher <span></span></button> --}}
        </form>

        <div class="login-box" data-aos="fade-up" data-aos-anchor-placement="top-center" data-aos-duration="1000">
            <form action="" method="get">
                <div class="user-box">
                    <input type="number" name="prix" value="{{ $request->prix ?? null }}" autocomplete="off">
                    <label>Budget maximal</label>
                </div>
                <div class="user-box">
                    <input type="number" name="surface" value="{{ $request->surface ?? null }}" autocomplete="off">
                    <label>Surface minimale</label>
                </div>
                <div class="user-box">
                    <input type="number" name="chambres" value="{{ $request->chambres ?? null }}" autocomplete="off">
                    <label>Maximum de chambres</label>
                </div>
                <div class="user-box">
                    <input type="search" name="search" autocomplete="off">
                    <label>Nom ou Titre du bien</label>
                </div>
                <center>
                    <button>Rechercher <span></span></button>



                </center>
            </form>

        </div>

    </div>

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


    <h1> Tous nos Biens </h1>
    <div class="contain">

        @foreach ($appartements as $appartement)
            <div class="global" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                <div class="picture" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                    <img src="{{ asset('storage/' . $appartement->image) }}" alt="">
                </div>

                <div class="description">
                    <h3> {{ $appartement->ville }}</h3>
                    <h3> Type : {{ $appartement->category->nom }}</h3>
                    <span class="title"> Titre : {{ $appartement->titre }} </span>
                    <h3> Surface : {{ $appartement->surface . 'm3' }} </h3>
                    <h3> Prix : {{ $appartement->prix }} FCFA</h3>
                </div>
                @php
                    $appartement->titre = Str::slug($appartement->titre, '-');
                @endphp
                <div class="view">
                    <a
                        href="{{ route('show.immeuble', ['titre' => $appartement->titre, 'appartement' => $appartement->id]) }}">Voir</a>
                </div>
            </div>
        @endforeach

    </div>
    <div class="paginator">
        {{ $appartements->links() }}
    </div>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
