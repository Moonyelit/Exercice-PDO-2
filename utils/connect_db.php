<?php
try {
     $host = "localhost";
     $dbname = "patients";
     $login = "root";
     $password = "";

     $dsn = 'mysql:host=localhost;dbname=pdo_test';

     $db = new PDO("mysql:host={$host};dbname={$dbname}",$login,$password);
} catch (PDOException $error) {
     echo "Erreur de connexion : " . $error->getMessage();
}
