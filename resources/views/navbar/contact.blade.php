<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
    <link rel="stylesheet" href="{{ asset('css/navbar/contact.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    @if (session('statut'))
        <div class="statut">
            {{ session('statut') }}
        </div>
    @endif

    <div class="login-box">

        <form method="post">
            @csrf
            <div class="user-box">
                <input type="text" name="nom" required autocomplete="off" value="{{ old('nom') }}">
                <label>Votre nom</label>
                @error('nom')
                    <h5> {{ $message }}</h5>
                @enderror
            </div>
            <div class="user-box">
                <input type="email" name="email" required autocomplete="off" value="{{ old('email') }}">
                <label>Votre adresse mail</label>
                @error('email')
                    <h1> {{ $message }}</h1>
                @enderror
            </div>

            <div class="user-box">
                <input type="text" name="motif" required autocomplete="off" value="{{ old('motif') }}">
                <label> Motif</label>
                @error('motif')
                    <h5> {{ $message }}</h5>
                @enderror
            </div>
            <div class="user-box">
                <input type="text" name="titre" required autocomplete="off" value="{{ $titre }}">
                <label>Titre du bien</label>
                @error('titre')
                    <h5> {{ $message }}</h5>
                @enderror
            </div>
            <center>
                <button>Envoyer <span></span></button>
            </center>
        </form>

    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</body>

</html>
