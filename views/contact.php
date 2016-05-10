<section>
    <article>
        <p id="contacter">Nous contacter :</p>
    </article>
    <form method="POST">
        <!--Créer un input!-->
        <div>
            <label for="nom">Nom Prénom :</label>
            <input id="nom" type="text" name="formName" required/>
        </div>
        <div>
            <label for="email">Adresse email :</label>
            <input id="email" type="text" name="formEmail" required/>
        </div>
        <div>
            <label for="numero">Numéro de téléphone :</label>
            <input id="numero" type="text" name="formNum" required/>
        </div>
        <div>
            <label form="question">Posez votre question :</label>
            <input id="question" type="text" name="formQuestion"/>
        </div>
        <!--Créer un bouton!-->
        <div>
            <input type="submit" name="formContact"/>
        </div>
    </form>
    <!--Fin formulaire!-->
    <article>
        <p id="texte">Une réponse vous sera adressée dans les 24heures.</p>
        <p id="tel">Contact téléphone : 04 43 36 98 78</P>
        <p><?php if (isset($sStatusEnvoiContact)) echo $sStatusEnvoiContact; ?></p>
</section>

