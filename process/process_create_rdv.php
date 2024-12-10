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
