<img class="logo" src="env/images/boncoin.png" alt="logo"/>
<nav>
    <span id="icon-menu-mob" class="fa fa-bars"></span>
    <ul>
        <li><a href="index.php?page=home">ACCUEIL</a></li>
        <li><a href="index.php?page=depot_annonce">DEPOSER UNE ANNONCE</a></li>
        <li>OFFRES</li>
        <li>DEMANDES</li>
        <li>MES ANNONCES</li>
        <li>BOUTIQUES</li>
        <li><a href="index.php?page=contact">CONTACT</a></li>

    </ul>
    <div class="connexion">
        <!--instanceof a rajouté permet d'éviter les erreurs dans PHP-->
        <?php if ($oUser instanceof User) { ?>
            <!--Utilisation de la variable $oUser de $_Session : permet de mettre un get sur la variable car $_Session ['oUser'] est un tableau, donc ne peut recevoir un get-->
            <span>Connecté sous <?php echo $oUser->getEmail(); ?></span><br />
            <a href="index.php?logout">Se déconnecter</a>
        <?php } else { ?>
            <form id="connexion" method="POST">
                <input class= "header" type="email" name ="email" required/>
                <input class= "header" type="password" name="password" required/>
                <input class="button" type="submit" name="loginform" value="Se connecter"/>
            </form>
            <button id="homeAjax">homeAjax</button>
            <button id="contactAjax">contactAjax</button>
        <?php } ?>

    </div>
</nav>
