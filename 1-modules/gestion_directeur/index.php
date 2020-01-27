<?php include('../../0-config/config-genos.php');
if($_SESSION['id_grp_user'] != 1) header('Location:'.RACINE_GLOBAL_RELATIF.'index.php');
?>
<?php Head("Gestion des directeurs", 3);?>

    <main id="app">

        <!-- Corps de l'application -->
        <div class="container mt-4">
            <div class="row text-center">
                <div class="col">
                    <h2 class="titre-page">Gestion des directeurs</h2>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col bloc">
                    <h3 class="mt-3">Gérer les directeurs</h3>
                    <hr>
                    <div class="input-group mt-2">
                        <input type="search" class="form-control form-control-sm" placeholder="Rechercher une ligue" v-model="recherche">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Rechercher</button>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-success mt-4"><i class="fas fa-plus"></i> Ajouter</button>

                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-stripped">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                <th scope="col">#</th>
					    		<th scope="col">Identité</th>
					    		<th scope="col">Ligue</th>
					    		<th>Modifier</th>
					    		<th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(utilisateur, index) in liste_utilisateurs" class="text-center">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ utilisateur.nom + ' ' + utilisateur.prenom }}</td>
                                    <td>{{ utilisateur.ligue }}</td>
                                    <td><button class="btn btn-sm btn-warning" ><i class="fas fa-edit"></i></button></td>
                                    <td><button class="btn btn-sm btn-danger" ><i class="fas fa-trash"></i></button></td>
                                </tr>
					        </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

    
    
    
    </main>



<?php Footer('app.vue.js'); ?>