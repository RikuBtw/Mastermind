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
      $this->isHidden = true;
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

    public function getCurseur(){
      return $this->curseur;
    }

    public function getAuthorizedColumn(){
      return $this->authorizedColumn;
    }


// A développer
// méthode qui permet de commencer la partie en créant une combinaison aléatoire
public function initialisation(){
    $this->isHidden = true;
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
  if ($this->curseur > 0){
    $this->curseur--;
    $this->colorShowed[$this->authorizedColumn][$this->curseur] = "";
  }
}

public function estPlein(){
  if ($this->curseur == 4 ){
    $this->curseur = 0;
    $this->authorizedColumn++;
    return true;
  }
  return false;
}

// méthode qui permet de vérifier l'essai : créé un tableau qui contient 2 si la couleur est a sa place,
// 1 si la couleur est comprise dans la reponse mais n'est pas a sa place et 0 si la couleur n'est pas dans la reponse
// post-condition:
//retourne un tableau à une dimension qui contient les pseudos.
// si un problème est rencontré, une exception de type TableAccesException est levée
public function verification(){
  // On stocke les couleurs à trouver afin de ne pas modifier cette liste
  $tabRes = $this->colorHidden;
  // On créé l'array de réponse, il s'agit de chiffre afin de le trier par la suite
  $tab = array(0,0,0,0);
  //On va d'abord vérifier les pions à leur place respective. Si deux pions sont aux même positions, on ajoute à la liste de réponse un pion noir
  for ($i = 0; $i < 4; $i++) {
    if ($this->colorShowed[$this->authorizedColumn-1][$i] == $this->colorHidden[$i]){
      // Valeur de 2 afin d'afficher les pions noir en premier lors du tri
      $tab[$i] = 2;
      //On supprime la valeur de la liste à trouver afin de ne pas la re-vérifier par la suite -> gestion des doublons
      $tabRes[$i] = "";
    }
  }
  // Variable temporaire pour supprimer la valeur de la liste en cas de similitude afin d'éviter les doublons
  $tempEmplacement = null;
  // Première boucle, on itère dans les pions que le joueur à entré
  for ($k = 0; $k < 4; $k++) {
    // Ce booléen permet de vérifier si une valeur entrée est présente parmis les 4 valeurs à trouver, afin de ne pas écraser la réponse
    $estPresente = false;
    //On itère dans les pions à trouver pour chercher une égalité entre l'entrée et les pions à trouver
    for ($j = 0; $j < 4; $j++) {
      if ($this->colorShowed[$this->authorizedColumn-1][$k] == $tabRes[$j]){
        $estPresente = true;
        $tempEmplacement = $j;
      }
    }
    // Si une valeur était à sa place, on ne change pas son résultat, celle-ci étant équivalente directement à la couleur à trouver
    if($tab[$k]!=2){
      // Si on a trouvé une valeur n'étant pas à sa place, on ajoute un pion blanc et on supprime la valeur à trouver pour éviter les doublons
      if($estPresente){
          $tab[$k] = 1;
          $tabRes[$tempEmplacement] = "";
      // Si la valeur entrée n'a pas d'équivalence, on nemet pas de pion blanc ou noir.
      }else{
        $tab[$k] = 0;
      }
    }
  }
  //On tri par ordre décroissant les résultats pour avoir les pions noir, puis les blanc et enfin, rien
  rsort($tab);
  //On va associer aux valeur 2 et 1 respectivement "noir" et "blanc", ceci s'effectue dans la liste de réponse que l'on affichera sur le plateau de jeu
  for ($i = 0; $i < 4; $i++) {
    if ($tab[$i] == 2){
      $this->colorCorrect[$this->authorizedColumn-1][$i] = "noir";
    }
    if ($tab[$i] == 1){
      $this->colorCorrect[$this->authorizedColumn-1][$i] = "blanc";
    }
  }
}

public function finPartie(){
  for ($i = 0; $i < 4; $i++) {
    if ($this->colorCorrect[$this->authorizedColumn-1][$i] != "noir"){
      return false;
    }
  }
  return true;
}

public function decouvrir(){
  $this->isHidden=false;
}
}
?>
