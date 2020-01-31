<?php include('../../0-config/config-genos.php');?>

<?php
$cas = (isset($_GET['cas'])  && !empty($_GET['cas']))  ? $_GET['cas']  : '';
$id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : '';
$path_image = (isset($_POST['path_image']) && !empty($_POST['path_image'])) ? $_POST['path_image'] : '';
$commentaire = (isset($_POST['commentaire']) && !empty($_POST['commentaire'])) ? $_POST['commentaire'] : '';
$montant = (isset($_POST['montant']) && !empty($_POST['montant'])) ? $_POST['montant'] : '';
$id_utilisateur = (isset($_POST['id_utilisateur']) && !empty($_POST['id_utilisateur'])) ? $_POST['id_utilisateur'] : '';
$id_type_note_de_frais = (isset($_POST['id_type_note_de_frais']) && !empty($_POST['id_type_note_de_frais'])) ? $_POST['id_type_note_de_frais'] : '';
$id_etat_note_de_frais = (isset($_POST['id_etat_note_de_frais']) && !empty($_POST['id_etat_note_de_frais'])) ? $_POST['id_etat_note_de_frais'] : '';

$idSessions = $_SESSION['id_grp_user'];

switch ($cas) {
    case 'liste_Mynote':
        $n = new note;
        $req = "SELECT n.id, n.libelle, n.montant, n.path_image, e.etat_note_de_frais
                FROM note_de_frais n LEFT JOIN etat_note_de_frais e ON n.id_etat_note_de_frais = e.id
                WHERE n.id_utilisateur = ".$idSessions.";";
        $champs = array('id', 'libelle', 'montant', 'path_image', 'etat_note_de_frais');
        $res = $n->StructList($req, $champs, "json");

        echo $res;
    break;
}