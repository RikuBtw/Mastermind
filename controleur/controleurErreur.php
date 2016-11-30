<?php
require_once __DIR__."/../vue/vueErreur.php";

class ControleurErreur{

private $vueErreur;

  function __construct(){
    $this->vueErreur = new vueErreur();
  }

  function demandeAfficheErreurAuthentification(){
    $this->vueErreur->afficheErreurAuthentification();
  }

  function demandeAfficheErreurInscription($id_erreur){
    $this->vueErreur->afficheErreurInscription($id_erreur);
  }
}
?>
