<?php include('../../0-config/config-genos.php') ?>

<?php 
$cas = (isset($_GET['cas'])  && !empty($_GET['cas']))  ? $_GET['cas']  : '';
$nom = (isset($_POST['nom']) && !empty($_POST['nom'])) ? $_POST['nom'] : '';
$id = (isset($_POST['id'])  && !empty($_POST['id'])) ? $_POST['id'] : '';
$id_utilisateur = (isset($_POST['id_utilisateur']) && !empty($_POST['id_utilisateur'])) ? $_POST['id_utilisateur'] : 0;

switch ($cas) {
	case 'liste_ligues':
		$l = new ligue;
		$req = 'SELECT l.id, l.nom, COALESCE(CONCAT(u.nom," ",u.prenom), "") as directeur, l.id_utilisateur 
						FROM ligue l LEFT JOIN utilisateur u ON l.id_utilisateur = u.id 
						ORDER BY l.nom ';
		$champs = array('id','nom','directeur','id_utilisateur');
		$res = $l->StructList($req, $champs, "json");

		echo $res;
	break;

	case 'liste_utilisateurs':
		echo json_encode(utilisateur::GetListeUtilisateurs(1));
	break;

	case 'ajout_ligue':
		#Si il n'y a pas de nom, on ne va pas plus loin.
		if($nom == ''){
			echo -2;
			return;
		}
		$l = new ligue;

		#On regarde si le nom est déjà attribué ou non.
		$tab_verif_nom = $l->Find(array('nom'=>$nom));
		#Si c'est le cas, on ne va pas plus loin.
		if(count($tab_verif_nom) > 0){
			echo -1;
			return;
		}

		$l->nom = $nom;
		
		if($id_utilisateur == 0) $l->Add();
		#Si on a un id_utilisateur dans l'objet Ajout, on vérifie si il est déjà directeur ou non
		if($id_utilisateur > 0){

			$l2 = new ligue;
			#On vérifie si une ligue à déjà l'utilisateur comme directeur, si c'est le cas on lui enlève la direction de cette ligue
			$l2_tab = $l2->Find(array('id_utilisateur'=>$id_utilisateur));
			if(count($l2_tab) > 0){
				$l2_old = new ligue;
				$l2_old->id = $l2_tab[0]['id'];
				$l2_old->Load();
				$l2_old->id_utilisateur = 0;
				$l2_old->Update();
			}
			#On ajoute l'id_utilisateur à notre nouvelle entrée
			$l->id_utilisateur = $id_utilisateur;
			#On charge l'utilisateur à l'avance
			$u = new utilisateur;
			$u->id = $id_utilisateur;
			$u->Load();
			$u->id_ligue = $l->Add(); 
			$u->Update();
		}

		echo 1;
	break;

	case 'modif_ligue':
		#On charge les changements et on modifie la ligue
		$l = new ligue;
		$l->id = $id;
		$l->Load();
		if($l->id_utilisateur != $id_utilisateur) $ancien_directeur = $l->id_utilisateur;
		else $ancien_directeur = 0;

		$l->LoadForm();
		$l->Update();

		if($ancien_directeur > 0){
			$u_old = new utilisateur;
			$u_old->id = $ancien_directeur;
			$u_old->Load();
			$u_old->id_groupe_utilisateur = 3;
			$u_old->Update();
		}

		if($id_utilisateur > 0){
			#On rajoute la ligue à l'utilisateur que l'on a passé en admin et si il n'était pas de rang directeur, on le passe directeur.
			$u = new utilisateur;
			$u->id = $id_utilisateur;
			$u->Load();
			$u->id_ligue = $id;
			if($u->id_groupe_utilisateur == 3) $u->id_groupe_utilisateur = 2;
			$u->Update();
		}
	break;

	case 'suppr_ligue':
		$l = new ligue;
		$u = new utilisateur;

		$l->id = $id;
		$l->Load();
		$l->Delete();

		#On supprime tous les id_ligue des agents liés à la ligue que l'on vient de delete
		$bind = array('id_ligue'=>$id);
		$req = "UPDATE utilisateur SET id_ligue = 0 WHERE id_ligue = :id_ligue ";
		$u->Sql($req, $bind);
	break;
}