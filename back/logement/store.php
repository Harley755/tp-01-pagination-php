<?php
include '../../configuration/connexion.inc.php';

if (isset($_POST['code']) && isset($_POST['nom']) && isset($_POST['capacite']) && isset($_POST['type']) && isset($_POST['lieu']) && isset($_FILES['photo'])) {
    if (!empty($_POST['code']) && !empty($_POST['nom']) && !empty($_POST['capacite']) && isset($_POST['type']) && !empty($_POST['lieu']) && !empty($_FILES['photo'])) {
        $code = htmlspecialchars(strip_tags($_POST['code']));
        $nom = htmlspecialchars(strip_tags($_POST['nom']));
        $capacite = htmlspecialchars(strip_tags($_POST['capacite']));
        $type = htmlspecialchars(strip_tags($_POST['type']));
        $lieu = htmlspecialchars(strip_tags($_POST['lieu']));
        $photo = htmlspecialchars(strip_tags($_FILES['photo']['name']));
        $disponibilite = htmlspecialchars(strip_tags($_POST['disponibilite']));


        try {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (in_array($_FILES['photo']['type'], $allowedTypes)) {

                $createLogementRequest = "INSERT INTO logement VALUES (:code, :nom, :capacite, :type, :lieu, :photo, :disponibilite)";

                $smtp = $pdo->prepare($createLogementRequest);
                $smtp->bindParam(':code', $code);
                $smtp->bindParam(':nom', $nom);
                $smtp->bindParam(':capacite', $capacite);
                $smtp->bindParam(':type', $type);
                $smtp->bindParam(':lieu', $lieu);
                $smtp->bindParam(':photo', $photo);
                $smtp->bindParam(':disponibilite', $disponibilite);

                $uploadDir = '../../pubic/assets/';
                $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    if ($smtp->execute()) {
                        echo "
                            <script>
                            alert('Logement crée avec succès');
                            window.location.href='../../views/logement/index.php';
                            </script>
                        ";
                    }
                } else {
                    echo "
                            <script>
                            alert('Une erreur est survenue');
                            window.location.href='../../views/logement/create.php';
                            </script>
                        ";
                }
            } else {
                echo "
                <script>
                alert('Le fichier n\'est pas une image');
                window.location.href='../../views/logement/create.php';
                </script>
            ";
            }
        } catch (\Exception $th) {
            $error = $th->getMessage();
            echo "
                <script>
                alert(\"$error\");
                window.location.href='../../views/logement/create.php';
                </script>
            ";
        }
    } else {
        echo "
                <script>
                alert('Champs vide');
                window.location.href='../../views/logement/create.php';
                </script>
            ";
    }
} else {
    echo "
                <script>
                alert('Champs non définis');
                window.location.href='../../views/logement/index.php';
                </script>
            ";
}
