<?php

$host = 'localhost';
$db_name = 'devis'; // Nom de la base de données
$username = 'root';
$password = '';

// Création de la connexion
$conn = new mysqli($host, $username, $password, $db_name);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
echo "Connexion réussie à la base de données !";

// N'oubliez pas de fermer la connexion à la fin
$conn->close();
?>