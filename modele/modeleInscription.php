<?php

class ModeleInscription{

  function inscriptionPseudo($pseudo, $password, $password2){

    if($pseudo!=""&&$password!=""&&$password2!=""){
      if($password == $password2){
        try{
          $connexion=new PDO('mysql:host=localhost;dbname=E154817E','E154817E','E154817E');
          $stmt = $connexion->prepare("SELECT COUNT(pseudo) from joueurs where pseudo=?");
          $stmt->bindParam(1, $pseudo);
          $stmt->execute();
          $retour = $stmt->fetch();
          if($retour[0] == 0){
            $stmt2 = $connexion->prepare("INSERT INTO joueurs(pseudo, motDePasse) VALUES (?,?)");
            $stmt2->bindParam(1, $pseudo);
            $stmt2->bindParam(2, crypt($password));
            $stmt2->execute();
            return 0;
          }else{
            return 1;
          }
        }catch (PDOException $e){
          print($e->getMessage());
        }
      }else{
        return 2;
      }
    }
    return 3;
  }
}

?>
