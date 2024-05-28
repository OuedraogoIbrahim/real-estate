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
    @php
        $compteur = 0;
    @endphp
    <form action="{{ route('compta', ['compteur' => $compteur]) }}" method="POST" id="comptaForm">

        <input type="text" name="account" placeholder="Entrez le numero">
        @csrf
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
                @for ($i = 1; $i <= 4; $i++)
                    <tr>
                        <td><input type="text" name="date{{ $i }}"></td>
                        <td><input type="text" name="libelle{{ $i }}"></td>
                        <td><input type="number" name="debit{{ $i }}" oninput="updateBalance()"
                                updateCounter()></td>
                        <td><input type="number" name="credit{{ $i }}" oninput="updateBalance()"
                                updateCounter()></td>
                        <td></td>
                    </tr>
                    @php
                        $compteur = $i;
                    @endphp
                @endfor

                <!-- Dernière ligne pour les totaux -->
                <tr class="total-row">
                    <td>Totaux</td>
                    <td></td>
                    <td id="totalDebit">0</td>
                    <td id="totalCredit">0</td>
                    <td id="totalBalance">0</td>
                </tr>
            </tbody>
        </table>
        <input type="submit" value="Envoyer">
        <!-- Boutons -->
        <div class="btn-container">
            <button onclick="addRow(event); updateCounter();">Ajouter une ligne</button>

            <button type="submit">Enregistrer</button>
        </div>

    </form>


    <script>
        function updateCounter() {
            const form = document.getElementById('comptaForm');
            const rowCount = form.querySelectorAll('tbody tr').length - 1; // -1 pour exclure la ligne de totaux

            form.action = `{{ route('compta', ['compteur' => '']) }}${rowCount}`;
        }

        function updateBalance() {
            const rows = document.querySelectorAll('tbody tr:not(.total-row)');
            let totalDebit = 0;
            let totalCredit = 0;

            rows.forEach((row, index) => {
                let debit = parseFloat(row.querySelector(`input[name="debit${index + 1}"]`).value) || 0;
                let credit = parseFloat(row.querySelector(`input[name="credit${index + 1}"]`).value) || 0;

                let previousBalance = 0;
                if (index > 0) {
                    previousBalance = parseFloat(rows[index - 1].querySelector('td:last-child').innerText) || 0;
                }

                let balance = previousBalance + debit - credit;

                if (debit !== 0 || credit !== 0) {
                    row.querySelector('td:last-child').innerText = balance.toFixed(2);
                } else {
                    row.querySelector('td:last-child').innerText = '';
                }

                totalDebit += debit;
                totalCredit += credit;
            });

            document.getElementById('totalDebit').innerText = totalDebit.toFixed(2);
            document.getElementById('totalCredit').innerText = totalCredit.toFixed(2);
            document.getElementById('totalBalance').innerText = (totalDebit - totalCredit).toFixed(2);
        }

        function addRow(event) {
            event.preventDefault();
            const tbody = document.querySelector('tbody');
            const newRow = `
            <tr>
                <td><input type="text" name="date"></td>
                <td><input type="text" name="libelle"></td>
                <td><input type="number" name="debit" oninput="updateBalance()"></td>
                <td><input type="number" name="credit" oninput="updateBalance()"></td>
                <td></td>
            </tr>
        `;
            tbody.insertBefore(document.createElement('tr'), tbody.querySelector('.total-row')).outerHTML = newRow;
        }

        function saveData() {
            const rows = document.querySelectorAll('tbody tr:not(.total-row)');
            let data = [];

            rows.forEach((row, index) => {
                let date = row.querySelector('input[name="date"]').value;
                let libelle = row.querySelector('input[name="libelle"]').value;
                let debit = parseFloat(row.querySelector('input[name="debit"]').value) || 0;
                let credit = parseFloat(row.querySelector('input[name="credit"]').value) || 0;
                let balance = parseFloat(row.querySelector('td:last-child').innerText) || 0;

                data.push({
                    date: date,
                    libelle: libelle,
                    debit: debit,
                    credit: credit,
                    balance: balance
                });
            });

            const xhr = new XMLHttpRequest();

            xhr.open('POST', 'traitement', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // const response = JSON.parse(xhr.responseText);
                        // alert(response.message);
                        alert('succes');
                        window.location.href = 'traitement'; // Remplacez par votre route souhaitée
                    } else {
                        alert('Une erreur est survenue');
                    }
                }
            };

            xhr.send(JSON.stringify(data));

            // Enregistrement des données (simulé par une alerte)
            // alert('Données enregistrées:\n' + JSON.stringify(data, null, 2));
        }
    </script>

</body>

</html>
