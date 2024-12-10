// index.php
<?php
require_once './utils/connect_db.php';

$sql = "SELECT * FROM `patients`";

try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}

?>
;
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


            $lastName = $user['lastname'];
            $firstName = $user['firstname'];
            $id = $user['id'];

        ?>

            <li>
                <p>

                    <br><strong>Nom : </strong><?= $lastName  ?>

                    <br><strong>Prénom : </strong> <?= $firstName ?>

                    <br><strong>ID : </strong> <?= $id  ?>

                </p>
                <h2>Afficher toutes les données relatives a ce patient</h2>
                <a href="./profil-patient.php?id=<?php echo $user['id'] ?>" class="btn">Voir le Profil</a>

            </li>


        <?php
        }
    
        ?>

    </ol>

</body>

</html>
?>