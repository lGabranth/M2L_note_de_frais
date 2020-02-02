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

$idSessions = $_SESSION['id_user'];
$idGrpUser = $_SESSION['id_grp_user'];
$idLigue = $_SESSION['id_ligue'];

switch ($cas) {
    case 'liste_Mynote':
        $n = new note;
        if ($idGrpUser == 2) {
            $req = "SELECT u.id_ligue, n.id, n.libelle, n.montant, n.commentaire, n.id_utilisateur, n.path_image, e.etat_note_de_frais, n.id_type_note_de_frais
                    FROM utilisateur u 
                    LEFT JOIN note_de_frais n ON u.id = n.id_utilisateur 
                    LEFT JOIN etat_note_de_frais e ON n.id_etat_note_de_frais = e.id
                    WHERE u.id_ligue = ".$idLigue." && n.id IS NOT NULL;";
        }
        else {
            $req = "SELECT n.id, n.libelle, n.montant, n.path_image, n.commentaire, n.id_utilisateur, e.etat_note_de_frais, n.id_type_note_de_frais
                    FROM note_de_frais n LEFT JOIN etat_note_de_frais e ON n.id_etat_note_de_frais = e.id
                    WHERE n.id_utilisateur = ".$idSessions.";";
        }
        $champs = array('id', 'libelle', 'path_image', 'commentaire', 'montant', 'id_utilisateur', 'id_type_note_de_frais', 'etat_note_de_frais');
        $res = $n->StructList($req, $champs, "json");

        echo $res;
    break;

    //Revoir l'upload de l'image
    case 'ajout_note':
        echo $_FILES['inputImg']['name'];

        $n = new note;
        $req = "SELECT n.id, n.libelle, n.montant, n.path_image, e.etat_note_de_frais
                FROM note_de_frais n LEFT JOIN etat_note_de_frais e ON n.id_etat_note_de_frais = e.id
                WHERE n.id_utilisateur = ".$idSessions.";";
        $champs = array('id', 'libelle', 'montant',  'etat_note_de_frais, id_utilisateur, ');
        $res = $n->StructList($req, $champs, "json");

        echo $res;
    break;

    case 'refus_note':
        if($commentaire == ''){
			echo -1;
			return;
		}
		$n = new note;
        $n->id = $id;
        $n->LoadForm();
        $n->commentaire = $commentaire;
        $n->id_etat_note_de_frais = 3;
        echo ' ';
        echo $n->id;
        echo ' ';
        echo $n->libelle;
        echo ' ';
        echo $n->path_image;
        echo ' ';
        echo $n->commentaire;
        echo ' ';
        echo $n->montant;
        echo ' ';
        echo $n->id_type_note_de_frais;
        echo ' ';
        echo $n->id_etat_note_de_frais;
        // Update de Genos buggé, a revoir !
		$n->Update();

		echo 1;
    break;

}