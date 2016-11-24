<?php
require_once 'controleurAuthentification.php';
require_once 'controleurJeu.php';
require_once 'controleurErreur.php';
require_once 'controleurClassement.php';

class Routeur {

  private $ctrlAuthentification;
  private $ctrlJeu;
  private $ctrlErreur;
  private $ctrlClassement;

  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->ctrlJeu= new ControleurJeu();
    $this->ctrlErreur= new ControleurErreur();
    $this->ctrlClassement= new ControleurClassement();
  }


  // Traite une requête entrante
	public function routerRequete() {

    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['username'])){
      if(!empty($_GET['circle'])){
        $this->ctrlJeu->demandeAjoutPion($_GET['circle']);
        $this->ctrlJeu->demandeAfficheJeu();
      }else
      if(!empty($_GET['backward'])){
        $this->ctrlJeu->demandeSupprimerPion();
        $this->ctrlJeu->demandeAfficheJeu();
      }else
      if(!empty($_GET['check'])){
        $this->ctrlJeu->demandeVerification();
        $this->ctrlJeu->demandeAfficheJeu();
      }
    }else
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
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
