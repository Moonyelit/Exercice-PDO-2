// index.php
<?php
require_once './utils/connect_db.php';

// REFAIRE requete sql avec les select et prendre le code a coté ? J'ai échangé comme une abrutie ?
$sql = "SELECT * FROM `patients`";

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
    <title>Base de données patients</title>
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

                    <br><strong>ID : </strong> <?= $user['id']  ?>


                </p>
<h2>Afficher toutes les données relatives a ce patient</h2>
<a href="./profil-patient.php?id=<?php echo $user['id']?>" class="btn">Voir le Profil</a>

            </li>


        <?php
        }
var_dump($users)
        ?>

    </ol>

</body>

</html>
?>