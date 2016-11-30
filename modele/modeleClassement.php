<?php
class ModeleClassement{
private $listeClassement;
private $curseur;
  // Constructeur de la classe
  function __construct(){
      $this->listeClassement = array(
      	array("-","-","-"),
      	array("-","-","-"),
      	array("-","-","-"),
      	array("-","-","-"),
      	array("-","-","-"),
      );
      $this->curseur = 0;
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
      $requete = "SELECT id, pseudo, nombreCoups from parties where partieGagnee = 1  order by nombreCoups asc limit 0,5;";
      $stmt = $connexion->prepare($requete);
      $stmt->execute();
      $tabResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($tabResult as $row) {
            $this->listeClassement->insererPartie($row['pseudo'], $row['nombreCoups'], $row['id']);
          }
    }catch (PDOException $e){
      print($e->getMessage());
    }
  }
}
?>
