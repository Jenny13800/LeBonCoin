<?php

$oAnnonce = false;
if (isset($_GET ['id'])) {
    //(fct statique de Annonce): $oAnnonce = Annonce::getById($_GET['id']);
    $oAnnonce = $oAnnManager->get($_GET['id']);
}



if ($oAnnonce) {
    echo '<article id="new">';
    echo '<img src="userfiles/' . $oAnnonce->getPicture() . '" />';
    echo '<div id="texte">';
    echo '<h3 class="general">' . $oAnnonce->getTitle() . '</h3>';
    // echo '<p class="lieu">' . $oAnnonce->getLocation() . '</p>';
    echo '<p class="prix">' . $oAnnonce->getPrice() . '</h3>';
    // echo '<p class="date">' . $oAnnonce->getDate() . '</p>';
    echo '<p class="description">' . $oAnnonce->getDescription() . '</p>';
    //ce qui vaut a delete_ann&id=8
    echo '<a id="suppr" href="index.php?delete_ann=' . $oAnnonce->getId() . '">Supprimer cette annonce</a>';
    echo '</div>';
    echo '</article>';
} else {
    echo 'pas bon';
}
?>