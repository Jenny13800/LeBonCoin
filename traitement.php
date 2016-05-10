

<?php

if (isset($_GET['logout'])) {
    unset($_SESSION);
    session_destroy();
    header('Location: index.php');
    exit();
}

//supprimer une annonce comme objet:
if (isset($_GET['delete_ann'])) {
    $oAnnonce = new Annonce;
    $oAnnonce->setId($_GET['delete_ann']);

    $oAnnManager->delete($oAnnonce);

    //rediriger vers l'index avec url index.php sans la phase suppr qui s'affiche dans l'url :
    header('Location: index.php');
    exit();
}

// se conntecter avec oUser
if (!isset($_SESSION['oUser'])) {
    $_SESSION['oUser'] = NULL;
    /* $_SESSION['bIsConnected'] = false;
      $_SESSION['$sEmailConnected'] = NULL; */
}
/* créer une varaible $oUser pour $_Session peermettant ainsi d'être appeler dans les autres docs
 * créer une instanceof permettant ainsi de corriger les erreurs
 * si c'est ? faux c'est NULL
 */
print_r($_SESSION);
$oUser = ($_SESSION['oUser'] instanceof User) ? $_SESSION['oUser'] : NULL;

if (isset($_POST['loginform'])) {
    $sEmailInput = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $sPasswordInput = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//Si données validées :

    if ($sEmailInput && $sPasswordInput) {

        $oUser = $oUsersManager->getByEmailAndPassword($sEmailInput, $sPasswordInput);
        if ($oUser instanceof User) {
            echo 'email/pwd ok';
            $_SESSION['oUser'] = $oUser;
            /* plus besoin de :
             * $_SESSION['$sEmailConnected'] = $sEmailInput;
             */
            print_r($_SESSION);
        } else
            echo 'email/pwd ko';
    }
}

//print_r($_SERVER);

if (isset($_POST['annonceForm']) && $_SESSION['oUser'] instanceof User) {
    // print_r($_FILES);

    $aAllowedTypes = array('image/png', 'image/gif', 'image/jpg', 'image/jpeg');

    $sTitle = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $sDescription = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $iPrice = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
    $sImage = false;

    //uploader un fichier

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK && in_array($_FILES['image']['type'], $aAllowedTypes)) {
        /* ce qui vaut :
         * $aImage 1 = $_FILES['image']
         * $iError=$aImage['error'] */

        $sImage = $_FILES['image']['tmp_name'];
    }

    //création d'une annonce

    $iIdUser = $_SESSION['oUser']->getId();

    if ($sTitle && $sDescription && $sImage && $iPrice && $iIdUser) {
        $oNewAnnonce1 = new Annonce;
        $oNewAnnonce1->setTitle($sTitle);
        $oNewAnnonce1->setDescription($sDescription);
        $oNewAnnonce1->setPrice($iPrice);
        $oNewAnnonce1->setCreatedDate(new DateTime('now'));
        $oNewAnnonce1->setIdUser($iIdUser);

        $oAnnManager->insert($oNewAnnonce1);
        print_r($oNewAnnonce1);

        //renommer le fichier img de l'utilisateur
        $sFileDest = 'img_ann' . $oNewAnnonce1->getId() . '_001.' . substr($_FILES['image']['name'], -3);

        //déplacer objet télécharger
        if (move_uploaded_file($sImage, 'userfiles/' . $sFileDest)) {
            $oNewAnnonce1->setPicture($sFileDest);
            $oAnnManager->update($oNewAnnonce1);
        }


        /* $oNewAnnonce1->save();
          print_r($oNewAnnonce1); */
    }
}

define('MESSAGE_OK', 'votre email est envoyé');
define('MESSAGE_ERR', 'veuillez remplir tous les champs s\'il vous plait');
if (isset($_POST['formContact'])) {
    $email = filter_input(INPUT_POST, 'formEmail', FILTER_VALIDATE_EMAIL);
    $name = filter_input(INPUT_POST, 'formName', FILTER_SANITIZE_STRING);
    $num = filter_input(INPUT_POST, 'formNum', FILTER_SANITIZE_STRING);
    $question = filter_input(INPUT_POST, 'formQuestion', FILTER_SANITIZE_STRING);

    if ($email && $name && $num && $question) {
        $oEnvoieEmail = new MessageContact($email, $name, $num, $question);
        $oEnvoieEmail->send();

        $sStatusEnvoiContact = MESSAGE_OK;
    } else {
        $sStatusEnvoiContact = MESSAGE_ERR;
    }
}
?>