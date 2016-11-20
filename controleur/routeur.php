<?php

require_once 'controleurAuthentification.php';


class Routeur {

  private $ctrlAuthentification;



  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
  }


  // Traite une requête entrante
	public function routerRequete() {

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      if($this->ctrlAuthentification->verificationPseudo($_POST['pseudo'], $_POST['password'])){
        setcookie("pseudo",$_POST['pseudo']);
        $this->ctrlAuthentification->afficheJeu();
      }else{
        $this->ctrlAuthentification->afficheErreur();
      }
    }else{
      $this->ctrlAuthentification->accueil();
    }
  }


}




?>
