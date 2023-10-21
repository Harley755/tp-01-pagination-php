<?php
include '../../configuration/connexion.inc.php';

if (isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['voyageur']) && isset($_POST['logement'])) {
    if (!empty($_POST['debut']) && !empty($_POST['fin']) && !empty($_POST['voyageur']) && isset($_POST['logement'])) {
        $debut = htmlspecialchars(strip_tags($_POST['debut']));
        $fin = htmlspecialchars(strip_tags($_POST['fin']));
        $voyageur = htmlspecialchars(strip_tags($_POST['voyageur']));
        $logement = htmlspecialchars(strip_tags($_POST['logement']));

        try {
            $createvoyageurRequest = "INSERT INTO sejour (debut, fin, id_voyageur, code_logement) VALUES (:debut, :fin, :voyageur, :logement)";

            $smtp = $pdo->prepare($createvoyageurRequest);
            $smtp->bindParam(':debut', $debut);
            $smtp->bindParam(':fin', $fin);
            $smtp->bindParam(':voyageur', $voyageur, PDO::PARAM_INT);
            $smtp->bindParam(':logement', $logement);
            if ($smtp->execute()) {
                echo "
                <script>
                alert('Séjour créé avec succès');
                window.location.href='../../views/sejour/index.php';
                </script>
            ";
            }
        } catch (\Exception $th) {
            $error = $th->getMessage();
            echo "
                <script>
                alert(\"$error\");
                window.location.href='../../views/sejour/create.php';
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
