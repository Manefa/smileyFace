<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_add_form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Ajouter</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-between ">
            <a href="home.php" class="col-md-4 mt-4 ms-4 d-flex flex-row align-items-center" style="text-decoration: none; color:black;">
                <img src="../assets/logo.svg" width="68" height="67" alt="logo">
                <h1 class="ms-4 fw-bold ">Cegep Tr</h1>
            </a>



            <div class="col-md-2 mt-4 me-4 d-flex justify-content-end">
                <a href="home.php" class="d-flex flex-row align-items-center justify-content-end " style="text-decoration: none;">

                    <div class="bg-secondary bg-opacity-50" style="border-radius: 8px;">
                        <h3 class="text-dark mx-3 my-3">MY</h3>
                    </div>
                </a>
            </div>

        </div>

        <div class="row">
            <h1 style="padding-left: 0px;" class="text-center mt-5">Ajouter un evenement</h1>
            <p style="padding-left: 0px;" class="text-center mt-1">fsdfds</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div id="booking" class="section">
                    <div class="section-center">
                        <div class="container">
                            <div class="row">
                                <div class="booking-form">
                                    <form>
                                        <div class="form-group">
                                            <span class="form-label">Nom</span>
                                            <input class="form-control" name="eventName" type="text" placeholder="Entrer le nom de l'evenement">
                                        </div>
                                        <div class="form-group">
                                            <span class="form-label">Lieu</span>
                                            <input class="form-control" name="location" type="text" placeholder="Entrer le lieu de l'evenement">
                                        </div>

                                        <!-- Nouveau champ pour la sélection de catégories -->
                                        <div class="form-group">
                                            <span class="form-label">Selectionner le(s) departemet(s) concerner :</span>
                                            <select name="departments" class="form-control" id="categorySelect">
                                                <option value="" disabled selected hidden>Sélectionnez une catégorie</option>
                                                <option value="categorie1">Catégorie 1</option>
                                                <option value="categorie2">Catégorie 2</option>
                                                <option value="categorie3">Catégorie 3</option>
                                                <option value="chui biennnnnnnnnnnnnnn">chui biennnnnnnnnnnnnnn</option>
                                                <option value="chui biennnnnnnnnnnnnn">chui biennnnnnnnnnnnnnn</option>
                                                <option value="chui biennnnnnnnnnnnn">chui biennnnnnnnnnnnnnn</option>
                                                <option value="chui biennnnnnnnnnnn">chui biennnnnnnnnnnnnnn</option>
                                                <option value="chui biennnnnnnnnnn">chui biennnnnnnnnnnnnnn</option>
                                            </select>
                                        </div>

                                        <!-- Affichage des catégories sélectionnées -->
                                        <div class="form-group">

                                            <div class="selected-categories">
                                                <!-- Les catégories sélectionnées seront affichées ici -->
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <span class="form-label">Pickup Date</span>
                                                    <input class="form-control" type="date" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <span class="form-label">Hour</span>
                                                            <select class="form-control">
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option>6</option>
                                                                <option>7</option>
                                                                <option>8</option>
                                                                <option>9</option>
                                                                <option>10</option>
                                                                <option>11</option>
                                                                <option>12</option>
                                                            </select>
                                                            <span class="select-arrow"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <span class="form-label">Min</span>
                                                            <select class="form-control">
                                                                <option>05</option>
                                                                <option>10</option>
                                                                <option>15</option>
                                                                <option>20</option>
                                                                <option>25</option>
                                                                <option>30</option>
                                                                <option>35</option>
                                                                <option>40</option>
                                                                <option>45</option>
                                                                <option>50</option>
                                                                <option>55</option>
                                                            </select>
                                                            <span class="select-arrow"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <span class="form-label">AM/PM</span>
                                                            <select class="form-control">
                                                                <option>AM</option>
                                                                <option>PM</option>
                                                            </select>
                                                            <span class="select-arrow"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-btn">
                                            <button class="submit-btn">Ajouter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 text-center d-flex align-items-center justify-content-center mb-5">
                    <img class="img-fluid" height="80%" width="80%" class="img-fluid" src="../assets/Add files-cuate.svg" alt="etudiant">
                    
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Tableau pour stocker les catégories sélectionnées
            let selectedCategories = [];

            // Fonction pour mettre à jour l'affichage des catégories sélectionnées
            function updateSelectedCategories() {
                $(".selected-categories").empty();
                selectedCategories.forEach(function(category) {
                    const categoryItem = `
                        <div style="background-color: #082D74; border: none; border-radius: 8px;" class="btn btn-success m-1">
                            ${category}
                            <button type="button" class="btn btn-danger btn-sm ms-1" data-category="${category}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                    $(".selected-categories").append(categoryItem);
                });

                // Lorsqu'on clique sur l'icône de suppression
                $(".selected-categories .btn-danger").click(function() {
                    const categoryToRemove = $(this).data("category");
                    const index = selectedCategories.indexOf(categoryToRemove);
                    if (index !== -1) {
                        selectedCategories.splice(index, 1);
                        updateSelectedCategories();
                    }
                });
            }

            // Lorsqu'une catégorie est sélectionnée dans la liste déroulante
            $("#categorySelect").change(function() {
                const selectedCategory = $(this).val();
                if (selectedCategory.trim() !== "") {
                    // Vérifier si la catégorie n'est pas déjà dans la liste
                    if (!selectedCategories.includes(selectedCategory)) {
                        selectedCategories.push(selectedCategory);
                        updateSelectedCategories();
                        $(this).val(""); // Réinitialise la liste déroulante
                    } else {
                        alert("Cette catégorie est déjà sélectionnée.");
                    }
                }
            });
        });
    </script>
</body>

</html>