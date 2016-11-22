<?php
require_once __DIR__."/../vue/vueClassement.php";

class ControleurClassement{

private $vueClassement;

  function __construct(){
    $this->vueClassement = new VueClassement();
  }

  function demandeAfficheClassement(){
    $this->vueClassement->afficheClassement();
  }
}
?>
