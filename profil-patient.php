// index.php
<?php
require_once './utils/connect_db.php';

$id = $_GET['id'];
// echo ($id) ; 
// return;

$sql = "SELECT * FROM patients WHERE id LIKE {$id} ";
try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetch(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

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
      
            <li>
                <p>


                    <br><strong>Nom : </strong><?= $users['lastname']  ?>

                    <br><strong>Prénom : </strong> <?= $users['firstname']  ?>

                    <br><strong>Date de naissance : </strong><?= $users['birthdate']  ?>

                    <br><strong>Téléphone : </strong><?= $users['phone']  ?>

                    <br<strong>Mail : </strong><?= $users['mail']  ?>
                </p>
            </li>

           

        <?php

        ?>

    </ol>
 <a href="./liste-patients.php" class="btn">Retour à la liste</a>
</body>

</html>
?>