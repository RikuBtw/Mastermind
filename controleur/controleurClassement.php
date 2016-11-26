<?php
require_once __DIR__."/../vue/vueClassement.php";
require_once __DIR__."/../modele/modeleBD.php";

class ControleurClassement{

private $vueClassement;
private $modeleBD;

  function __construct(){
		$this->modeleBD = new modeleBD();
    $this->modeleBD->recuperation5Premiers();
    $this->vueClassement = new VueClassement($this->modeleBD->getListeClassement());
  }

  function demandeAfficheClassement(){
    $this->vueClassement->afficheClassement();
  }
}
?>
