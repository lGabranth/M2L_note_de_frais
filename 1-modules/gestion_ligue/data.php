<?php include('../../0-config/config-genos.php') ?>

<?php 
$cas = (isset($_GET['cas']) && !empty($_GET['cas'])) ? $_GET['cas'] : '';

switch ($cas) {
	case 'liste_ligues':
		$l = new ligue;
		$req = 'SELECT l.id, l.nom, CONCAT(u.nom," ",u.prenom) as directeur 
						FROM ligue l LEFT JOIN utilisateur u ON l.id_utilisateur = u.id 
						ORDER BY l.nom ';
		$champs = array('id','nom','directeur');
		$res = $l->StructList($req, $champs, "json");

		echo $res;
	break;

	case 'liste_utilisateurs':
		$u = new utilisateur;
		$req = "SELECT u.id, CONCAT(u.prenom,' ',u.nom) as identite, COALESCE(l.nom, '') as ligue 
						FROM utilisateur u LEFT JOIN ligue l ON u.id = l.id_utilisateur 
						WHERE u.id_groupe_utilisateur != 1 
						ORDER BY ligue ";
		$champs = array('id','identite','ligue');
		$res = $u->StructList($req, $champs, 'json');

		echo $res;
	break;
}