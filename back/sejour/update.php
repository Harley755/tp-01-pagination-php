<?php
include '../../configuration/connexion.inc.php';

if (isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['voyageur']) && isset($_POST['logement'])) {
    if (!empty($_POST['debut']) && !empty($_POST['fin']) && !empty($_POST['voyageur']) && isset($_POST['logement'])) {
        $oldId = htmlspecialchars(strip_tags($_POST['oldId']));

        $debut = htmlspecialchars(strip_tags($_POST['debut']));
        $fin = htmlspecialchars(strip_tags($_POST['fin']));
        $voyageur = htmlspecialchars(strip_tags($_POST['voyageur']));
        $logement = htmlspecialchars(strip_tags($_POST['logement']));

        try {
            $updateLogementRequest = "UPDATE sejour SET 
            debut = :debut, 
            fin = :fin,
            id_voyageur = :voyageur,
            code_logement = :logement
            WHERE id_sejour = :oldId";
            $smtp = $pdo->prepare($updateLogementRequest);
            $smtp->bindParam(':debut', $debut);
            $smtp->bindParam(':fin', $fin);
            $smtp->bindParam(':voyageur', $voyageur, PDO::PARAM_INT);
            $smtp->bindParam(':logement', $logement);
            $smtp->bindParam(':oldId', $oldId, PDO::PARAM_INT);
            if ($smtp->execute()) {
                echo "
                <script>
                alert('Séjour mis à jour avec succès');
                window.location.href='../../views/sejour/index.php';
                </script>
            ";
            }
        } catch (\Exception $th) {
            $error = $th->getMessage();
            echo "
                <script>
                alert(\"$error\");
                window.location.href='../../views/sejour/index.php';
                </script>
            ";
        }
    } else {
        echo "
                <script>
                alert('Champs vide');
                window.location.href='../../views/sejour/index.php';
                </script>
            ";
    }
} else {
    echo "
                <script>
                alert('Champs non définis');
                window.location.href='../../views/sejour/index.php';
                </script>
            ";
}
