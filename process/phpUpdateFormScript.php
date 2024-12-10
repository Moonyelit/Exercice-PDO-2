<?php
require_once '../utils/connect_db.php';

if (
    empty($_POST['id']) || empty($_POST['lastName']) || empty($_POST['firstName']) || 
    empty($_POST['birthDate']) || empty($_POST['phone']) || empty($_POST['mail'])
) {
    echo "Tous les champs doivent être remplis.";
    exit;
}

$sql = "UPDATE patients 
        SET lastname = :lastName, 
            firstname = :firstName, 
            birthdate = :birthDate, 
            phone = :phone, 
            mail = :mail 
        WHERE id = :id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $_POST['id'],
        ':lastName' => $_POST['lastName'],
        ':firstName' => $_POST['firstName'],
        ':birthDate' => $_POST['birthDate'],
        ':phone' => $_POST['phone'],
        ':mail' => $_POST['mail']
    ]);

    echo "Les informations du patient ont été mises à jour avec succès.";
    echo '<a href="../liste-patients.php">Retour à la liste des patients</a>';
} catch (PDOException $error) {
    echo "Erreur lors de la mise à jour : " . $error->getMessage();
}
