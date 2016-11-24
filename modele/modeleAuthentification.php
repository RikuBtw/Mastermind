<?php

class ModeleAuthentification{

  function verificationPseudo($pseudo, $password){
    try{
      $connexion=new PDO('mysql:host=localhost;dbname=E154817E','root','');
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
    }catch (PDOException $e){
      print($e->getMessage());
    }

  }
}

?>
