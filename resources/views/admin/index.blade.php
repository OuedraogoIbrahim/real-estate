<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">

</head>

<body>
    @if (session('statut'))
        <div class="statut">
            {{ session('statut') }}
        </div>
    @endif

    <div class="creation">
        <a href="{{ route('admin.create') }}">Ajouter</a>
    </div>

    <div class="container">


        <table>
            <thead>
                <tr>
                    <th> NUMERO </th>
                    <th> TITRE </th>
                    <th> VILLE </th>
                    <th> PRIX </th>
                    <th colspan="3">ACTIONS </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appartements as $appartement)
                    <tr>
                        <td> # {{ $appartement->id }} </td>
                        <td>{{ $appartement->titre }}</td>
                        <td>{{ $appartement->ville }}</td>
                        <td>{{ number_format($appartement->prix, thousands_separator: '.') . ' FCFA' }}</td>
                        <td><a href="{{ route('admin.show', ['admin' => $appartement->id]) }}">Voir</a></td>
                        <td><a href="{{ route('admin.edit', ['admin' => $appartement->id]) }}">Editer</a></td>
                        <td>
                            <form action="{{ route('admin.destroy', ['admin' => $appartement->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Voulez vous suprimer l\'article #{{ $appartement->id }}')">
                                    <span>Supprimer</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    <div class="links">
        {{ $appartements->links() }}
    </div>
</body>

</html>
