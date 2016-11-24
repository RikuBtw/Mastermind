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


    if(!empty($_GET['circle'])&& isset($_SESSION['user_token'])){
      $this->ctrlJeu->demandeAjoutPion($_GET['circle']);
      $this->ctrlJeu->demandeAfficheJeu();
    }else
    if(!empty($_GET['backward'])&& isset($_SESSION['user_token'])){
      $this->ctrlJeu->demandeSupprimerPion();
      $this->ctrlJeu->demandeAfficheJeu();
    }else
    if(!empty($_GET['check'])&& isset($_SESSION['user_token'])){
      if($this->ctrlJeu->demandeVerification() == "gagne"){
        $this->ctrlClassement->demandeAfficheClassement();
      }else
      if($this->ctrlJeu->demandeVerification() == "perd"){
        $this->ctrlClassement->demandeAfficheClassement();
      }else{
        $this->ctrlJeu->demandeAfficheJeu();
      }
    }else
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      if($this->ctrlAuthentification->demandeVerificationPseudo($_POST['pseudo'], $_POST['password'])){
        if(empty($_SESSION['user_token'])){
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
