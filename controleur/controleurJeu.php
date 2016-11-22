<?php
require_once __DIR__."/../vue/vueJeu.php";

class ControleurJeu{

private $vueJeu;

  function __construct(){
    $this->vueJeu = new VueJeu();
  }

  function demandeAfficheJeu(){
    $this->vueJeu->afficheJeu();
  }
}
?>
