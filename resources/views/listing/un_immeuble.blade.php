<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Un immeuble en particulier</title>
    <link rel="stylesheet" href="{{ asset('css/listing/un_immeuble.css') }}">
</head>

<body>
    <div class="container">

        <h2> {{ $appartement->titre }}</h2>
        <div class="picture">
            <img src="{{ asset('storage/' . $appartement->image) }}" alt="">
        </div>

        <div class="ch-su">
            <h3>Chambre(s) : {{ $appartement->chambres }}</h3>
            <h3>surface : {{ $appartement->surface }} m3</h3>
        </div>

        <div class="price">
            <h1> Prix : {{ $appartement->prix }} FCFA</h1>
        </div>

        <div class="description">
            <h2> Description </h2>
            <div class="text"> {{ $appartement->description }}</div>
        </div>

        <div class="buy">
            <a href="{{ route('contact', ['id' => $appartement->id]) }}"> {{ $appartement->category->nom }}
                <span></span></a>
        </div>
    </div>
</body>

</html>
