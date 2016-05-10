<?php

// conexion bdd :
function connectDB() {

    $aOptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"');
    $oPDO = new PDO('mysql:host=127.0.0.1;dbname=LeBonCoin;charset=UTF8', 'root', '', $aOptions);
    var_dump($oPDO);
    return $oPDO;

    /* mysql :
      $sServer = '127.0.0.1';

      $sUser = 'root';
      $sPwd = '';
      $sDatabase = 'LeBonCoin';


      $handle = mysql_connect($sServer, $sUser, $sPwd);
      //var_dump($handle);

      if (!$handle) {
      die('impossible de se connecter' . mysql_error());
      }

      mysql_select_db($sDatabase);
      mysql_set_charset('UTF-8');
      mysql_query('SET NAMES "utf8"'); */
}

/* function closeDB() {
  mysql_close();
  } */

function logIP() {

    $sDir = 'log/';
    $sDayFile = date('Y-m-d') . '.log';
    $sLine = date('Y-m-d H:i:s') . '#' . $_SERVER['REMOTE_ADDR'] . "\n";

    if (!file_exists($sDir)) {
        echo "le fichier dossier log n'existe pas";
        mkdir($sDir);
    }


// 2 solutions pour la date :

    file_put_contents($sDir . $sDayFile, $sLine, FILE_APPEND);

//2e solution (pour plusieurs lignes à écrire) :

    $oH = fopen($sDir . $sDayFile, 'a+');
    fwrite($oH, $sLine);
    fclose($oH);
}

?>