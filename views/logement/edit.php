<?php
include '../../configuration/connexion.inc.php';

$code = $_GET["code"];

$logementRequest = "SELECT * FROM logement WHERE code = :code";
$smtp = $pdo->prepare($logementRequest);
$smtp->bindParam(':code', $code);
$smtp->execute();
if ($smtp->execute()) {
    $oneLogement = $smtp->fetchAll();
    if (!count($oneLogement) > 0) {
        header("HTTP/1.0 404 Not Found");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.css">
    <script src="../../css/bootstrap/js/bootstrap.js"></script>
    <title>Modification d'un logement</title>
</head>

<body>
    <div class="container mt-5">
        <a href="./index.php" class="btn btn-secondary mt-2" style="margin-bottom: 20px; margin-left: 0;">Retour à la liste</a>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <div class="card">
                <div class="card-header">
                    <h5>Modifier un logement</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="../../back/logement/update.php" enctype="multipart/form-data">
                        <input hidden name="oldCode" type="text" class="form-control" value="<?= $oneLogement[0]['code'] ?>">

                        <div class="row col-md-12">
                            <div class="mb-2 col">
                                <div>
                                    <label for="code" class="col-md col-form-label">Code du logement</label>
                                </div>

                                <div class="col">
                                    <input id="code" name="code" type="text" class="form-control" autofocus required value="<?= $oneLogement[0]['code'] ?>">
                                </div>
                            </div>

                            <div class="mb-2 col">
                                <div>
                                    <label for="nom" class="col col-form-label">nom du logement</label>
                                </div>

                                <div class="col">
                                    <input id="nom" name="nom" type="text" class="form-control" autofocus required value="<?= $oneLogement[0]['nom'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12">
                            <div class="mb-2 col">
                                <div>
                                    <label for="capacite" class="col col-form-label">Capacite du logement</label>
                                </div>

                                <div class="col">
                                    <input id="capacite" type="number" class="form-control" name="capacite" autocomplete="capacite" required value="<?= $oneLogement[0]['capacite'] ?>">
                                </div>
                            </div>
                            <div class="mb-2 col">
                                <div>
                                    <label for="type" class="col-md col-form-label">Type du logement</label>
                                </div>

                                <div class="col">
                                    <input id="type" name="type" type="text" class="form-control" autofocus required value="<?= $oneLogement[0]['type'] ?>">
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
                                        <input id="lieu" name="lieu" type="text" class="form-control" autofocus required value="<?= $oneLogement[0]['lieu'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2 col-md">
                                <div class="col-md-6">
                                    <div>
                                        <label for="photo" class="col-md col-form-label">Photo du logement</label>
                                    </div>

                                    <div class="col">
                                        <input id="photo" name="photo" type="file" class="form-control" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <img style="width: 150px;heigth: 150px;" class="img-thumbnail" src="../../pubic/assets/<?= $oneLogement[0]['photo'] ?>" alt="Image d'un logement" srcset="">
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
                                            <input class="form-check-input" value="oui" type="radio" name="disponibilite" id="disponibilite1" <?= $oneLogement[0]['disponibilite'] == 'oui' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="disponibilite1">
                                                Oui
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="non" type="radio" name="disponibilite" id="disponibilite2" <?= $oneLogement[0]['disponibilite'] == 'non' ? 'checked' : '' ?>>
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
</body>

</html>