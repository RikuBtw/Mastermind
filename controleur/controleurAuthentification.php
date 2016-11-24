<?php
require_once __DIR__."/../vue/vueAuthentification.php";
require_once __DIR__."/../modele/modeleAuthentification.php";

class ControleurAuthentification{
private $modeleAuthentification;
private $vueAuthentification;

  function __construct(){
    $this->vueAuthentification = new VueAuthentification();
    $this->modeleAuthentification = new ModeleAuthentification();
  }

  function demandeAfficheAuthentification(){
    $this->vueAuthentification->afficheAuthentification();
  }

  function demandeVerificationPseudo($pseudo, $password){
    if($this->modeleAuthentification->verificationPseudo($pseudo, $password)){
      $_SESSION['user_token'] = $pseudo;
      return true;
    }else{
      return false;
    }
  }
}

?>
