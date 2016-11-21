<?php
require_once __DIR__."/../vue/authentification.php";
require_once __DIR__."/../vue/erreur.php";
require_once __DIR__."/../vue/jeu.php";

class ControleurAuthentification{

private $authentification;
private $erreur;

  function __construct(){
    $this->authentification = new Authentification();
    $this->erreur = new Erreur();
    $this->jeu = new Jeu();

  }

  function accueil(){
    $this->authentification->demandePseudo();
  }

  function afficheJeu(){
    $this->jeu->demandeAfficheJeu();
  }

  function afficheErreur(){
    $this->erreur->afficheErreurAuthentification();
  }

  function verificationPseudo($pseudo, $password){
    try{
      $connexion=new PDO('mysql:host=localhost;dbname=mastermind','root','');
    }catch (PDOException $e){
      print($e->getMessage());
    }

    $stmt = $connexion->prepare("SELECT pseudo, motDePasse from joueurs where joueurs.pseudo=?");
    $stmt->bindParam(1, $pseudo);
    $stmt->execute();
    $tabResult=$stmt->fetchAll();

    foreach ($tabResult as $row){
      if ($pseudo == $row['pseudo'] && crypt($password, $row['motDePasse'])== $row['motDePasse']) {
          return true;
      }
    }
    return false;
  }
}

?>
