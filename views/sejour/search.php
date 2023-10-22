<?php
include '../../configuration/connexion.inc.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.css">
    <script src="../../css/bootstrap/js/bootstrap.js"></script>
    <title>Rechercher</title>
</head>

<body>
    <div class="container mt-3">
        <a href="./index.php" class="btn btn-secondary mt-5" style="margin-bottom: 20px; margin-left: 0;">Retour à la liste</a>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <div class="card">
                <div class="card-header">
                    <h5>Reherche d'informations de séjour</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="row col-md-12 mt-4">
                            <div class="mb-2 col">
                                <div>
                                    <label for="nom" class="col col-form-label">Nom du client</label>
                                </div>

                                <div class="col">
                                    <input id="nom" name="nom" type="text" class="form-control" autofocus>
                                </div>
                            </div>

                            <div class="mb-2 col">
                                <div>
                                    <label for="prenom" class="col col-form-label">Prenom du client</label>
                                </div>

                                <div class="col">
                                    <input id="prenom" name="prenom" type="text" class="form-control" autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <input type="submit" class="btn btn-primary mt-4" value="Rechercher">&nbsp;
                            <input type="reset" class="btn btn-danger mt-4" value="Annuler">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <?php
        include '../../configuration/connexion.inc.php';

        if (isset($_POST['nom']) && isset($_POST['prenom'])) {
            if (!empty($_POST['nom']) || !empty($_POST['prenom'])) {
                $nom = htmlspecialchars(strip_tags($_POST['nom']));
                $prenom = htmlspecialchars(strip_tags($_POST['prenom']));

                // RECUPERER L'ID DU VOYAGEUR DONC LES INFOS SONT RENSEIGNEES
                $searchNameRequest = "SELECT id_voyageur FROM voyageur WHERE nom = :nom OR prenom = :prenom";
                $stmpName = $pdo->prepare($searchNameRequest);
                $stmpName->bindParam(':nom', $nom);
                $stmpName->bindParam(':prenom', $prenom);
                if ($stmpName->execute()) {
                    $ans = $stmpName->fetchAll();
                    if (!count($ans) > 0) {
                        echo "
                            <script>
                            alert('Aucun voyageur trouvé');
                            window.location.href='../../views/sejour/search.php';
                            </script>
                        ";
                    }
                    // L"ID EST DANS $ANS
                    foreach ($ans as $res) {
                        $searchRequest = "SELECT debut, fin, id_sejour, photo, voyageur.nom AS nomVoyageur, prenom, logement.nom AS nomLogement 
                        FROM sejour, logement, voyageur 
                        WHERE sejour.code_logement = logement.code 
                            AND sejour.id_voyageur = voyageur.id_voyageur
                            AND sejour.id_voyageur = :res
                        ORDER BY id_sejour";
                        $stmp = $pdo->prepare($searchRequest);
                        $stmp->bindParam(':res', $res["id_voyageur"], PDO::PARAM_INT);
                        if ($stmp->execute()) {
                            $answers = $stmp->fetchAll();
                            echo " <div class='col-md-12 shadow p-3 bg-body rounded'>";
                            echo "<table class='table table-bordered'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th scope='col'>Nom et Prénom du voyageur</th>";
                            echo "<th scope='col'>Nom du logement</th>";
                            echo "<th scope='col'>Date de début</th>";
                            echo "<th scope='col'>Date de fin</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            if (count($answers) > 0) {
                                foreach ($answers as $answer) {
                                    echo "<tr>";
                                    echo "<td>" . $answer['nomVoyageur'] . ' ' . $answer['prenom'] . "</td>";
                                    echo "<td>" . $answer['nomLogement'] . "</td>";
                                    echo "<td>" . $answer['debut'] . "</td>";
                                    echo "<td>" . $answer['fin'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan=4 class='text-center'>Aucune information trouvée</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo " </div>";
                        }
                    }
                }
            }
        } else {
            echo "<div class='col-md-12 shadow p-3 bg-body rounded'>";
            echo 'Indiquez le nom ou le prénom !';
            echo "</div>";
        }
        ?>
    </div>

    <!-- <script>
        console.log(document.myform.elements.length);
    </script> -->
</body>

</html>