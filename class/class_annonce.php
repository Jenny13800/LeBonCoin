<?php

class Annonce {

    protected $id;
    protected $id_user;
    protected $title;
    protected $description;
    protected $picture;
    protected $price;
    protected $created_date;

    public function __construct($aData = array()) {
        if ($aData) {
            $this->hydrate($aData);
        }
    }

    public function hydrate($aData) {
        foreach (array_keys(get_class_vars(get_class($this))) as $sKey) {
            if (isset($aData[$sKey])) {
                $this->$sKey = $aData[$sKey];
            }
        }
    }

    /* public static function load() {
      $aList = array();

      foreach (glob('data/annonce*') as $sFilepath) {
      $aList[] = unserialize(file_get_contents($sFilepath));
      }

      Annonce::$NB_ANNONCES = count($aList);

      return $aList;
      } */

// 1. Créer fct getById basée sur l'ident de chaque article : charger le fichier (1ligne) / verifier s'il existe(2ligne) / retourne l'objet (unserialize)(3ligne)
    /* public static function getById($id) {
      $sFilename = 'annonce' . str_pad($id, 3, '0', STR_PAD_LEFT);
      if (file_exists('data/' . $sFilename)) {
      return unserialize(file_get_contents('data/' . $sFilename));
      }
      }

      public function save() {
      $sFilename = 'annonce' . str_pad($this->getId(), 3, '0', STR_PAD_LEFT);
      file_put_contents('data/' . $sFilename, serialize($this));
      } */

    public function getId() {
        return $this->id;
    }

    public function setId($iNewId) {
        $this->id = $iNewId;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function setIdUser($iNewId) {
        $this->id_user = $iNewId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($sNewTitle) {
        $this->title = $sNewTitle;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($sNewDescription) {
        $this->description = $sNewDescription;
    }

    public function getPicture() {
        return $this->picture;
    }

    public function setPicture($sNewImage) {
        $this->picture = $sNewImage;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($iNewPrice) {
        $this->price = $iNewPrice;
    }

    public function getCreatedDate() {
        return $this->created_date;
    }

    public function setCreatedDate($oNewDate) {
        $this->created_date = $oNewDate;
    }

}

?>