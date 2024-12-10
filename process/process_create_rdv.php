<?php

require_once '../utils/connect_db.php';

if (
    empty($_POST['lastName']) || empty($_POST['firstName']) || empty($_POST['birthdate']) ||
    empty($_POST['consultation'])|| empty($_POST['daterdv'])
) {
    echo "Tous les champs ne sont pas remplis !";
    echo "<br>";
    echo '<a href="../ajout-rendezvous.php" class="btn">Retour</a>';
    exit;

}





$sql = "INSERT INTO appointments (lastName, firstName, birthdate, consultation, daterdv)
 VALUES (:lastName, :firstName , :birthdate, :consultation, daterdv)";

try {
    $stmt = $pdo->prepare($sql);
    $users = $stmt->execute([
        ':lastName' => $_POST["firstName"],
        ':firstname' => $_POST["firstname"],
        ':birthdate' => $_POST["birthdate"],
        ':consultation' => $_POST["consultation"],
        ':daterdv' => $_POST["daterdv"]


    ]);
     // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

echo "Votre rendez-vous à été confirmé !";
echo "<br>";
echo ' Revenir à la page d\'accueil :<a href="../index.php" class="btn">Page d\'accueil</a>';


} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


