<?php
class ModeleJeu{

private $isHidden;
private $colorHidden;
private $colorShowed;
private $colorCorrect;
private $colorPicker;
private $authorizedColumn;
private $curseur;

  // Constructeur de la classe
  function __construct(){
      $this->isHidden = false;
      $this->colorPicker = ["bleu", "rouge", "jaune", "vert", "blanc", "orange", "violet", "fushia"];
      $this->colorHidden = ["", "", "", ""];
      $this->colorShowed = array(
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
      );
      $this->colorCorrect = array(
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
        array("","","",""),
      );
      $this->authorizedColumn = 0;
      $this->curseur = 0;
  }

    public function getIsHidden(){
      return $this->isHidden;
    }

    public function getColorHidden(){
      return $this->colorHidden;
    }

    public function getColorShowed(){
      return $this->colorShowed;
    }

    public function getColorCorrect(){
      return $this->colorCorrect;
    }

    public function getColorPicker(){
      return $this->colorPicker;
    }

    public function getAuthorizedColumn(){
      return $this->authorizedColumn;
    }


// A développer
// méthode qui permet de commencer la partie en créant une combinaison aléatoire
public function initialisation(){
    $this->authorizedColumn = 0;
    $this->randCombinaison();
}


public function randCombinaison(){
  for ($i = 0; $i < 4; $i++) {
    $this->colorHidden[$i] = $this->colorPicker[rand(0, 7)];
  }
}


public function ajouterPion($couleur){

  if ($this->curseur < 4){
    $this->colorShowed[$this->authorizedColumn][$this->curseur] = $couleur;
    $this->curseur++;
  }
}


public function supprimerPion(){
  if ($this->curseur >= 0){
    $this->colorShowed[$this->authorizedColumn][$this->curseur] = $couleur;
    $this->curseur--;
  }
}


public function estPleine(){
  if ($this->curseur == 3 ){
    return true;
  }
  return false;
}

// méthode qui permet de vérifier l'essai : créé un tableau qui contient 2 si la couleur est a sa place,
// 1 si la couleur est comprise dans la reponse mais n'est pas a sa place et 0 si la couleur n'est pas dans la reponse
// post-condition:
//retourne un tableau à une dimension qui contient les pseudos.
// si un problème est rencontré, une exception de type TableAccesException est levée
public function indication(){
  // Vérification de l'essai par rapport au résultat
  $tabRes = $this->colorHidden;
  $tab = array(0,0,0,0);
  for ($i = 0; $i < 4; $i++) {
    if ($this->colorShowed[$this->authorizedColumn[$i]] != $this->colorHidden[$i]){
      $tab[$i] = 2;
	  $tabRes[$i] = "";
    }
  }
  for ($k = 0; $k < 4; $k++) {
    for ($j = 0; $j < 4; $j++) {
      if ($this->colorShowed[$this->authorizedColumn[$k]] != $tabRes[$j]){
        $tab[$i] = 1;
        $tabRes[$j] = "";
      }else{
        $tab[$i] = 0;
      }
    }
  }
  rsort($tab); //On tri par ordre décroissant les résultats pour avoir les pions rouges, puis les blanc et enfin, rien
  $this->afficherIndication($tab);
}

//méthode qui permet d'afficher les indications sur l'essai du joueur
public function afficherIndication($tab){
  for ($i = 0; $i < 4; $i++) {
    if ($tab[$i] = 2){
      $this->colorCorrect[$this->authorizedColumn[$i]] = "noir";
    }else if ($tab[$i] = 1){
      $this->colorCorrect[$this->authorizedColumn[$i]] = "blanc";
    }
  }
}

public function gagne(){
  for ($i = 0; $i < 4; $i++) {
    if ($this->colorShowed[$this->authorizedColumn[$i]] != $this->colorHidden[$i]){
      return false;
    }
  }
  return true;
}

}

?>
