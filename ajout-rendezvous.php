<?php
require_once './utils/connect_db.php';


$sql = "SELECT patients.lastname, patients.firstname, patients.birthdate, appointments.dateHour, patients.id, appointments.dateHour 
FROM patients 
LEFT JOIN appointments ON appointments.idPatients = patients.id;";


try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC); 

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
    <title>Ajout d'un rdv</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">

</head>

<body>

    <h1> Prise de rendez-vous </h1>
    <form action="./process/process_create_rdv.php" method="post">

   <label for="find-patient">Nom prénom du patient :</label>
   <select name="id" id="find-patient">
     <?php foreach ($users as $user): ?>
        <option value="<?= htmlspecialchars($user['id']); ?>"> <!-- La valeur de ce qui sera afficher correspond à l'ID -->
            <?= htmlspecialchars($user['lastname']) . ' ' . htmlspecialchars($user['firstname']); ?> <!-- Ce qui est affiché  c'est le nom et prénom mais n'a pas de valeur -->
        </option>
    <?php endforeach; ?>
</select>


        <label for="dateHour">Date du rendez-vous :</label>
        <input type="datetime-local" name="dateHour" id="dateHour" required min="<?= date('Y-m-d\TH:i'); ?>">


        <label for="appointment">Motif de consultation :</label>
        <select name="appointment" id="appointment">
            <option value="Maladies-courantes">Maladies courantes.</option>
            <option value="Douleurs-specifiques">Douleurs spécifiques</option>
            <option value="Suivi-medical">Suivi médical ou prévention</option>
            <option value="Problèmes psychologiques">Problèmes psychologiques ou émotionnels</option>
            <option value="Consultation-spécialisée">Consultation spécialisée</option>
        </select>

        <input type="submit" value="Prendre rendez-vous">
    </form>

    <a href="./index.php" class="btn">Revenir à l'accueil</a>

</body>

</html>