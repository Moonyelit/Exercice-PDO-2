<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire ajout patient</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h1> Formulaire ajout patient </h1>
    <form action="./process/process_create_user.php" method="post">

        <label for="nom">Nom : </label>
        <input type="text" name="lastname" id="lastname">

        <label for="prenom">Prenom : </label>
        <input type="text" name="firstname" id="firstname">

        <label for="prenom">Date de naissance : </label>
        <input type="text" name="birthdate" id="birthdate">

        <label for="prenom">Téléphone : </label>
        <input type="text" name="phone" id="phone">

        <label for="prenom">Mail : </label>
        <input type="text" name="mail" id="mail">





        <input type="submit" value="Creer utilisateur">
    </form>
</body>

</html>