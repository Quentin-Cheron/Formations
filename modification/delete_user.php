<?php
$title = "Delete user";
include_once "../includes/header.php";
?>

<?php
try {
    include_once "../includes/pdo.php";
    //Get all elements in database than i need
    $sql = "SELECT * FROM stagiaire JOIN nationalite ON stagiaire.ID_NATIONALITE = nationalite.ID_NATIONALITE JOIN type_formation ON stagiaire.ID_TYPE_FORMATION = type_formation.ID_TYPE_FORMATION";
    $resultat = $base->prepare($sql);
    $resultat->execute();
    $sql2 = "SELECT NOM_FORMATEUR, ID_SALLE, DATE_DEBUT, DATE_FIN FROM formateur JOIN stagiaire_formateur ON formateur.ID_FORMATEUR = stagiaire_formateur.ID_FORMATEUR WHERE ID_STAGIAIRE = :ID_STAGIAIRE";
    $resultat2 = $base->prepare($sql2);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>

<form action="../verification/verif_delete_user.php" method="POST" class="mb-2">
    <table class="w-100">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nationalité</th>
                <th>Type de formation</th>
                <th>Formateur - Salle - Date début - Date fin</th>
                <th>Supression</th>
            </tr>
        </thead>
        <tbody>
            <!-- Show all selected element in database -->
            <?php while ($ligne = $resultat->fetch()) { ?>
                <tr>
                    <td><?= $ligne["NOM_STAGIAIRE"] ?></td>
                    <td><?= $ligne["PRENOM_STAGIAIRE"] ?></td>
                    <td><?= $ligne["LIBELLE_NATIONALITE"] ?></td>
                    <td><?= $ligne["LIBELLE_FORMATION"] ?></td>
                    <td class="d-flex flex-column border">
                        <?php $resultat2->execute(array("ID_STAGIAIRE" => $ligne["ID_STAGIAIRE"])); ?>
                        <!-- Show Element in same place to not get same people -->
                        <?php while ($ligne2 = $resultat2->fetch()) { ?>
                            <span class="<?= $ligne["ID_STAGIAIRE"] ?>"><?= $ligne2["NOM_FORMATEUR"] ?> - <?= $ligne2["ID_SALLE"] ?> - <?= $ligne2["DATE_DEBUT"] ?> - <?= $ligne2["DATE_FIN"] ?></span>
                        <?php  } ?>
                    </td>
                    <td><input type="checkbox" name="delete[]" value="<?= $ligne["ID_STAGIAIRE"] ?>"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <input type="submit" value="Suprimer" class="btn btn-primary mt-2">
</form>
<a href="../index.php">Ajouter une stagiaire</a>