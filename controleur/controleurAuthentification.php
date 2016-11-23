<?php
require_once __DIR__."/../vue/vueAuthentification.php";

class ControleurAuthentification{

private $vueAuthentification;

  function __construct(){
    $this->vueAuthentification = new VueAuthentification();

  }

  function demandeAfficheAuthentification(){
    $this->vueAuthentification->afficheAuthentification();
  }

  function verificationPseudo($pseudo, $password){
    try{
      $connexion=new PDO('mysql:host=localhost;dbname=E154817E','root','');
    }catch (PDOException $e){
      print($e->getMessage());
    }

    $stmt = $connexion->prepare("SELECT pseudo, motDePasse from joueurs where joueurs.pseudo=?");
    $stmt->bindParam(1, $pseudo);
    $stmt->execute();
    $tabResult=$stmt->fetchAll();

    foreach ($tabResult as $row){
      if ($pseudo == $row['pseudo'] && crypt($password, $row['motDePasse'])== $row['motDePasse']) {
          $_SESSION['username'] = $pseudo;
          $_SESSION['authorizedColumn'] = 0;
          $_SESSION['curseur'] = 0;
          return true;
      }
    }
    return false;
  }
}

?>
