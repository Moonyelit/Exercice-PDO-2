<?php
require_once './utils/connect_db.php';

$sql = "SELECT * FROM `patients`";

try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de données patients</title>
<link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>

<body>
    <ol>
        <h1>Liste des patients :</h1>
        <?php foreach ($users as $user): ?>
            <li class="case">
                <p>
                    <br><strong>Nom :</strong> <?= htmlspecialchars($user['lastname']); ?>
                    <br><strong>Prénom :</strong> <?= htmlspecialchars($user['firstname']); ?>
                    <br><strong>ID :</strong> <?= htmlspecialchars($user['id']); ?>
                </p>
                <h2>Afficher plus d'informations : </h2>
                <a href="./profil-patient.php?id=<?= htmlspecialchars($user['id']); ?>" class="btn">Voir le Profil</a>
            </li>
        <?php endforeach; ?>
    </ol>
    <a href="./index.php" class="btn">Revenir à l'accueil</a>
</body>

</html>
