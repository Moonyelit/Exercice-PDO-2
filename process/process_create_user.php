<?php

require_once '../utils/connect_db.php';

if (
    empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['birthdate']) ||
    empty($_POST['phone']) || empty($_POST['mail'])
) {
    echo "Tous les champs ne sont pas remplis !";
    echo "<br>";
    echo '<a href="../ajout_patient.php" class="btn">Formulaire</a>';
    exit;

}





$sql = "INSERT INTO patients (lastname, firstname, birthdate, phone, mail)
 VALUES (:lastname, :firstname , :birthdate, :phone, :mail)";

try {
    $stmt = $pdo->prepare($sql);
    $users = $stmt->execute([
        ':lastname' => $_POST["lastname"],
        ':firstname' => $_POST["firstname"],
        ':birthdate' => $_POST["birthdate"],
        ':phone' => $_POST["phone"],
        ':mail' => $_POST["mail"]
    ]);
     // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

echo "Félicitation vous avez tout remplis !";
echo "<br>";
echo ' Revenir à la page d\'accueil :<a href="../index.php" class="btn">Page d\'accueil</a>';


} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}
