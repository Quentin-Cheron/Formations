<?php
try {
    //This request is here for delete line of the database to not to see this line anymore
    include_once "../includes/pdo.php";
    $sql = "DELETE FROM stagiaire_formateur WHERE ID_STAGIAIRE = :ID_STAGIAIRE";
    $resultat = $base->prepare($sql);
    foreach ($_POST["delete"] as $el) {
        $resultat->execute(array("ID_STAGIAIRE" => $el));
    }

    $sql2 = "DELETE FROM stagiaire WHERE ID_STAGIAIRE = :ID_STAGIAIRE";
    $resultat2 = $base->prepare($sql2);
    foreach ($_POST["delete"] as $el) {
        $resultat2->execute(array("ID_STAGIAIRE" => $el));
    }
    header("Location: ../modification/delete_user.php");
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
