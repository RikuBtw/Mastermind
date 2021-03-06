<?php
require_once __DIR__."/../vue/vueClassement.php";
require_once __DIR__."/../modele/modeleBD.php";

class ControleurClassement{

private $vueClassement;
private $modeleBD;

  function __construct(){
		$this->modeleBD = new modeleBD();
    $this->modeleBD->recuperation5Premiers();
    if(isset($_SESSION['user_token'])){
      $this->vueClassement = new VueClassement($this->modeleBD->getListeClassement(), $this->modeleBD->recupererMoyenneCoups(), $this->modeleBD->recupererMoyenneGagnee());
    }
  }

  function demandeAfficheClassement(){
    $this->vueClassement->afficheClassement();
  }

}
?>
