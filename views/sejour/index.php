<!-- Fait par @Brice_GOUDALO ce 09/10/2023 -->
<?php
include '../../configuration/connexion.inc.php';

$limit = (isset($_POST['limit-records']) && $_POST['limit-records'] !== "") ? $_POST['limit-records'] :  5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * intval($limit);


$listSejourRequest = "SELECT id_sejour, photo, voyageur.nom AS nomVoyageur, prenom, logement.nom AS nomLogement 
    FROM sejour, logement, voyageur 
    WHERE sejour.code_logement = logement.code 
        AND sejour.id_voyageur = voyageur.id_voyageur
    ORDER BY id_sejour
    LIMIT $start, $limit
        ";
$smtp = $pdo->query($listSejourRequest);
$listSejour = $smtp->fetchAll();

// NBRE D'ELEMENTS
$listSejourNumberRequest = "SELECT count(id_sejour) AS id_sejour FROM sejour";
$smtp2 = $pdo->query($listSejourNumberRequest);
$nbreSejour = $smtp2->fetchAll();
$total = $nbreSejour[0]['id_sejour'];

// NBRE DE PAGE A AVOIR
// SI ON EN A 30 AU TOTAL ET QUE LA LIMIT EST 5, $PAGE = 6
$pages = ceil($total / $limit);

$previous = $page - 1;
$next = $page + 1;


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
            <div class="d-flex">
                <a href="./create.php" class="btn btn-primary mt-3" style="margin-bottom: 20px; margin-left: 0;">Nouveau Séjour</a> &nbsp;
                <a href="../logement/index.php" class="btn btn-secondary mt-3" style="margin-bottom: 20px; margin-left: 0;">Liste des logements</a>
            </div>
            <a href="./search.php" class="btn btn-warning mt-3" style="margin-bottom: 20px; margin-left: 0;">Rechercher</a>
        </div>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <div class="d-flex justify-content-end col-md-auto">

                <form action="#" method="post" id="formLimit">
                    <select class="form-control" name="limit-records" id="limit-records">
                        <option value="">Définissez une limite</option>
                        <?php foreach ([10, 100, 500, 1000, 5000] as $limit) : ?>
                            <option value="<?= $limit ?>" <?= (($_POST ? $_POST['limit-records'] : 5) == $limit) ? 'selected' : '' ?>><?= $limit ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th scope="col">Nom du Logement</th>
                        <th scope="col">Nom et Prénoms du Voyageur</th>
                        <th scope="col">Image de logement</th>
                        <th scope="col" style="width: 25%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($listSejour && count($listSejour) > 0) : ?>
                        <?php foreach ($listSejour as $sejour) : ?>
                            <tr>
                                <td><?= $sejour['nomLogement'] ?></td>
                                <td><?= $sejour['nomVoyageur'] . ' ' . $sejour['prenom'] ?></td>
                                <td><img style="width: 100px;heigth: 100px;" class="img-thumbnail" src="../../pubic/assets/<?= $sejour['photo'] ?>" alt="Image d'un logement" srcset=""></td>
                                <td>
                                    <a class="btn btn-secondary" href="./edit.php?id=<?= $sejour['id_sejour'] ?>">
                                        Modifier
                                    </a>
                                    <form action="../../back/sejour/delete.php" method="post" style="display: inline-block;" class="form2">
                                        <input hidden name="id" type="text" class="form-control" value="<?= $sejour['id_sejour'] ?>">
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
                                Aucun séjour disponible
                            </th>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>

            <!-- LIEN POUR LA PAGINATION -->
            <nav aria-label="Page navigation example" class="mt-4">
                <ul class="pagination justify-content-end">
                    <!-- <li class="page-item disabled"> -->
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="./index.php?page=<?= $previous; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                        <li class="page-item"><a class="page-link <?= ($i == $page) ? 'active' : ''  ?>" href="./index.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link <?= ($page >= $pages) ? 'disabled' : '' ?>" href="./index.php?page=<?= $next; ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script>
        let form2 = document.getElementsByClassName('form2');
        const limitRecords = document.getElementById('limit-records');
        let formLimit = document.getElementById('formLimit');

        for (let i = 0; i < form2.length; i++) {
            const element = form2[i];
            element.addEventListener('submit', (e) => {
                if (!confirm('Voulez-vous supprimer un séjour ?')) {
                    e.preventDefault();
                    return false;
                }
            });
        }

        window.addEventListener('load', () => {
            limitRecords.addEventListener('change', () => {
                formLimit.submit();
                console.log(limitRecords.value);
            });
        });
    </script>
</body>

</html>