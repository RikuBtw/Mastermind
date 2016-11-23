<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../modele/modeleJeu.php";

class ControleurJeu{

	private $vueJeu;
	private $modeleJeu;

	function __construct(){
		if(isset($_SESSION['modele'])){
			$this->modeleJeu = $_SESSION['modele'];
		}else{
			$_SESSION['modele']=new ModeleJeu();
			$this->modeleJeu = $_SESSION['modele'];
			$this->modeleJeu->initialisation();
		}
		$this->vueJeu=new VueJeu($this->modeleJeu);


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
