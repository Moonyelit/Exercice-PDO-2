<?php
require_once './utils/connect_db.php';

$id = $_GET['id'];

$sql = "SELECT patients.id AS patient_id, patients.lastname, patients.firstname, patients.birthdate, patients.mail, patients.phone,
    appointments.id AS appointment_id, appointments.dateHour
FROM appointments
INNER JOIN patients ON appointments.idPatients = patients.id
WHERE patients.id = :id
ORDER BY appointments.dateHour ASC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $_GET['id']]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$users) {
        echo "Aucun rendez-vous trouvé pour ce patient.";
        exit;
    }
} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
    exit;
}

// Les informations du patient sont dans le premier enregistrement
$patientInfo = $users[0];


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
        <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($patientInfo['lastname']) ?>" required>

        <label for="firstName">Prénom :</label>
        <input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($patientInfo['firstname']) ?>" required>

        <label for="birthDate">Date de naissance :</label>
        <input type="date" name="birthDate" id="birthDate" value="<?= htmlspecialchars($patientInfo['birthdate']) ?>" required>

        <label for="phone">Téléphone :</label>
        <input type="tel" name="phone" id="phone" value="<?= htmlspecialchars($patientInfo['phone']) ?>" required>

        <label for="mail">Email :</label>
        <input type="email" name="mail" id="mail" value="<?= htmlspecialchars($patientInfo['mail']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>

    <ol>
        <?php foreach ($users as $appointment): ?>
            <li>
                <p><strong>Date du rendez-vous :</strong> <?= htmlspecialchars($appointment['dateHour']) ?></p>
                <a href="./rendezvous.php?id=<?= htmlspecialchars($appointment['appointment_id']); ?>" class="btn">Voir le rendez-vous</a>
            </li>
        <?php endforeach; ?>
    </ol>


    <a href="./liste-patients.php" class="btn">Retour à la liste</a>


</body>

</html>