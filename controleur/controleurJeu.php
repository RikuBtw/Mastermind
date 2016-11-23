<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../modele/modeleJeu.php";

class ControleurJeu{

	private $vueJeu;
	private $modeleJeu;

	function __construct(){
		$this->modeleJeu=new ModeleJeu();
		$_SESSION['modele']=$this->modeleJeu;
		$this->vueJeu=new VueJeu($_SESSION['modele']);


	}

	/**
	 * Methode permettant de débuter le jeu, ce qui signifie initialiser la combinaison recherchée
	 */

   function initialize(){
  		$_SESSION['modele']->initialisation();
  }

	function demandeAfficheJeu(){
		$this->vueJeu->afficheJeu();
	}

	function demandeAjoutPion($couleur) {
		$_SESSION['modele']->ajouterPion($couleur);
  }

	function demandeSupprimmerPion(){
		$_SESSION['modele']->supprimerPion();
	}

	function demandeVerification(){
		if ($_SESSION['modele']->estPleine()){
			$_SESSION['modele']->verification();
			if ($_SESSION['modele']->gagne()){
				$this->vueJeu->afficherGagner();
			}
			if ($_SESSION['modele']->authorizedColumn == 9){
				$this->vueJeu->afficherPerdu();
			}
			$_SESSION['modele']->$authorizedColumn++;
		}
	}
}
?>
