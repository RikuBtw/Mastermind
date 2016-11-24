<?php
require_once __DIR__."/../vue/vueClassement.php";
require_once __DIR__."/../modele/modeleClassement.php";

class ControleurClassement{

private $vueClassement;
private $modeleClassement;

  function __construct(){
    if(isset($_SESSION['modeleClassement'])){
			$this->modeleClassement = $_SESSION['modeleClassement'];
		}else{
			$_SESSION['modeleClassement']=new modeleClassement();
			$this->modeleClassement = $_SESSION['modeleClassement'];
		}
    //$this->ModeleClassement->recuperation5Premiers();
    $this->vueClassement = new VueClassement($this->modeleClassement->getListeClassement());
  }

  function demandeAfficheClassement(){
    $this->vueClassement->afficheClassement($this->modeleClassement->getListeClassement());
  }
}
?>
