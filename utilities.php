<?php 
function Head($titre, $menu){ ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title><?php echo $titre ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo RACINE_GLOBAL_RELATIF ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo RACINE_GLOBAL_RELATIF ?>css/style.css">
    <link rel="stylesheet" href="<?php echo RACINE_GLOBAL_RELATIF ?>css/animate.min.css">
    <link rel="stylesheet" href="<?php echo RACINE_GLOBAL_RELATIF ?>css/notify.css">
    <link rel="stylesheet" href="<?php echo RACINE_GLOBAL_RELATIF ?>css/all.css">
  </head>
  <body>
  	<?php if($menu > 0) Menu($menu); ?>
<?php }

function Menu($menu){ ?>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgba(36, 36, 36, 0.6);" id="menu">
	  <a class="navbar-brand <?php echo ($menu == 1) ? 'active' : 'text-white-50'; ?>" href="<?php echo RACINE_GLOBAL_RELATIF ?>index.php">
	  	<!-- <img src="<?php //echo RACINE_GLOBAL_RELATIF ?>img/<?php //echo ($menu == 1) ? 'logo_on.png' : 'logo.png' ?>" alt="N2F"> -->
	  	N2F
	  </a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	    	<?php if($_SESSION["id_grp_user"] != 1) {?>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Gérer <?php echo ($_SESSION["id_grp_user"] == 3) ? 'mes' : 'les' ?> notes de frais</a>
		      </li>
		    <?php } ?>
		    <?php if($_SESSION["id_grp_user"] == 2) {?>
		      <li class="nav-item">
		      	<?php if($_SESSION['id_ligue'] > 0) {?>
			        <a class="nav-link <?php echo ($menu == 2) ? 'active' : '' ?>" href="<?php echo RACINE_GLOBAL_RELATIF ?>1-modules/gestion_salarie">
			        	Gestion des salariés
			        </a>
		      	<?php } else { ?>
							<a class="nav-link text-muted" style="cursor: not-allowed;">
			        	Gestion des salariés
			        </a>
		      	<?php } ?>
		      </li>
		    <?php } ?>
		    <?php if($_SESSION["id_grp_user"] == 1) {?>
		    	<li class="nav-item">
		        <a class="nav-link <?php echo ($menu == 2) ? 'active' : '' ?>" href="<?php echo RACINE_GLOBAL_RELATIF ?>1-modules/gestion_ligue">Gestion des ligues</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Gestion des directeurs</a>
		      </li>
		    <?php } ?>
	    </ul>
	    <div class="my-2 my-lg-0">
	    	<?php if($_SESSION["id_grp_user"] != 1) {?>
	    		<a href="<?php echo RACINE_GLOBAL_RELATIF ?>1-modules/profil" data-toggle="tooltip" data-placement="bottom" title="Profil"><i class="fas fa-user fa-lg <?php echo ($menu == 3) ? 'text-white' : 'text-info' ?>"></i></a> &nbsp;
	    	<?php } ?>
	    	<a href="#" @click="Deconnexion" data-toggle="tooltip" data-placement="bottom" title="Se déconnecter"><i class="fas fa-power-off text-danger fa-lg"></i></a>
	    </div>
	    <!-- <form class="form-inline my-2 my-lg-0">
	      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    </form> -->
	  </div>
	</nav>
<?php }

function Footer($path_supplementaire = '', $menu_present = 1){ ?>
	<?php $path_supplementaire = (isset($path_supplementaire) && !empty($path_supplementaire)) ? $path_supplementaire : ''; ?>
    <script>
    	RACINE_GLOBAL_RELATIF = '<?php echo RACINE_GLOBAL_RELATIF ?>';
    </script>
    <script src="<?php echo RACINE_GLOBAL_RELATIF ?>js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo RACINE_GLOBAL_RELATIF ?>js/lodash.js"></script>
		<script src="<?php echo RACINE_GLOBAL_RELATIF ?>js/notify.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="<?php echo RACINE_GLOBAL_RELATIF ?>js/bootstrap.js"></script>
    <script src="<?php echo RACINE_GLOBAL_RELATIF ?>js/vue.js"></script>
    <?php if($menu_present == 1) {?>
    	<script src="<?php echo RACINE_GLOBAL_RELATIF ?>js/composants/menu/menu.comp.vue.js"></script>
  	<?php } ?>
    <script>
    	$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			})
    </script>
    <?php if($path_supplementaire != '') {?>
    	<script src='<?php echo $path_supplementaire ?>'></script>
    <?php } ?>
  </body>
</html>
<?php }