<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <!-- Inclure ici vos propres fichiers CSS et JavaScript pour personnalisation -->
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="chemin/vers/photo.jpg" class="card-img-top" alt="Photo de profil">
                    <div class="card-body">
                        <h5 class="card-title">Nom Prénom</h5>
                        <p class="card-text">Description ou informations supplémentaires sur l'utilisateur.</p>
                        <a href="#" class="btn btn-primary">Créer un événement</a>
                        <a href="#" class="btn btn-success mt-2">Ajouter un département</a>
                        <a href="#" class="btn btn-danger mt-2">Supprimer un département</a>
                        <a href="#" class="btn btn-info mt-2">Ajouter un autre utilisateur</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h2>Liste d'événements créés par l'utilisateur</h2>
                <ul class="list-group">
                    <li class="list-group-item">Événement 1</li>
                    <li class="list-group-item">Événement 2</li>
                    <li class="list-group-item">Événement 3</li>
                    <!-- Ajoutez dynamiquement les événements ici depuis votre base de données -->
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclure ici vos propres fichiers JavaScript pour l'interaction -->
</body>

</html>