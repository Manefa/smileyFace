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
    <title>Home</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-between ">
            <div class="col-md-4 mt-4 ms-4 d-flex flex-row align-items-center">
                <img src="../assets/logo.svg" width="68" height="67" alt="logo">
                <h1 class="ms-4 fw-bold ">Cegep Tr</h1>
            </div>


            <div class="col-md-2 mt-4 me-4 d-flex justify-content-end">
                <a href="home.php" class="d-flex flex-row align-items-center justify-content-end " style="text-decoration: none;">

                    <div class="bg-secondary bg-opacity-50" style="border-radius: 8px;">
                        <h1 class="text-dark mx-2 my-2">MY</h1>
                    </div>
                </a>
            </div>

        </div>

        <div class="row">
            <h1 style="padding-left: 0px;" class="mb-3 mt-3">Evenement A venir</h1>
        </div>

        <div class="row d-flex justify-content-between ms-4 me-4 mt-5">



            <div class="card" style="width: 18rem;">

                <div class="card-body   d-flex flex-column ">
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

            <div class="card" style="width: 18rem;">

                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">

                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>