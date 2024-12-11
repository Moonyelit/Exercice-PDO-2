<?php
require_once './utils/connect_db.php';

$id = $_GET['id'];

$sql = "SELECT patients.id AS patient_id, patients.lastname, patients.firstname, patients.birthdate,
    appointments.id AS appointment_id, appointments.dateHour
FROM appointments
INNER JOIN patients ON appointments.idPatients = patients.id
WHERE     appointments.id = :appointmentid";


try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':appointmentid' => $_GET['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Rendez-vous introuvable.";
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
    <title>Modifier le rendez vous du patient</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>

<body>
    <h1>Page rendez vous du patient </h1>


    <form action="process/phpUpdateFormScript.php" method="POST">

<!-- INFOS PATIENT -->
<fieldset>
    <legend>Informations sur le patient</legend>
    <p><strong>Nom :</strong> <?= htmlspecialchars($user['lastname']) ?></p>
    <p><strong>Prénom :</strong> <?= htmlspecialchars($user['firstname']) ?></p>
    <p><strong>Né(e) le :</strong> <?= htmlspecialchars($user['birthdate']) ?></p>
    <a href="./profil-patient.php?id=<?= htmlspecialchars($user['patient_id']); ?>" class="btn">Modifier le profil</a>
</fieldset>

<!-- MODIFIER LE RDV -->
<fieldset>
    <legend>Modifier le rendez-vous</legend>
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <label for="dateHour">Date du rendez-vous :</label>
    <input 
        type="datetime-local" 
        name="dateHour" 
        id="dateHour" 
        value="<?= htmlspecialchars($user['dateHour']) ?>" 
        required 
        min="<?= date('Y-m-d\TH:i'); ?>"
    >

    <button type="submit">Mettre à jour</button>
</fieldset>

</form>

    <a href="./liste-patients.php" class="btn">Retour à la liste</a>


</body>

</html>