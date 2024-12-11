<?php
require_once '../utils/connect_db.php';


// var_dump($_POST);
// exit;


// Vérification que tous les champs sont remplis
if (empty($_POST['id']) || empty($_POST['dateHour'])) {
    echo "Tous les champs ne sont pas remplis !";
    echo "<br>";
    echo '<a href="../ajout-rendezvous.php" class="btn">Retour</a>';
    exit;
}

// Préparation de la requête SQL
$sql = "INSERT INTO appointments (idPatients, dateHour) 
        VALUES (:idPatients, :dateHour)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':idPatients' => $_POST['id'],       
        ':dateHour' => $_POST['dateHour']   
    ]);

    echo "Votre rendez-vous a été confirmé !";
    echo "<br>";
    echo 'Revenir à la page d\'accueil : <a href="../index.php" class="btn">Page d\'accueil</a>';

} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
}


// GESTION DE L'HEURE

// Récupérer la date sélectionnée depuis le formulaire
$dateHour = $_POST['dateHour'];
$selectedDate = new DateTime($dateHour);
$currentDate = new DateTime();

// Vérifier si la date est dans le passé
if ($selectedDate < $currentDate) {
    die('Vous ne pouvez pas prendre un rendez-vous dans le passé.');
}

// Vérifier les horaires (9h-18h)
$hour = (int)$selectedDate->format('H');
if ($hour < 9 || $hour >= 18) {
    die('Les rendez-vous sont possibles uniquement entre 9h et 18h.');
}

// Vérifier les week-ends
$day = (int)$selectedDate->format('N'); // 1 pour lundi, 7 pour dimanche
if ($day >= 6) {
    die('Les rendez-vous ne sont pas disponibles les week-ends.');
}

// Enregistrer le rendez-vous dans la base de données
echo "Rendez-vous valide, enregistrement en cours...";
