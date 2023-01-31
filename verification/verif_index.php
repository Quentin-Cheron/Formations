<?php
try {
    include_once "../includes/pdo.php";
    $uniq = uniqid();
    //Get all element than i need
    $sql = "INSERT INTO stagiaire (ID_STAGIAIRE, NOM_STAGIAIRE, PRENOM_STAGIAIRE, ID_NATIONALITE, ID_TYPE_FORMATION) VALUES (:ID_STAGIAIRE, :NOM_STAGIAIRE, :PRENOM_STAGIAIRE, :ID_NATIONALITE, :ID_TYPE_FORMATION)";
    $resultat = $base->prepare($sql);
    //These condition is here for check if all input is not empty and than the checkboxs is check
    if (empty($_POST["name"]) && empty($_POST["firstName"]) && !isset($_POST["check"])) {
        header("Location: ../index.php?validation=error");
    } else if (empty($_POST["name"]) && empty($_POST["firstName"])) {
        header("Location: ../index.php?name_firstName=error");
    } else if (empty($_POST["name"]) && empty($_POST["check"])) {
        header("Location: ../index.php?name_check=error");
    } else if (empty($_POST["firstName"]) && empty($_POST["check"])) {
        header("Location: ../index.php?firstName_check=error");
    } else if (empty($_POST["firstName"])) {
        header("Location: ../index.php?firstName=error");
    } else if (empty($_POST["name"])) {
        header("Location: ../index.php?name=error");
    } else if (empty($_POST["check"])) {
        header("Location: ../index.php?check=error");
    } else 
    //Check if all input, select and the checkbox is valid
    if (!empty($_POST["name"]) && !empty($_POST["formationType"]) && !empty($_POST["firstName"]) && !empty($_POST["nationalite"]) && isset($_POST["check"])) {
        $sql3 = "INSERT INTO stagiaire_formateur (ID_STAGIAIRE, ID_FORMATEUR, DATE_DEBUT, DATE_FIN) VALUES (:ID_STAGIAIRE, :ID_FORMATEUR, :DATE_DEBUT, :DATE_FIN)";
        $resultat3 = $base->prepare($sql3);
    //This condition check if the date is conform and than the date entered is good
        foreach ($_POST["check"] as $el) {
            if (((date("Y-m-d") < $_POST["start_" . $el]) && (date("Y-m-d") < $_POST["end_" . $el])) && $_POST["start_" . $el] < $_POST["end_" . $el]) {
                //If the entered date is good so send this to database
                $resultat->execute(array("ID_STAGIAIRE" => $uniq, "NOM_STAGIAIRE" => htmlentities($_POST["name"]), "PRENOM_STAGIAIRE" => htmlentities($_POST["firstName"]), "ID_NATIONALITE" => $_POST["nationalite"], "ID_TYPE_FORMATION" => $_POST["formationType"]));
                $resultat3->execute(array("ID_STAGIAIRE" => $uniq, "ID_FORMATEUR" => $el, "DATE_DEBUT" => $_POST["start_" . $el], "DATE_FIN" => $_POST["end_" . $el]));
                header("Location: ../index.php");
            } else {
                header("Location: ../index.php?date=error");
            }
        }
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
