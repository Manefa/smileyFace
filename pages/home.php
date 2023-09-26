<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custumBouton.css">
    <link rel="stylesheet" href="../css/title-css.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Home</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-between ">
            <div class="col-md-4 mt-4 ms-4 d-flex flex-row align-items-center">
                <img src="../assets/logo.svg" width="68" height="67" alt="logo">
                <h1 class="ms-4 fw-bold ">Cegep Tr</h1>
            </div>


            <div class=" col-md-2 mt-4 me-4 d-flex justify-content-end">

                <a href="ajouter.php" class="d-flex flex-row align-items-center justify-content-end me-2" style="text-decoration: none;">

                    <div class="bg-success bg-opacity-80" style="border-radius: 8px;">
                        <img src="../assets/Add.svg" class="mx-2 my-2" width="50" height="50" alt="logo">
                    </div>
                </a>

                <a href="user.php" class="d-flex flex-row align-items-center justify-content-end" style="text-decoration: none;">

                    <div class="bg-secondary  bg-opacity-50 w-100" style="border-radius: 8px;">
                        <h3 class="text-dark mx-3 my-3">GG</h3>
                    </div>
                </a>


            </div>

        </div>

        <div class="row">
            <h1 style="padding-left: 0px;" class="ms-4 mt-5">Evenement a venir</h1>
        </div>


        <div class="row d-flex justify-content-start ms-1 me-4 mt-2">

            <div class="card mx-2 my-2" style="width: 22rem;">

                <div class="card-body  d-flex flex-column ">
                    <h5 class="card-title">Reunion de coordination</h5>
                    <div class=" mb-5 d-flex">
                        <p class="card-text">Informatique</p>
                        <p class="card-text ms-1 me-1">|</p>
                        <p class="card-text">Gox</p>
                    </div>

                    <div class="col-md-12 mt-5  d-flex justify-content-end ">
                        <button type="button" class="btn btn-danger me-2">
                            <a href="connexion.php">
                                <img src="../assets/Delete 3.svg" alt="">
                            </a>
                        </button>

                        <button type="button" class="btn btn-warning">
                            <a href="ajouter.php"><img src="../assets/Edit 3.svg" alt=""></a>

                        </button>
                        <button type="button" class="btn btn-danger ms-2">
                            <a href="connexion.php">
                                <img src="../assets/Delete 3.svg" alt="">
                            </a>
                        </button>


                    </div>

                </div>
            </div>


        </div>

        <div class="row">
            <h1 style="padding-left: 0px;" class="ms-4 mt-5">Evenement passes</h1>
        </div>

        <div class="row d-flex justify-content-start ms-1 me-4 mt-2">

            <div class="card mx-2 my-2" style="width: 22rem;">

                <div class="card-body  d-flex flex-column ">
                    <h5 class="card-title">Reunion de coordination</h5>
                    <div class=" mb-5 d-flex">
                        <p class="card-text">Informatique</p>
                        <p class="card-text ms-1 me-1">|</p>
                        <p class="card-text">Gox</p>
                    </div>

                    <div class="col-md-12 mt-5  d-flex justify-content-end ">
                        <button type="button" class="btn btn-warning">
                            <img src="../assets/Edit 3.svg" alt="">
                        </button>
                        <button type="button" class="btn btn-danger ms-2">
                            <img src="../assets/Delete 3.svg" alt="">
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>