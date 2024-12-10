<?php
require_once './utils/connect_db.php';


$sql = "SELECT patients.lastname, patients.firstname, patients.birthdate, appointments.dateHour, appointments.dateHour 
FROM patients 
LEFT JOIN appointments ON appointments.idPatients = patients.id;";


try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC); 

} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
    exit;
}

var_dump($users);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un rdv</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
<?php

foreach ($users as $user) {

$nomPrenomPatient = ($user['lastname']) . ' ' . ($user['firstname']);


?>



    <h1> Prise de rendez-vous </h1>
    <form action="./process/process_create_rdv.php" method="post">

        <select name="find-patient" id="find-patient">
            <option value="<? $nomPrenomPatient ?>">.</option>
        </select>

        <label for="dateHour">Date de naissance :</label>
        <input type="datetime-local" name="dateHour" id="dateHour" required>


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
</body>
<?php
        }
    
        ?>

</html>