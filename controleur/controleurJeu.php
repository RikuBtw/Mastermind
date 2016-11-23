<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../modele/modeleJeu.php";

class ControleurJeu{

	private $vueJeu;
	private $modeleJeu;

	function __construct(){
		$this->modeleJeu=new ModeleJeu();
		$this->vueJeu=new VueJeu($this->modeleJeu);

	}

	/**
	 * Methode permettant de débuter le jeu, ce qui signifie initialiser la combinaison recherchée
	 */

   function initialize(){
  		$this->modeleJeu->initialisation();
  }

	function demandeAfficheJeu(){
		$this->vueJeu->afficheJeu();
	}

	function demandeAjoutPion($couleur) {
		$this->modeleJeu->ajouterPion($couleur);
  }

	function demandeSupprimmerPion(){
		$this->modeleJeu->supprimerPion();
	}

	function demandeVerification(){
		if ($this->modeleJeu->estPleine()){
			$this->modeleJeu->verification();
			if ($this->modeleJeu->gagne()){
				$this->vueJeu->afficherGagner();
			}
			if ($this->modeleJeu->authorizedColumn == 9){
				$this->vueJeu->afficherPerdu();
			}
			$this->modeleJeu->$authorizedColumn++;
		}
	}
}
?>
