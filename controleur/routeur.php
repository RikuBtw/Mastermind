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
      if(isset($_POST["logout"])){
        session_abort();
        $this->ctrlAuthentification->accueil();
      }
      if($this->ctrlAuthentification->verificationPseudo($_POST['pseudo'], $_POST['password'])){
        if(empty($_SESSION['username'])){
          $this->ctrlAuthentification->accueil();
        }else{
          $this->ctrlAuthentification->afficheJeu();
        }
      }else{
        $this->ctrlAuthentification->afficheErreur();
      }
    }else{
      $this->ctrlAuthentification->accueil();
    }

  }


}




?>
