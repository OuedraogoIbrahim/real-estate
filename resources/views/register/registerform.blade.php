<!DOCTYPE html>
<html lang="fr">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/register/registerform.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    <div class="container">

        <div class="instruction">
            <h3 data-aos="zoom-out-up" data-aos-duration="3000">Veuillez remplir tous les champs</h3>
        </div>

        <form action="" method="post">

            @csrf
            <div>
                <p> <input data-aos="fade-down-right" data-aos-duration="3000" class="pseudo" type="text"
                        name="pseudo" placeholder="Votre pseudo" autocomplete="off" value="{{ old('pseudo') }}"
                        required></p>
                @error('pseudo')
                    <h5>{{ $message }}</h5>
                @enderror
            </div>

            <div>
                <p> <input data-aos="fade-down-right" data-aos-duration="3000" type="email" name="email"
                        placeholder="Votre email" autocomplete="off" value="{{ old('email') }}" required>
                </p>
                @error('email')
                    <h5> {{ $message }}</h5>
                @enderror
            </div>

            <div>
                <p> <input data-aos="fade-down-right" data-aos-duration="3000" type="password" name="mdp"
                        placeholder="Votre mot de passe" autocomplete="off" required>
                </p>
                @error('mdp')
                    <h5> {{ $message }}</h5>
                @enderror
            </div>

            <div>
                <p> <input data-aos="fade-down-right" data-aos-duration="3000" type="password" name="mdp_confirmation"
                        placeholder="Confrmer le mot de passe" autocomplete="off" required>
                </p>
                @error('mdp_confirmation')
                    <h5> {{ $message }}</h5>
                @enderror
            </div>


            <div>
                <p> <input type="submit" value="S'inscrire"></p>
            </div>

        </form>

        <div class="pass">
            <h4> <a href="{{ route('login') }}">Vous avez deja un compte?</a> </h4>
        </div>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
