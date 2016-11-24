<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../vue/vueClassement.php";
require_once __DIR__."/../modele/modeleJeu.php";

class ControleurJeu{

	private $vueJeu;
	private $vueClassement;
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
		$this->vueClassement = new vueClassement($this->modeleJeu);


	}

	function demandeAfficheJeu(){
		 (new VueJeu($this->modeleJeu))->affichejeu();
	}

	function demandeAjoutPion($couleur) {
		$this->modeleJeu->ajouterPion($couleur);
  }

	function demandeSupprimerPion(){
		$this->modeleJeu->supprimerPion();
	}

	function demandeVerification(){
		if ($this->modeleJeu->estPlein()){
			$this->modeleJeu->verification();
			if($this->modeleJeu->finPartie()){
				return "gagne";
			}else
			if ($this->modeleJeu->getAuthorizedColumn() == 10){
					if($this->modeleJeu->finPartie()){
						return "gagne";
					}
					return "perd";
			}
		}
		return "";
	}


	function demandeGagne(){
		$this->modeleJeu->gagne();
	}
	function demandePerdu(){
		$this->modeleJeu->perdu();
	}
}
?>
