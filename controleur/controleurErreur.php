<?php
require_once __DIR__."/../vue/vueErreur.php";

class ControleurErreur{

private $vueErreur;

  function __construct(){
    $this->vueErreur = new vueErreur();
  }

  function demandeAfficheErreur(){
    $this->vueErreur->afficheErreurAuthentification();
  }
}
?>
