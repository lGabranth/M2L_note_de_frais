var vue = new Vue({
    el: '#app',
    data:{
        liste_NDF:[],
        liste_type_NDF:[],
        recherche:'',
        ajout:{
            libelle:'',
            montant:0,
            id_type_note_de_frais:0,
        },
        valid:{},
        refus:{},
        path_image: '',
    },
    mounted(){
        this.GetListeTypeNDF();
        this.GetListeNDF();
    },
    computed:{

    },
    methods:{
        GetListeTypeNDF:function(){
            var scope = this;

            $.ajax({
                url:"data.php?cas=liste_type_NDF",
                type:"POST",
                data:{},
                success:function(res){
                    scope.liste_type_NDF = JSON.parse(res);
                },
                error:function(){
                }
            });
        },

        GetListeNDF:function(){
            var scope = this;
            $.ajax({
                url:'data.php?cas=liste_NDF',
                type:'POST',
                data:{},
                success:function(res){
                    scope.liste_NDF = JSON.parse(res);
                },
                error:function(){}
            });
        },

        OuvrirModalAjout:function(){
            this.ajout.libelle = '';
            this.ajout.montant = '';
			this.ajout.path_image = '';
			$('#modal_ajout').modal('show');
        },

        AjoutNote:function(){
            var scope = this;
            $("#fileUploadForm").submit(function(e) {
                e.preventDefault();
            });
            // A modifier, il faut trouver un moyen d'upload la photo
			var test = (scope.ajout.libelle == '' || scope.ajout.montant == '')
			if(test){
				Notify('info','Veuillez saisir les informations de connexion.');
				return;
            }
            
            var form_data = new FormData();
            var img = $('#inputImg')[0].files[0];
            form_data.append('file',img);
            form_data.append('libelle',scope.ajout.libelle);
            form_data.append('montant',scope.ajout.montant);
            form_data.append('id_type_note_de_frais',scope.ajout.id_type_note_de_frais);

			$.ajax({
				url:"data.php?cas=ajout_note",
				type:"POST",
                processData: false,
                contentType: false,
				data:form_data,
				success:function(res){
					
				},
				error:function(){
				}
			});
		},

        OuvrirModalValid:function(elem){
            this.valid = elem;
            $('#modal_valid').modal('show');
        },

        ValiderNDF:function(){
            var scope = this;

            $.ajax({
                url:"data.php?cas=valider_NDF",
                type:"POST",
                data:scope.valid,
                success:function(res){
                    Notify('success',`NDF ${scope.valid.libelle} Approuvée`);
                    scope.GetListeNDF();
                    $('#modal_valid').modal('hide');
                },
                error:function(){
                    Notify('danger','Contactez votre admin');
                }
            });
        },

        OuvrirModalRefus:function(elem){
            this.refus = JSON.parse(JSON.stringify(elem));
            $('#modal_refus').modal('show');
        },

        RefusNote:function(){
            var scope = this;
            $.ajax({
				url:"data.php?cas=refus_note",
				type:"POST",
				data:scope.refus,
				success:function(res){
					Notify('success',`Note de frais "${scope.refus.libelle}" modifiée`);
					$('#modal_refus').modal('hide');
					scope.GetListeNDF();
					scope.refus = {};
				},
				error:function(){
                    Notify('danger','Veuillez prévenir votre administrateur de cette erreur');
				}
			});
        },

    },
})