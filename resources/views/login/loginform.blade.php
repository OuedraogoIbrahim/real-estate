<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset('css/login/loginform.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    <div class="container">

        <div class="instruction">
            <h3 data-aos="zoom-out-up" data-aos-duration="3000">Veuillez remplir tous les champs</h3>
        </div>

        <form method="post">
            @csrf
            <div>
                <p> <input data-aos="fade-down-right" data-aos-duration="3000" class="pseudo" type="text"
                        name="email" placeholder="Votre Email" autocomplete="off" value="{{ old('pseudo') }}"
                        required></p>
                @error('email')
                    <h5> {{ $message }}</h5>
                @enderror
            </div>

            <div>
                <p> <input data-aos="fade-down-right" data-aos-duration="3000" type="password" name="password"
                        placeholder="Votre mot de passe" autocomplete="off" required>
                </p>

                @error('password')
                    <h5> {{ $message }}</h5>
                @enderror

            </div>


            <div>
                <p> <input type="submit" value="Se connecter"></p>
            </div>

        </form>

        <div class="forget">
            <h4> <a href="">Mot de passe oublié ?</a> </h4>
        </div>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
