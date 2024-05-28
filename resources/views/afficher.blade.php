<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tableau avec Date, Libellé, Débit, Crédit et Solde Progressif</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-row {
            background-color: #e6f7ff;
            /* Couleur de fond pour la ligne de totaux */
            font-weight: bold;
        }

        .btn-container {
            margin-top: 20px;
            text-align: center;
        }

        .btn-container button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-container button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <form action="">
        <input type="text" name="account">
        <input type="submit" value="Envoyer">
    </form>
    @if (!isset($flashes) || $flashes->isEmpty())
        <h1>Aucun mouvement </h1>
    @else
        <table>
            <!-- En-tête du tableau -->
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Libellé</th>
                    <th>Débit</th>
                    <th>Crédit</th>
                    <th>Solde Progressif</th>
                </tr>
            </thead>
            <!-- Corps du tableau -->
            <tbody>
                <!-- Les lignes de données par défaut -->
                @php
                    $solde = 0;
                    $total_debit = 0;
                    $total_credit = 0;
                @endphp
                @foreach ($flashes as $f)
                    <tr>
                        <td>{{ $f->date }}</td>
                        <td>{{ $f->libelle }}</td>
                        <td>{{ $f->debit }}</td>
                        <td>{{ $f->credit }}</td>
                        @php
                            $total_debit = $total_debit + $f->debit;
                            $total_credit = $total_credit + $f->credit;
                            $solde = $solde + $f->debit - $f->credit;
                        @endphp
                        <td>{{ $solde }}</td>
                    </tr>
                @endforeach


                <!-- Dernière ligne pour les totaux -->
                <tr class="total-row">
                    <td>Totaux</td>
                    <td></td>
                    <td id="totalDebit">{{ $total_debit }}</td>
                    <td id="totalCredit">{{ $total_credit }}</td>
                    <td id="totalBalance">{{ $solde }}</td>
                </tr>
            </tbody>
        </table>

    @endif
</body>

</html>
