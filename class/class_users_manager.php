<?php

class UsersManager {

    private $oDB;

    public function __construct(PDO $oDB) {
        $this->oDB = $oDB;
    }

    public function get($id) {

        $oQuery = $this->oDB->prepare('SELECT * FROM users WHERE id = ?');
        $oQuery->bindValue(1, $Id, PDO::PARAM_INT);
        $oQuery->execute();

        $aData = $oQuery->fetch(PDO::FETCH_ASSOC);
        /* Mysql
          $oData = mysql_query('SELECT * FROM users WHERE id=' . $id);
          $aLine = mysql_fetch_array($oData); */

        /* Lignes 22-26 simplification :
          if ($aData) {
          $oUser = new User($aData);
          return $oUser;
          } */
        return new User($aData);
    }

    public function getByEmailAndPassword($email, $password) {

        $oQuery = $this->oDB->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        $oQuery->bindValue(':email', $email, PDO::PARAM_STR);
        $oQuery->bindValue(':password', $password, PDO::PARAM_STR);
        $oQuery->execute();

        $aData = $oQuery->fetch(PDO::FETCH_ASSOC);
        return new User($aData);

        /* $oData = mysql_query('SELECT * FROM users WHERE email="' . $email . '" AND password="' . $password . '"');
          $aLine = mysql_fetch_array($oData);
          if ($aLine) {
          $oUser = new User($aLine);
          return $oUser;
          } */
    }

}

?>