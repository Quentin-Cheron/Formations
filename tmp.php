<?php
//Ce fichier sert à envoyer des données à la base de donnée temporairement exemple pour ajouter des types de formations
try {
    $base = new PDO('mysql:host=127.0.0.1;dbname=projet_php_2022', 'root', '');
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql2 = "INSERT INTO nationalite (ID_NATIONALITE) VALUES (:ID_NATIONALITE)";
    $resultat2 = $base->prepare($sql2);
    $resultat2->execute(array("ID_NATIONALITE" => uniqid()));
    $resultat2->closeCursor();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
