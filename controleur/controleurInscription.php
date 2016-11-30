<?php
require_once __DIR__."/../vue/vueInscription.php";
require_once __DIR__."/../modele/modeleInscription.php";

class ControleurInscription{
private $modeleInscription;
private $vueInscription;

  function __construct(){
    $this->vueInscription = new VueInscription();
    $this->modeleInscription = new ModeleInscription();
  }

  function demandeAfficheInscription(){
    $this->vueInscription->afficheInscription();
  }

  function demandeInscriptionPseudo($pseudo, $password, $password2){
    return $this->modeleInscription->inscriptionPseudo($pseudo, $password, $password2);
  }
}

?>
