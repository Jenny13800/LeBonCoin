<?php
$mesAnnonces = $oAnnManager->getList();

for ($i = 1; $i <= 3; $i++) {
    $numAnn = array_rand($mesAnnonces);
    $annoncesAside[] = $mesAnnonces[$numAnn];
    unset($mesAnnonces[$numAnn]);
}
?>

<form id="searchForm">
    <!--Formulaires : 2 select!-->
    <div id="form1">
        <select id="categorie">
            <option value="categorie">Catégories</option>
            <option value="vehicules">Véhicules</option>
        </select>
        <!--2e formulaire!-->
        <select id="region">
            <option value="region">Régions</option>
            <option value="Paca">PACA</option>
        </select>
        <!--Créer une datalist!-->
        <input list="villes">
        <datalist id="villes">
            <option value="Istres">
            <option value="Marseille">
        </datalist>
    </div>
    <!--Créer un input!-->
    <div id ="form2">
        <input id="saisie" type="text" placeholder="Saisie Libre"/>
        <!--Créer un bouton!-->
        <input id="bouton" type="submit"/>
    </div>
</form>
<aside>
    <section id="annonce">
        <h3 class="une">Annonces à la Une</h3>
        <?php
        foreach ($annoncesAside as $annoncesUne) {
            echo '<article class="laune">';
            echo '<img src ="userfiles/' . $annoncesUne->getPicture() . '"/>';
            echo '<div>';
            echo '<h3 class="annoncesune">' . $annoncesUne->getId() . ' ' . $annoncesUne->getTitle() . '</h3>';
            // echo '<p class="lieu">' . $annoncesUne->getLocation() . '</p>';
            echo '<p class="prix">' . $annoncesUne->getPrice() . '</p>';
            echo '<p class="date">' . $annoncesUne->getCreatedDate() . '</p>';
            echo '<p class="description">' . $annoncesUne->getDescription() . '</p>';
            echo '</div>';
            echo '</article class="laune">';
        }
        ?>
    </section>
</aside>
<section id="general">
    <h3 class="titre">Annonces</h3>
    <?php
    foreach ($mesAnnonces as $annonce) {
        echo '<article>';
        echo '<a href="index.php?page=detail_annonce&id=' . $annonce->getId() . '">';
        echo '<img src="userfiles/' . $annonce->getPicture() . '" />';
        echo '<div>';
        echo '<h3 class="general">' . $annonce->getTitle() . '</h3>';
        // echo '<p class="lieu">' . $annonce->getLocation() . '</p>';
        echo '<p class="prix">' . $annonce->getPrice() . '</h3>';
        echo '<p class="date">' . $annonce->getCreatedDate() . '</p>';
        echo '<p class="description">' . substr($annonce->getDescription(), 0, 75) . '</p>';
        echo '</div>';
        echo '</a>';
        echo '</article>';
    }
    ?>
</section>