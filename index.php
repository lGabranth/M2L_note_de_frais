<?php include('0-config/config-genos.php'); 
if(empty($_SESSION) || $_SESSION["id_user"] <= 0) header('Location:login.php');
?>
<?php Head('Accueil', 1); ?>
	<div class="container">
		<div class="row">
			<div class="col">
				<h2 class="mt-4 text-center" style="text-shadow: 0.8px 0.4px 1px black;">
					<span style="color: white;">Bienvenue</span>, <span class="text-primary"><?php echo $_SESSION['prenom_user'].' '.$_SESSION['nom_user'] ?></span>.
				</h2>
			</div>
		</div>
		
		<div class="row mt-4">
			<div class="col">
				<div class="card">
				  <div class="card-body">
				  	<?php if($_SESSION['id_grp_user'] == 1) {?>
				    	<h5 class="card-title">Gestion des ligues</h5>
				    	<p class="card-text">Permet de créer/modifier/supprimer des ligues.</p>
				    	<div class="text-right">
				    		<a href="<?php echo RACINE_GLOBAL_RELATIF ?>1-modules/gestion_ligue" class="btn btn-degrade">Aller</a>
				    	</div>
				  	<?php } ?>
				  	<?php if($_SESSION['id_grp_user'] == 2 || $_SESSION['id_grp_user'] == 3) {?>
				    	<h5 class="card-title">Gestion des note de frais</h5>
				    	<p class="card-text">Permet de gérer <?php echo ($_SESSION['id_grp_user'] == 2) ? 'les' : 'mes' ?> notes de frais.</p>
				    	<div class="text-right">
				    		<a href="#" class="btn btn-degrade">Aller</a>
				    	</div>
				  	<?php } ?>
					</div>
				</div>
			</div>

			<div class="col">
				<div class="card">
				  <div class="card-body">
				  	<?php if($_SESSION['id_grp_user'] == 1) {?>
				    	<h5 class="card-title">Gestion des directeurs</h5>
				    	<p class="card-text">Permet de créer/modifier/supprimer des directeurs.</p>
				    	<div class="text-right">
				    		<a href="#" class="btn btn-degrade">Aller</a>
				    	</div>
				  	<?php } ?>
				  	<?php if($_SESSION['id_grp_user'] == 2) {?>
				    	<h5 class="card-title">Gestion des salariés</h5>
				    	<p class="card-text">Permet de gérer les comptes des salariées.</p>
				    	<div class="text-right">
				    		<a href="#" class="btn btn-degrade">Aller</a>
				    	</div>
				  	<?php } ?>
				  	<?php if($_SESSION['id_grp_user'] == 3) {?>
				    	<h5 class="card-title">Mon profil</h5>
				    	<p class="card-text">Voir et modifier mon profil.</p>
				    	<div class="text-right">
				    		<a href="#" class="btn btn-degrade">Aller</a>
				    	</div>
				  	<?php } ?>
				  </div>
				</div>
			</div>

			<?php if($_SESSION['id_grp_user'] == 2) {?>
				<div class="col">
					<div class="card">
				  <div class="card-body">
			    	<h5 class="card-title">Mon profil</h5>
			    	<p class="card-text">Voir et modifier mon profil.</p>
			    	<div class="text-right">
			    		<a href="#" class="btn btn-degrade">Aller</a>
			    	</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php Footer(); ?>