<?php
require_once './utils/connect_db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM patients WHERE id = :id";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Patient introuvable.";
        exit;
    }
} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil patient</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
    </head>
<body>
    <h1>Modifier les informations du patient</h1>
    <form action="process/phpUpdateFormScript.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <label for="lastName">Nom :</label>
        <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($user['lastname']) ?>" required>
        
        <label for="firstName">Prénom :</label>
        <input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($user['firstname']) ?>" required>

        <label for="birthDate">Date de naissance :</label>
        <input type="date" name="birthDate" id="birthDate" value="<?= htmlspecialchars($user['birthdate']) ?>" required>

        <label for="phone">Motif de consultation :</label>
        <input type="tel" name="phone" id="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>

        <label for="mail">Email :</label>
        <input type="email" name="mail" id="mail" value="<?= htmlspecialchars($user['mail']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
    <a href="./liste-patients.php" class="btn">Retour à la liste</a>


</body>

</html>
 