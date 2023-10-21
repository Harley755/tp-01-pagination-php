<?php
include '../../configuration/connexion.inc.php';

// Get all equipe
// $equipeRequest = "SELECT * FROM equipe";
// $equipeList = $pdo->query($equipeRequest);
// $equipes = $equipeList->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.css">
    <script src="../../css/bootstrap/js/bootstrap.js"></script>
    <title>Creation d'un logement</title>
</head>

<body>
    <div class="container mt-5">
        <a href="./index.php" class="btn btn-secondary mt-5" style="margin-bottom: 20px; margin-left: 0;">Retour à la liste</a>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <div class="card">
                <div class="card-header">
                    <h5>Creer un logement</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="../../back/logement/store.php" enctype="multipart/form-data">

                        <div class="row col-md-12">
                            <div class="mb-2 col">
                                <div>
                                    <label for="code" class="col-md col-form-label">Code du logement</label>
                                </div>

                                <div class="col">
                                    <input id="code" name="code" type="text" class="form-control" autofocus required>
                                </div>
                            </div>

                            <div class="mb-2 col">
                                <div>
                                    <label for="nom" class="col col-form-label">nom du logement</label>
                                </div>

                                <div class="col">
                                    <input id="nom" name="nom" type="text" class="form-control" autofocus required>
                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12">
                            <div class="mb-2 col">
                                <div>
                                    <label for="capacite" class="col col-form-label">Capacite du logement</label>
                                </div>

                                <div class="col">
                                    <input id="capacite" type="number" class="form-control" name="capacite" autocomplete="capacite" required>
                                </div>
                            </div>
                            <div class="mb-2 col">
                                <div>
                                    <label for="type" class="col-md col-form-label">Type du logement</label>
                                </div>

                                <div class="col">
                                    <input id="type" name="type" type="text" class="form-control" autofocus required>
                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12 mt-4">
                            <div class="col">
                                <div class="mb-2 col">
                                    <div>
                                        <label for="lieu" class="col-md-3 col-form-label">Lieu du logement</label>
                                    </div>

                                    <div class="col">
                                        <input id="lieu" name="lieu" type="text" class="form-control" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col">
                                <div>
                                    <label for="photo" class="col-md col-form-label">Photo du logement</label>
                                </div>

                                <div class="col">
                                    <input id="photo" name="photo" type="file" class="form-control" autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12 mt-4">
                            <div class="col">
                                <div class="mb-2 col">
                                    <div>
                                        <label for="lieu" class="col-md-3 col-form-label">Disponibilité</label>
                                    </div>

                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" value="oui" type="radio" name="disponibilite" id="disponibilite1" checked>
                                            <label class="form-check-label" for="disponibilite1">
                                                Oui
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="non" type="radio" name="disponibilite" id="disponibilite2">
                                            <label class="form-check-label" for="disponibilite2">
                                                Non
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary mt-4" value="Enregistrer">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>