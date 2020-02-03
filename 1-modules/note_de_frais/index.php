<!-- Appel du fichier de config Genos ainsi que de la fonctio header + sécurité pour empécher l'admin d'accéder a cette page -->
<?php include('../../0-config/config-genos.php');
if($_SESSION['id_grp_user'] == 1) header('Location:'.RACINE_GLOBAL_RELATIF.'index.php');
Head("Gestion des notes de frais", 2);
?>
<!-- ATTENTION -> le surlignement dans la navbar de Gérer les notes de frais ne se fait pas bien <- ATTENTION -->
    <main id="app">
        <!-- Modals ajout note de frais -->
        <div class="modal fade" id="modal_ajout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title">Ajouter une note de frais</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
                    <!-- Corps du modal d'ajout -->
		            <div class="modal-body">
		                <div class="container-fluid">
		        	        <div class="row">
		        		        <div class="col">
                                    <label for="">Libelle de la note de frais</label>
                                    <input type="text" class="form-control form-control-sm" v-model="ajout.libelle">
                                    <label for="">Montant de la note de frais</label>
                                    <input type="text" class="form-control form-control-sm" v-model="ajout.montant">
                                    <label for="">Image justificative</label>
                                    <input type="file" id="inputImg" class="form-control form-control-sm">
                                    <!-- Revoir la fonction pour allez chercher l'image -->
		        		        </div>
		        	        </div>
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Annuler</button>
		                <button v-show="ajout.libelle != '' && ajout.montant != '' && ajout.path_image != ''" type="submit"  class="btn btn-sm btn-success" @click="AjoutNote">Ajouter</button>
		            </div>
		        </div>
		    </div>
		</div>

        <!-- Modals refus note de frais -->
        <div class="modal fade" id="modal_refus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title">Raison du refus</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
                    <!-- Corps du modal de refus -->
		            <div class="modal-body">
		                <div class="container-fluid">
		        	        <div class="row">
		        		        <div class="col">
                                    <label for="">Commentaire de refus</label>
                                    <input type="text" class="form-control form-control-sm" v-model="refus.commentaire">
		        		        </div>
		        	        </div>
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Annuler</button>
		                <button type="bouton"  class="btn btn-sm btn-success" @click="RefusNote">Refuser</button>
		            </div>
		        </div>
		    </div>
		</div>
        
        <!-- Modals affichage photo -->
        <div class="modal fade" id="modal_photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title">Photo justificative</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
                    <!-- Corps du modal d'affichage photo -->
		            <div class="modal-body">
		                <div class="container-fluid">
		        	        <div class="row">
		        		        <div class="col">
                                    <img id="justifImg" src="">
		        		        </div>
		        	        </div>
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Annuler</button>
		            </div>
		        </div>
		    </div>
		</div>

        <!-- Titre de l'application -->
        <!-- Corps de l'appli -->
        <div class="container mt-4">
            <div class="row text-center">
                <div class="col">
                    <h2 class="titre-page">Gestion <?php echo ($_SESSION['id_grp_user'] == 2) ? 'des' : 'de mes' ?> notes de frais</h2>
                </div>
            </div>
            <!-- Barre de recherche + liste déroulante -->
            <div class="row mt-4">
                <div class="col bloc">
                    <h3 class="mt-3">Gérer <?php echo ($_SESSION['id_grp_user'] == 2) ? 'les' : 'mes'?> notes de frais</h3>
                    <hr>
                    <div class="input-group mt-2">
                        <input type="search" class="form-control form-control-sm" placeholder="Rechercher une note de frais">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Rechercher</button>
                        </div>
                    </div>
                    <!-- Dans la grille de donnée on met en forme pour différencier les directeurs des salariés -->
                    <?php if ($_SESSION['id_grp_user'] == 3) {?>
                        <button class="btn btn-sm btn-success mt-4" @click="OuvrirModalAjout"><i class="fas fa-plus"></i> Ajouter</button>
                    <?php }?>
                    
                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-stripped">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                <th scope="col">#</th>
					    		<th scope="col">Libellé</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Image</th>
                                <th scope="col">Statut</th>
                                <?php 
                                if ($_SESSION['id_grp_user'] == 2) {?>
                                    <th>Valider</th>
					    		    <th>Refuser</th>
                                <?php }?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(note_de_frais, index) in liste_Mynote" class="text-center">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ note_de_frais.libelle }}</td>
                                    <td>{{ note_de_frais.montant }} €</td>
                                    <td><button class="btn btn-sm btn-info" @click="OuvrirModalPhoto"><i class="far fa-image"></i></button></td>
                                    <td id="etat">{{ note_de_frais.etat_note_de_frais }}</td>
                                    <?php if ($_SESSION['id_grp_user'] == 2 ) {?>
                                        <td><button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button></td>
                                        <td><button class="btn btn-sm btn-danger" @click="OuvrirModalRefus(note_de_frais)"><i class="fas fa-ban"></i></button></td>
                                    <?php }?>
                                </tr>
					        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php Footer('app.vue.js');?>