// index.php
<?php
require_once './utils/connect_db.php';

$sql = "SELECT * FROM patients WHERE id = :id";
try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFIL patient</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <ol>
        <h1>Liste des patients:</h1>
        <?php

        foreach ($users as $user) {
        ?>

            <li>
                <p>


                    <br><strong>Nom : </strong><?= $user['lastname']  ?>

                    <br><strong>Prénom : </strong> <?= $user['firstname']  ?>

                    <br><strong>Date de naissance : </strong><?= $user['birthdate']  ?>

                    <br><strong>Téléphone : </strong><?= $user['phone']  ?>

                    <br<strong>Mail : </strong><?= $user['mail']  ?>
                </p>
            </li>

           

        <?php
        }
var_dump($users);
        ?>

    </ol>
 <a href="./liste-patients.php" class="btn">Retour à la liste</a>
</body>

</html>
?>