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


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      if(isset($_POST["backward"])){
        $this->ctrlJeu->demandeSupprimmerPion();
        $this->ctrlJeu->demandeAfficheJeu();
      }else

      if(isset($_POST["circle"])){
        $this->ctrlJeu->demandeAjoutPion($_POST["circle"]);
        $this->ctrlJeu->demandeAfficheJeu();
      }else

      if($this->ctrlAuthentification->verificationPseudo($_POST['pseudo'], $_POST['password'])){
        if(empty($_SESSION['username'])){
          $this->ctrlAuthentification->demandeAfficheAuthentification();
        }else{
          //$this->ctrlJeu->initialize();
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
