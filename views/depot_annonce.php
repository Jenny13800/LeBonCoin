<?php if ($_SESSION['oUser'] instanceof User) { ?>

    <form id="depot" method="POST" enctype="multipart/form-data">


        <label for="Titre">Titre</label>
        <input id= "Titre" type="text" placeholder="Titre annonce" name="title" required/>

        <label for="description">Description</label>
        <textarea id= "description" placeholder="Description" name="description" required></textarea>

        <label for="prix">Prix</label>
        <input id= "prix" type="text" placeholder="Prix" name="price"required/>

        <label for="image">Fichier</label>
        <input id ="image" type="file" name="image" required />

        <input id="boutonForm" type="submit" name="annonceForm" value="Créer"/>

    </form>

    <?php
} else {
    echo 'Veuillez-vous connecter pour accéder au service';
}
?>

