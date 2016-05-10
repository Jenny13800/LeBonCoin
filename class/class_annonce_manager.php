<?php

class AnnonceManager {

    private $oDB;

//construction de la $oDB => utiliser $this->oDB comme fct persistante dans les autres fct.

    public function __construct(PDO $oDB) {
        $this->oDB = $oDB;
    }

    public function getList() {

        $oQuery = $this->oDB->query('SELECT * FROM annonces');

        $aList = array();
        while ($aData = $oQuery->fetch(PDO::FETCH_ASSOC)) {
            $aList[] = new Annonce($aData);
        }

        return $aList;

        /* mysql :
          $oData = mysql_query('SELECT * FROM annonces');

          $aList = array();
          while ($aLine = mysql_fetch_array($oData)) {
          $oAnnonce = new Annonce($aLine);
          $aList[] = $oAnnonce;
          }

          return $aList; */
    }

    public function get($id) {

        $oQuery = $this->oDB->query('SELECT * FROM annonces WHERE id=' . $id);

        $aLine = $oQuery->fetch(PDO::FETCH_ASSOC);

        /* Mysql :
          $oData = mysql_query('SELECT * FROM annonces WHERE id=' . $id);

          $aLine = mysql_fetch_array($oData); */
        $oAnnonce = new Annonce($aLine);

        return $oAnnonce;
    }

    public function insert(Annonce & $oAnnonce) {

        $oQuery = $this->oDB->prepare('INSERT INTO annonces (id_user, `title`, `description`, `picture`, `price`, `created_date`)
        VALUES (:id_user, :title, :description, :picture, :price, :created_date)');

        $oQuery->bindValue(':id_user', $oAnnonce->getIdUser(), PDO::PARAM_INT);
        $oQuery->bindValue(':title', $oAnnonce->getTitle(), PDO::PARAM_STR);
        $oQuery->bindValue(':description', $oAnnonce->getDescription(), PDO::PARAM_STR);
        $oQuery->bindValue(':picture', $oAnnonce->getPicture(), PDO::PARAM_STR);
        $oQuery->bindValue(':price', $oAnnonce->getPrice(), PDO::PARAM_INT);
        $oQuery->bindValue(':created_date', $oAnnonce->getCreatedDate()->format('Y-m-d H:i:s'), PDO::PARAM_INT);

        if ($oQuery->execute()) {
            $oAnnonce->setID($this->oDB->lastInsertID());
            return true;
        } else {
            return false;
        }
    }

    /* Mysql :
      $sTitle = mysql_escape_string($oAnnonce->getTitle());

      $sDescription = mysql_escape_string($oAnnonce->getDescription());
      $sPicture = mysql_escape_string($oAnnonce->getPicture());
      $sPrice = $oAnnonce->getPrice();
      $sCreatedDate = $oAnnonce->getCreatedDate()->format('Y-m-d H:i:s');

      $sQuery = ''
      . ' INSERT INTO annonces(`title`, `description`, `picture`, `price`, `created_date`) VALUES ( '
      . ' "' . $sTitle . '" ,'
      . ' "' . $sDescription . '" , '
      . ' "' . $sPicture . '" ,'
      . ' "' . $sPrice . '" ,'
      . ' "' . $sCreatedDate . '")';
      print_r($sQuery);
      $oData = mysql_query($sQuery);
      print_r(mysql_error());

      if ($oData) {
      $oAnnonce->setId(mysql_insert_id());
      return true;
      }

      return false;
      } */

    public function update(Annonce $oAnnonce) {

        $oQuery = $this->oDB->prepare('UPDATE annonces '
                . 'SET '
                . 'title = :title,'
                . 'description = :description,'
                . 'picture = :picture,'
                . 'price = :price '
                . 'WHERE id= :id');

        $oQuery->bindValue(':title', $oAnnonce->getTitle(), PDO::PARAM_STR);
        $oQuery->bindValue(':description', $oAnnonce->getDescription(), PDO::PARAM_STR);
        $oQuery->bindValue(':picture', $oAnnonce->getPicture(), PDO::PARAM_STR);
        $oQuery->bindValue(':price', $oAnnonce->getPrice(), PDO::PARAM_INT);
        $oQuery->bindValue(':id', $oAnnonce->getId(), PDO::PARAM_INT);

        if ($oQuery->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /* Mysql :
      $sTitle = mysql_escape_string($oAnnonce->getTitle());
      $sDescription = mysql_escape_string($oAnnonce->getDescription());
      $sPicture = mysql_escape_string($oAnnonce->getPicture());
      $sPrice = $oAnnonce->getPrice();


      $oData = mysql_query('UPDATE annonces SET '
      . ' title = "' . $sTitle . '" ,'
      . ' description = "' . $sDescription . '" ,'
      . ' picture = "' . $sPicture . '" ,'
      . ' price = ' . $sPrice
      . ' WHERE id=' . $oAnnonce->getId());

      if ($oData) {
      return true;
      }

      return false;
      }

     */

    public function delete(Annonce $oAnnonce) {

        $oQuery = $this->oDB->prepare('DELETE FROM annonces WHERE id = :id');
        $oQuery->bindValue(':id', $oAnnonce->getId(), PDO::PARAM_INT);

        if ($oQuery->execute()) {
            return true;
        } else {
            return false;
        }
        /* Mysql :
          $oData = mysql_query('DELETE FROM annonces WHERE id=' . $oAnnonce->getId());
          if ($oData) {
          return true;
          }
          return false;
          } */
    }

}
?>




