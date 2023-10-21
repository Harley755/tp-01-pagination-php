<?php
include '../../configuration/connexion.inc.php';

// isset($_POST['id']) cet id est un champ id du fichier edit; je le récupère pour la requête
if (isset($_POST['id'])) {
    if (!empty($_POST['id'])) {
        $id = htmlspecialchars(strip_tags($_POST['id']));

        $deleteSejourRequest = "DELETE FROM sejour
            WHERE id_sejour = :id;
        ";
        $smtp = $pdo->prepare($deleteSejourRequest);
        $smtp->bindParam(':id', $id);
        $smtp->execute();

        echo "
                <script>
                alert('Séjour supprimé avec succès');
                window.location.href='../../views/sejour/index.php';
                </script>
            ";
    }
} else {
    echo "
                <script>
                alert('L\'id n\'est pas défini');
                window.location.href='../../views/sejour/index.php';
                </script>
            ";
}
