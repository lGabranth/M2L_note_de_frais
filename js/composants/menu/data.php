<?php include("../../../0-config/config-genos.php");
	$cas = $_GET["cas"];

switch ($cas) {

	case 'deconnexion':
		connexion::Deconnexion();
	break;

}

?>