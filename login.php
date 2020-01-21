<?php include('0-config/config-genos.php'); ?>

<?php Head('Connexion', 0); ?>

	<div class="container h-100">
		<div class="row h-100">
			<div class="offset-md-3 col-md-6 bloc my-auto">
				<h1 class="mt-2 text-center">Connexion</h1>
				<hr>
					<?php
						$submit = (isset($_POST["submit"]) && !empty($_POST["submit"])) ? $_POST["submit"] : "";

						if($submit != "" && $submit === 'Connexion'){
							$login = (isset($_POST["login"]) && !empty($_POST["login"])) ? $_POST["login"] : "";
							$password = (isset($_POST["password"]) && !empty($_POST["password"])) ? $_POST["password"] : "";

							if($login == "" || $password == ""){ ?>
								<div class="alert alert-warning text-center">
									Vous n'avez pas complété les informations de connexion
								</div>
							<?php }
							if($login != "" && $password != ""){
								$u = new utilisateur;
								$res = $u->Find(array('login'=>$login, 'password'=>sha1(md5($login.$password))));
								if(count($res) > 0){
									connexion::ConnexionUtilisateur($res[0]['id']);
								}
								else { ?>
									<div class="alert alert-danger text-center">
										Vérifiez vos informations de connexion
									</div>
								<?php }
							}
						}
					?>
				<form action="login.php" method="POST">
					<div class="form-group text-center">
						<label for="login">Identifiant de connexion : </label>
						<input type="text" class="form-control" name="login" id="login">

						<label for="password" class="mt-3">Mot de passe : </label>
						<input type="password" class="form-control" name="password" id="password">
					</div>
					
					<div class="text-right">
						<input type="submit" name="submit" class="btn btn-success mb-3" value="Connexion">
					</div>
				</form>
			</div>
		</div>
	</div>

<?php Footer(); ?>