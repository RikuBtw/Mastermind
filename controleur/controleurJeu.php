<?php

require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../vue/vuePartieTerminee.php";
require_once __DIR__."/../modele/modeleJeu.php";

class ControleurJeu{

	private $vueJeu;
	private $vuePartieTerminee;
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
		$this->vuePartieTerminee = new vuePartieTerminee($this->modeleJeu);


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
			if ($this->modeleJeu->getAuthorizedColumn() == 10){
				//$this->vuePartieTerminee->afficherGagner();
			}else{
				$this->modeleJeu->verification();
				if ($this->modeleJeu->gagne()){
					//$this->vuePartieTerminee->afficherGagner();
				}
			}
		}
	}
}
?>
