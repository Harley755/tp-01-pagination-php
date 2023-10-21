<!-- Fait par @Brice_GOUDALO ce 09/10/2023 -->
<?php
include '../../configuration/connexion.inc.php';
$listLogementRequest = "SELECT * FROM logement WHERE disponibilite = 'oui'";
$smtp = $pdo->query($listLogementRequest);
$listLogement = $smtp->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.css">
    <script src="../../css/bootstrap/js/bootstrap.js"></script>
    <title>Liste des logements disponible</title>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="./create.php" class="btn btn-primary mt-5" style="margin-bottom: 20px; margin-left: 0;">Nouveau logement</a>
            <div class="d-fex">
                <a href="../sejour/index.php" class="btn btn-warning mt-5" style="margin-bottom: 20px; margin-left: 0;">Liste des séjours</a>
            </div>
        </div>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Capacité</th>
                        <th scope="col">Type</th>
                        <th scope="col">Lieu</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Disponibilité</th>
                        <th scope="col" style="width: 25%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($listLogement && count($listLogement) > 0) : ?>
                        <?php foreach ($listLogement as $logement) : ?>
                            <tr>
                                <td><?= $logement['nom'] ?></td>
                                <td><?= $logement['capacite'] ?></td>
                                <td><?= $logement['type'] ?></td>
                                <td><?= $logement['lieu'] ?></td>
                                <td><img style="width: 100px;heigth: 100px;" class="img-thumbnail" src="../../pubic/assets/<?= $logement['photo'] ?>" alt="Image d'un logement" srcset=""></td>
                                <td><?= $logement['disponibilite'] ?></td>
                                <td>
                                    <a class="btn btn-secondary" href="./edit.php?code=<?= $logement['code'] ?>">
                                        Modifier
                                    </a>
                                    <form action="../../back/logement/delete.php" method="post" style="display: inline-block;" class="form2">
                                        <input hidden name="code" type="text" class="form-control" value="<?= $logement['code'] ?>">
                                        <button class="btn btn-danger" type="submit">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <th colspan="10" class="text-center">
                                Aucun logement disponible
                            </th>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let form2 = document.getElementsByClassName('form2');
        console.log(form2);
        for (let i = 0; i < form2.length; i++) {
            const element = form2[i];
            element.addEventListener('submit', (e) => {
                if (!confirm('Voulez-vous supprimer un logement ?')) {
                    e.preventDefault();
                    return false;
                }
            });
        }
        // form2.addEventListener('submit', (e) => {
        //     if (!confirm('Voulez-vous supprimer une oeuvre ?')) {
        //         e.preventDefault();
        //         return false;
        //     }
        // });
    </script>
</body>

</html>