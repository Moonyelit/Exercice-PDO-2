<?php
require_once './utils/connect_db.php';

$sql = "SELECT patients.id AS patient_id, patients.lastname, patients.firstname, patients.birthdate,
    appointments.id AS appointment_id, appointments.dateHour
FROM appointments
INNER JOIN patients ON appointments.idPatients = patients.id
ORDER BY appointments.dateHour ASC";


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
    <title>Base de données des rendez-vous</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">

</head>

<body>
    <ol>
        <h1>Liste des rendez-vous:</h1>
        <?php

        foreach ($users as $user) {
            $lastName = $user['lastname'];
            $firstName = $user['firstname'];
            $id = $user['patient_id'];
            $idAppointment = $user['appointment_id'];

            // Formater la date/heure au format français
            $appointmentDate = new DateTime($user['dateHour']);
            $appointmentDate->setTimezone(new DateTimeZone('Europe/Paris'));
            $appointment = $appointmentDate->format('d/m/Y H:i'); 
        ?>

            <li class="case">
                <p>

                    <br><strong>Nom : </strong><?= $lastName  ?>

                    <br><strong>Prénom : </strong> <?= $firstName ?>

                    <br><strong>ID : </strong> <?= $id  ?>

                    <br><strong>Date du rendez-vous : </strong> <?= $appointment ?>

                </p>
                <h2>Afficher plus d'informations : </h2>

                <a href="./profil-patient.php?id=<?php echo $user['patient_id'] ?>" class="btn">Voir le Profil</a>

                <a href="./rendezvous.php?id=<?php echo $user['appointment_id'] ?>" class="btn">Voir le rendez-vous</a>


            </li>


        <?php
    
    }

        ?>

    </ol>
    <a href="./ajout-rendezvous.php" class="btn">Ajouter un rendez-vous </a>

    <a href="./index.php" class="btn">Revenir à l'accueil</a>


</body>

</html>
?>