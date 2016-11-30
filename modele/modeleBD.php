<?php
class ModeleBD{

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
      $requete = "SELECT pseudo, nombreCoups from parties where partieGagnee = 1  order by nombreCoups asc limit 0,5;";
      $stmt = $connexion->prepare($requete);
      $stmt->execute();
      $tabResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
      print($e->getMessage());
    }
    foreach($tabResult as $row){
      $requeteMoyenneVictoire = "SELECT COUNT(partieGagnee) FROM parties where partieGagnee = '1' and parties.pseudo = ?";
      $requeteMoyenneTotal  = "SELECT COUNT(partieGagnee) FROM parties where parties.pseudo = ?";
      $stmt2 = $connexion->prepare($requeteMoyenneVictoire);
      $stmt3 = $connexion->prepare($requeteMoyenneTotal);
      $stmt2->bindParam(1, $row['pseudo']);
      $stmt3->bindParam(1, $row['pseudo']);
      $victoire = $stmt2->execute();
      $total = $stmt3->execute();
      $victoire = $stmt2->fetch();
      $total = $stmt3->fetch();
      if($total[0] != 0){
        $moyenneGagnee = round(($victoire[0]/$total[0])*100);
      }

        $this->insererPartie($row['pseudo'], $row['nombreCoups'], $moyenneGagnee);
    }
  }

  function recupererMoyenneCoups(){
    try{
      $connexion=new PDO('mysql:host=localhost;dbname=E154817E','E154817E','E154817E');
      $requete = "SELECT AVG(nombreCoups) FROM parties where parties.pseudo = ?";
      $stmt = $connexion->prepare($requete);
      $stmt->bindParam(1, $_SESSION['user_token']);
      $stmt->execute();
      $moyenne =  $stmt->fetch();
      if($moyenne[0] != 0){
        return round($moyenne[0]);
      }
    }catch (PDOException $e){
      print($e->getMessage());
    }
  }

  function recupererMoyenneGagnee(){
    try{
      $connexion=new PDO('mysql:host=localhost;dbname=E154817E','E154817E','E154817E');
      $requete1 = "SELECT COUNT(partieGagnee) FROM parties where partieGagnee = '1' and parties.pseudo = ?";
      $requete2 = "SELECT COUNT(partieGagnee) FROM parties where parties.pseudo = ?";
      $stmt1 = $connexion->prepare($requete1);
      $stmt2 = $connexion->prepare($requete2);
      $stmt1->bindParam(1, $_SESSION['user_token']);
      $stmt2->bindParam(1, $_SESSION['user_token']);
      $stmt1->execute();
      $stmt2->execute();
      $victoire = $stmt1->fetch();
      $total = $stmt2->fetch();
      if($total[0] != 0){
        return round((($victoire[0])/($total[0]))*100);
      }


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
