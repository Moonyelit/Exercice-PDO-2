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
        <input type="text" name="lastName" id="lastName" required>

        <label for="prenom">Prenom : </label>
        <input type="text" name="firstName" id="firstName" required>

        <label for="naissance">Date de naissance : </label>
        <input type="date" name="birthDate" id="birthDate"  placeholder="DD/MM/YYYY"  required>

        <label for="phone">Téléphone : </label>
        <input type="tel" name="phone" id="phone" required>

        <label for="mail">Mail : </label>
        <input type="email" name="mail" id="mail" required>





        <input type="submit" value="Creer utilisateur">
    </form>
</body>


</html>