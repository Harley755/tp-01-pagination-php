<?php
include '../../configuration/connexion.inc.php';

// isset($_POST['id']) cet id est un champ id du fichier edit; je le récupère pour la requête
if (isset($_POST['code'])) {
    if (!empty($_POST['code'])) {
        $code = htmlspecialchars(strip_tags($_POST['code']));

        // SI LE LOGEMENT EST SUPPRIME, LE SEJOUR LE SERAIT AUSSI CAR
        // DANS SEJOUT, Y A code_logement
        $deleteLogementFromSejourRequest = "DELETE FROM sejour
            WHERE code_logement = :code;
        ";
        $smtp2 = $pdo->prepare($deleteLogementFromSejourRequest);
        $smtp2->bindParam(':code', $code);
        $smtp2->execute();

        // ON SUPPRIME ENSUITE LE LOGEMENT (LE FILS AVANT LE PERE)
        $deleteLogementRequest = "DELETE FROM logement
            WHERE code = :code;
        ";
        $smtp = $pdo->prepare($deleteLogementRequest);
        $smtp->bindParam(':code', $code);
        $smtp->execute();

        echo "
                <script>
                alert('Logement supprimé avec succès');
                window.location.href='../../views/logement/index.php';
                </script>
            ";
    }
} else {
    echo "
                <script>
                alert('Le code n\'est pas défini');
                window.location.href='../../views/logement/index.php';
                </script>
            ";
}
