<?php
require_once 'controleurAuthentification.php';
require_once 'controleurJeu.php';
require_once 'controleurErreur.php';
require_once 'controleurClassement.php';
require_once 'controleurInscription.php';

class Routeur {

  private $ctrlAuthentification;
  private $ctrlJeu;
  private $ctrlErreur;
  private $ctrlClassement;
  private $ctrlInscription;

  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->ctrlJeu= new ControleurJeu();
    $this->ctrlErreur= new ControleurErreur();
    $this->ctrlClassement= new ControleurClassement();
    $this->ctrlInscription= new ControleurInscription();
  }


  // Traite une requête entrante
	public function routerRequete() {

    if(!empty($_POST['check'])&& isset($_SESSION['user_token'])){

      $tempVerification = $this->ctrlJeu->demandeVerification();
      if($tempVerification == "gagne"){
        $this->ctrlJeu->demandeAfficheJeu($tempVerification);
      }else
      if($tempVerification == "perdu"){
        $this->ctrlJeu->demandeAfficheJeu($tempVerification);
      }else{
        $this->ctrlJeu->demandeAfficheJeu(0);
      }
    }else
    if(!empty($_POST['logout'])&& isset($_SESSION['user_token'])){
      header('./controleur/controleurLogout.php');
    }else
    if(!empty($_POST['next'])&& isset($_SESSION['user_token'])&&isset($_SESSION['etatPartie'])){
      $this->ctrlClassement->demandeAfficheClassement();
    }else
    if(!empty($_POST['replay'])&& isset($_SESSION['user_token'])){
      $this->ctrlJeu->replay();
      $this->ctrlJeu->demandeAfficheJeu(0);
    }else
    if(isset($_SESSION['etatPartie'])){
      $this->ctrlClassement->demandeAfficheClassement();
    }else
    if(!empty($_POST['circle'])&& isset($_SESSION['user_token'])){
      $this->ctrlJeu->demandeAjoutPion($_POST['circle']);
      $this->ctrlJeu->demandeAfficheJeu(0);
    }else
    if(!empty($_POST['backward'])&& isset($_SESSION['user_token'])){
      $this->ctrlJeu->demandeSupprimerPion();
      $this->ctrlJeu->demandeAfficheJeu(0);
    }else
    if(isset($_SESSION['user_token'])){
      $this->ctrlJeu->demandeAfficheJeu(0);
    }else
    if(!empty($_POST['inscription'])){
      $this->ctrlInscription->demandeAfficheInscription();
    }else
    if(!empty($_POST['inscrire'])){
      $retourInscription = $this->ctrlInscription->demandeInscriptionPseudo($_POST['pseudo-inscription'], $_POST['password-inscription'],  $_POST['password2-inscription']);
      if($retourInscription ==0 ){
        $this->ctrlAuthentification->demandeAfficheAuthentification();
      }else{
        $this->ctrlErreur->demandeAfficheErreurInscription($retourInscription);
      }
    }else
    if(!empty($_POST['valider'])){
      if($this->ctrlAuthentification->demandeVerificationPseudo($_POST['pseudo'], $_POST['password'])){
        $this->ctrlJeu->replay();
        $this->ctrlJeu->demandeAfficheJeu(0);
      }else{
        $this->ctrlErreur->demandeAfficheErreurAuthentification();
      }
    }else{
      $this->ctrlAuthentification->demandeAfficheAuthentification();
    }
  }


}




?>
