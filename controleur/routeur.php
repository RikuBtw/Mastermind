<?php
require_once 'controleurAuthentification.php';
require_once 'controleurJeu.php';
require_once 'controleurErreur.php';
require_once 'controleurClassement.php';

class Routeur {

  private $ctrlAuthentification;



  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->ctrlJeu= new ControleurJeu();
    $this->ctrlErreur= new ControleurErreur();
    $this->ctrlClassement= new ControleurClassement();
  }


  // Traite une requête entrante
	public function routerRequete() {


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      if(isset($_POST["logout"])){
        session_abort();
        $this->ctrlAuthentification->demandeAfficheAuthentification();
      }
      if($this->ctrlAuthentification->verificationPseudo($_POST['pseudo'], $_POST['password'])){
        if(empty($_SESSION['username'])){
          $this->ctrlAuthentification->demandeAfficheAuthentification();
        }else{
          $this->ctrlJeu->demandeAfficheJeu();
        }
      }else{
        $this->ctrlErreur->demandeAfficheErreur();
      }
    }else{
      $this->ctrlAuthentification->demandeAfficheAuthentification();
    }

  }


}




?>
