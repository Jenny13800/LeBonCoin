<?php
include_once ('class/class_annonce.php');
include_once ('class/class_user.php');
include_once ('class/class_message_contact.php');
include_once ('class/class_annonce_manager.php');
include_once ('class/class_users_manager.php');
session_start();

include_once('functions.php');
$oPDO = connectDB();
$oAnnManager = new AnnonceManager($oPDO);
$oUsersManager = new UsersManager($oPDO);

include_once('traitement.php');
//include_once('data.php');

logIP();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width"/>
        <title>Le Bon Coin</title>
        <link rel="stylesheet" type="text/css" href="env/css/global.css"/>
        <link rel="stylesheet" type="text/css" href="env/css/font-awesome.css"/>

    </head>
    <body>
        <!--En-tête!-->
        <header>
            <?php include('header.php'); ?>
        </header>

        <div id="include">
            <?php
            $page = NULL;
            if (isset($_GET['page'])) {
                $page = 'views/' . $_GET['page'] . '.php';
            }

            if (!file_exists($page)) {
                $page = 'views/home.php';
            }

            include ($page);
            ?>
        </div>

        <footer>
            <?php include('footer.php'); ?>
        </footer>
    </body>

</html>

<?php //closeDB(); ?>

