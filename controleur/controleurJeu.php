<?php
require_once __DIR__."/../vue/vueJeu.php";
require_once __DIR__."/../vue/vueClassement.php";
require_once __DIR__."/../modele/modeleJeu.php";
require_once __DIR__."/../modele/modeleBD.php";
class ControleurJeu{
	private $vueJeu;
	private $vueClassement;
	private $modeleJeu;
	private $modeleBD;
	function __construct(){
		if(isset($_SESSION['modeleJeu'])){
			$this->modeleJeu = $_SESSION['modeleJeu'];
		}else{
			$_SESSION['modeleJeu']=new ModeleJeu();
			$this->modeleJeu = $_SESSION['modeleJeu'];
			$this->modeleJeu->initialisation();
		}
		$this->vueJeu=new VueJeu($this->modeleJeu);
		$this->modeleBD = new ModeleBD();
		}
	function refreshBD(){
		$this->modeleBD = new ModeleBD();
	}
	function replay(){
		unset($_SESSION['modeleJeu']);
		unset($_SESSION['etatPartie']);
		$_SESSION['modeleJeu']=new ModeleJeu();
		$this->modeleJeu = $_SESSION['modeleJeu'];
		$this->modeleJeu->initialisation();
		$this->vueJeu=new VueJeu($this->modeleJeu);
	}
	function demandeAfficheJeu($result){
		 (new VueJeu($this->modeleJeu))->affichejeu($result);
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
				$this->modeleJeu->decouvrir();
				$_SESSION['nbCoups'] = $this->modeleJeu->getAuthorizedColumn();
				$_SESSION['etatPartie'] = 1;
				$this->modeleBD->ajouterPartieBD();
				$this->refreshBD();
				return "gagne";
			}else
			if ($this->modeleJeu->getAuthorizedColumn() >= 10){
					if($this->modeleJeu->finPartie()){
						$this->modeleJeu->decouvrir();
						$_SESSION['nbCoups'] = $this->modeleJeu->getAuthorizedColumn();
						$_SESSION['etatPartie'] = 1;
						$this->modeleBD->ajouterPartieBD();
						$this->refreshBD();
						return "gagne";
					}
					$this->modeleJeu->decouvrir();
					$_SESSION['nbCoups'] = $this->modeleJeu->getAuthorizedColumn();
					$_SESSION['etatPartie'] = 0;
					$this->modeleBD->ajouterPartieBD();
					$this->refreshBD();
					return "perdu";
			}
		}
		return "";
	}
}
?>
