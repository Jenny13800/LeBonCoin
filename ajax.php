<?php

session_start();
include_once ('class/class_annonce.php');
include_once ('class/AnnonceManager.php');
include_once ('class/class_annonce_manager.php');
include_once ('class/class_users_manager.php');
//include_once('data.php');
include_once('functions.php');
include_once('traitement.php');

//print_r($_GET);
//print_r($_POST);

/* if (isset($_POST['action'])  && $_POST['action'] == 'contact'){
  include ('views/contact.php');
  };
  if (isset($_POST['action'])  && $_POST['action'] == 'home'){
  include ('views/home.php');
  }; */

$page = NULL;
if (isset($_GET['page'])) {
    $page = 'views/' . $_GET['page'] . '.php';
}

if (!file_exists($page)) {
    $page = 'views/home.php';
}

include ($page);
?>