<?php include('../../0-config/config-genos.php');?>

<?php 
$cas = (isset($_GET['cas'])  && !empty($_GET['cas']))  ? $_GET['cas']  : '';


switch ($cas) {
    case 'liste_utilisateurs':
        $u = new utilisateur;
        $req = "SELECT u.id, u.nom, u.prenom, l.nom as ligue
                FROM utilisateur u LEFT JOIN ligue l ON u.id = l.id_utilisateur
                WHERE u.id = 2
                ORDER BY u.nom";
        $champs = array('id', 'nom', 'prenom', 'ligue');
        $res = $u->StructList($req, $champs, "json");

        echo $res;
    break;
}