<?php
class ModeleBD{

private $listeClassement;
private $curseur;
private $moyenneCoups;

  // Constructeur de la classe
  function __construct(){
      $this->listeClassement = array(
      	array("","Vide",""),
      	array("","Vide",""),
      	array("","Vide",""),
      	array("","Vide",""),
      	array("","Vide",""),
      );
      $this->curseur = 0;
      $this->moyenneCoups=0;
  }

  function getListeClassement(){
    return $this->listeClassement;
  }

  // Méthode permettant d'insérer une partie dans la liste des scores
  function insererPartie($pseudo, $nbCoups, $id){
     $this->listeClassement[$this->curseur][0] = $pseudo;
     $this->listeClassement[$this->curseur][1] = $nbCoups;
     $this->listeClassement[$this->curseur][2] = $id;
     $this->curseur++;
  }

  //Affichage des 5 meilleurs scores de la base de données
  function recuperation5Premiers(){
    try{
      $connexion=new PDO('mysql:host=localhost;dbname=E154817E','E154817E','E154817E');
      $requete = "SELECT pseudo, nombreCoups from parties where partieGagnee = 1  order by nombreCoups asc limit 0,5;";
      $stmt = $connexion->prepare($requete);
      $stmt->execute();
      $tabResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
      print($e->getMessage());
    }
    foreach($tabResult as $row){
        $moyenneGagnee = $this->recupererMoyenneGagnee($row['pseudo']);
        $this->insererPartie($row['pseudo'], $row['nombreCoups'], "1"+$moyenneGagnee);
    }
  }

  function recupererMoyenneCoups(){
    try{
      $connexion=new PDO('mysql:host=localhost;dbname=E154817E','E154817E','E154817E');
      $requete = "SELECT AVG(nbCoups) FROM parties where parties.joueur = ?";
      $stmt = $connexion->prepare($requete);
      $stmt->bindParam(1, $_SESSION['user_token']);
      $this->moyenneCoups = $stmt->execute();
    }catch (PDOException $e){
      print($e->getMessage());
    }
  }

  function recupererMoyenneGagnee($joueur){
    try{
      $connexion=new PDO('mysql:host=localhost;dbname=E154817E','E154817E','E154817E');
      $requete = "SELECT AVG(partieGagnee) FROM parties where parties.joueur = ?";
      $stmt = $connexion->prepare($requete);
      $stmt->bindParam(1, $joueur);
      return ($stmt->execute());
    }catch (PDOException $e){
      print($e->getMessage());
    }
  }

  function ajouterPartieBD(){
    try{
      $connexion=new PDO('mysql:host=localhost;dbname=E154817E','E154817E','E154817E');
      $requete = "INSERT INTO parties(pseudo, partieGagnee, nombreCoups) VALUES (?,?,?)";
      $stmt = $connexion->prepare($requete);
      $stmt->bindParam(1, $_SESSION['user_token']);
      $stmt->bindParam(2, $_SESSION['etatPartie']);
      $stmt->bindParam(3, $_SESSION['nbCoups']);
      $stmt->execute();
    }catch (PDOException $e){
      print($e->getMessage());
    }


  }
}


?>
