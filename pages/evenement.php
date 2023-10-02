<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'événement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Nom de l'événement</h1>
                <p>Date de l'événement : 1 janvier 2023</p>
                <p>Lieu de l'événement : Lieu de l'événement</p>
                <p>Employeur concerné : Nom de l'employeur</p>
                <p>Départements concernés : Département 1, Département 2, Département 3</p>
                <p>Description de l'événement : Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="btn btn-primary">Voter pour l'événement</a>
            </div>
            <div class="col-md-6">
                <!-- Graphique des statistiques -->
                <canvas id="statsChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Données de test pour le graphique
        var ctx = document.getElementById('statsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Aimé', 'Neutre', 'Pas aimé'],
                datasets: [{
                    data: [60, 20, 20],
                    backgroundColor: ['#28a745', '#6c757d', '#dc3545'],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Statistiques de l\'événement',
                },
            },
        });
    </script>

</body>

</html>