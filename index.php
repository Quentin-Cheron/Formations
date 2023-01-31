<?php
$title = "Accueil";
include_once "includes/header.php";
?>

<?php
try {
    //Get all element than i need
    $base = new PDO('mysql:host=127.0.0.1;dbname=projet_php_2022', 'root', '');
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT LIBELLE_FORMATION, ID_TYPE_FORMATION FROM type_formation";
    $resultat = $base->prepare($sql);
    $resultat->execute();

    $sql2 = "SELECT NOM_FORMATEUR, PRENOM_FORMATEUR, ID_SALLE, ID_FORMATEUR, ID_TYPE_FORMATEUR FROM formateur JOIN type_formation_formateur ON formateur.ID_FORMATEUR = type_formation_formateur.FOR_ID_FORMATEUR";
    $resultat2 = $base->prepare($sql2);
    $resultat2->execute();

    $sql3 = "SELECT NOM_FORMATEUR, PRENOM_FORMATEUR, ID_SALLE FROM formateur";
    $resultat3 = $base->prepare($sql3);
    $resultat3->execute();

    $sql4 = "SELECT LIBELLE_NATIONALITE, ID_NATIONALITE FROM nationalite";
    $resultat4 = $base->prepare($sql4);
    $resultat4->execute();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>

<form action="verification/verif_index.php" method="POST">
    <div class="mb-3">
        <label for="lastName" class="mb-2 text-capitalize">nom:</label>
        <input type="text" name="name" class="form-control">
        <!-- Check if the input is valid --> 
        <?php if (isset($_GET["validation"]) || isset($_GET["name_firstName"]) || isset($_GET["name_check"]) || isset($_GET["name"])) { ?>
            <!-- if the input is not valid so show error -->
            <p class="text-danger">Remplisser cette case</p>
        <?php } ?>
    </div>
    <div class="mb-3">
        <label for="firstName" class="mb-2 text-capitalize">prénom:</label>
        <input type="text" name="firstName" class="form-control">
        <!-- Check if the input is valid --> 
        <?php if (isset($_GET["validation"]) || isset($_GET["name_firstName"]) || isset($_GET["firstName_check"]) || isset($_GET["firstName"])) { ?>
            <!-- if the input is not valid so show error -->
            <p class="text-danger">Remplisser cette case</p>
        <?php } ?>
    </div>
    <div class="mb-3">
        <label for="nationalite" class="mb-2 text-capitalize">nationalité:</label>
        <select id="nationalite" name="nationalite" class="form-control">
            <?php while ($ligne = $resultat4->fetch()) { ?>
                <option value="<?= $ligne["ID_NATIONALITE"] ?>"><?= $ligne["LIBELLE_NATIONALITE"] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="formationType" class="mb-2 text-capitalize">type de formation:</label>
        <select name="formationType" class="select form-control">
            <?php while ($ligne = $resultat->fetch()) { ?>
                <option value="<?= $ligne["ID_TYPE_FORMATION"] ?>" name="formation"><?= $ligne["LIBELLE_FORMATION"] ?></option>
            <?php } ?>
        </select>
    </div>
    <div>
        <p class="m-0 text-capitalize">formateur par date:</p>
        <?php while ($ligne = $resultat2->fetch()) { ?>
            <div class="form-check d-flex align-items-center">
                <div class="d-flex" style="width: 40vw;">
                    <input type="checkbox" name="check[]" class="checkDate <?= $ligne["ID_TYPE_FORMATEUR"] ?> form-check-input me-2" id="flexCheckDefault" value="<?= $ligne["ID_FORMATEUR"] ?>">
                    <label class="form-check-label" for="flexCheckDefault"></label>
                    <p class="m-0"><?= $ligne["PRENOM_FORMATEUR"] ?> <?= $ligne["NOM_FORMATEUR"] ?> dans la salle <?= $ligne["ID_SALLE"] ?></p>
                </div>
                <div class="row justify-content-center flex-nowrap" style="width: 35%;">
                    <div class="col-lg-12 col-sm-6">
                        <label for="startDate">Début</label>
                        <input id="startDate" class="form-control startDate" type="date" name="start_<?= $ligne["ID_FORMATEUR"] ?>" />
                        <span id="startDateSelected"></span>
                    </div>
                    <div class="col-lg-12 col-sm-6">
                        <label for="endDate">Fin</label>
                        <input id="endDate" class="form-control endDate" type="date" name="end_<?= $ligne["ID_FORMATEUR"] ?>" />
                        <span id="endDateSelected"></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- Check if the date is conform --> 
    <?php if (isset($_GET["validation"]) || isset($_GET["name_check"]) || isset($_GET["firstName_check"]) || isset($_GET["check"])) { ?>
        <!-- if the input is not valid so show error -->
        <p class="text-danger">Vous devez cocher au moin une case</p>
    <?php }
    //Check if the date is conform
    if (isset($_GET["date"])) { ?>
    <!-- if the date is not valid so show error -->
        <p class="text-danger">Veuillez rentrer une date valide</p>
    <?php } ?>
    <input type="submit" value="Envoyer" class="btn btn-primary">
</form>
<div class="d-flex mt-3">
    <a href="modification/delete_user.php" class="me-3">Supression d'un stagiaire</a>
</div>
<script src="js/script.js"></script>
</body>

</html>