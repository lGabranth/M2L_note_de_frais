<?php include('../../0-config/config-genos.php'); 

$cas = $_GET['cas'];
$login = (isset($_POST['login']) && !empty($_POST['login'])) ? $_POST['login'] : '';

switch ($cas) {
	case 'liste_salarie':
		$u = new utilisateur;
		$bind = array('id_ligue'=>$_SESSION['id_ligue']);
		$req = 'SELECT u.id, 
									 u.nom, 
									 u.prenom, 
									 u.vacataire, 
									 COALESCE(u.date_validite, "Aucune") as date_validite, 
									 gu.groupe_utilisateur, 
									 l.nom as ligue 
						FROM utilisateur u 
						INNER JOIN groupe_utilisateur gu ON u.id_groupe_utilisateur = gu.id 
						LEFT JOIN ligue l ON u.id_ligue = l.id 
						WHERE u.id_ligue = :id_ligue AND u.id_groupe_utilisateur = 3 
						ORDER BY u.prenom ';
		$champs = array('id','nom','prenom','vacataire','date_validite','groupe_utilisateur','ligue');
		$res = $u->StructList($req, $champs, $bind, "json");

		echo $res;
	break;

	case 'verif_dispo_login':
		$u = new utilisateur;
		$res = $u->Find(array('login'=>$login));

		echo (count($res) > 0) ? -1 : 1;
	break;
}