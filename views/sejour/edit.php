<?php
include '../../configuration/connexion.inc.php';

$id = $_GET["id"];

$sejourRequest = "SELECT * FROM sejour WHERE id_sejour = :id";
$smtp = $pdo->prepare($sejourRequest);
$smtp->bindParam(':id', $id);
$smtp->execute();
if ($smtp->execute()) {
    $oneSejour = $smtp->fetchAll();
    if (!count($oneSejour) > 0) {
        header("HTTP/1.0 404 Not Found");
        exit();
    }
}

// Get all voyageur
$voyageurRequest = "SELECT * FROM voyageur";
$voyageurList = $pdo->query($voyageurRequest);
$voyageurs = $voyageurList->fetchAll();

// Get all logement
$logementRequest = "SELECT * FROM logement";
$logementList = $pdo->query($logementRequest);
$logements = $logementList->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.css">
    <script src="../../css/bootstrap/js/bootstrap.js"></script>
    <title>Modification d'un séjour</title>
</head>

<body>
    <div class="container mt-5">
        <a href="../logement/index.php" class="btn btn-secondary mt-5" style="margin-bottom: 20px; margin-left: 0;">Retour à la liste des logements</a>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <div class="card">
                <div class="card-header">
                    <h5>Modifier un joueur</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="../../back/sejour/update.php">

                        <input hidden name="oldId" type="text" class="form-control" value="<?= $oneSejour[0]['id_sejour'] ?>">

                        <div class="row col-md-12">
                            <div class="mb-2 col">
                                <div>
                                    <label for="debut" class="col-md col-form-label">Début du sejour</label>
                                </div>

                                <div class="col">
                                    <input id="debut" name="debut" type="date" class="form-control" autofocus required value="<?= $oneSejour[0]['debut'] ?>">
                                </div>
                            </div>

                            <div class="mb-2 col">
                                <div>
                                    <label for="fin" class="col col-form-label">Fin du sejour</label>
                                </div>

                                <div class="col">
                                    <input id="fin" name="fin" type="date" class="form-control" autofocus required value="<?= $oneSejour[0]['fin'] ?>">
                                </div>
                            </div>
                        </div>


                        <div class="row col-md-12 mt-3">
                            <div class="col">
                                <select class="form-control" name="voyageur" id="voyageur" required>
                                    <option value="">Veuillez selectionner un voyageur</option>
                                    <?php foreach ($voyageurs as $voyageur) : ?>
                                        <option value="<?= $voyageur['id_voyageur'] ?>" <?= ($voyageur['id_voyageur'] === $oneSejour[0]['id_voyageur']) ? 'selected' : '' ?>><?= $voyageur['nom'] . ' ' . $voyageur['prenom'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col">
                                <select class="form-control" name="logement" id="logement" required>
                                    <option value="">Veuillez selectionner un logement</option>
                                    <?php foreach ($logements as $logement) : ?>
                                        <option value="<?= $logement['code'] ?>" <?= ($logement['code'] === $oneSejour[0]['code_logement']) ? 'selected' : '' ?>><?= $logement['code'] ?></option>
                                    <?php endforeach ?>
                                </select>
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