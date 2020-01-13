<?php 

class utilisateur {
	use Genos;
	public $id;
	public $nom;
	public $prenom;
	public $login;
	public $password;
	public $vacataire;
	public $date_validite;
	public $id_groupe_utilisateur;
	public $id_ligue;

	function __construct(){
		$this->id                    = 0;
		$this->nom                   = '';
		$this->prenom                = '';
		$this->login                 = '';
		$this->password              = '';
		$this->vacataire             = 0;
		$this->date_validite         = '0000-00-00 00:00:00';
		$this->id_groupe_utilisateur = 0;
		$this->id_ligue              = 0;
	}

}