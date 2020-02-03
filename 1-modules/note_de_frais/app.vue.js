var vue = new Vue({
    el: '#app',
    data:{
        liste_Mynote:[],
        recherche:'',
        ajout:{
            libelle:'',
            path_image:'',
            commentaire:'',
            montant:0,
            id_utilisateur:0,
            id_type_note_de_frais:0,
            id_etat_note_de_frais:1,
        },
        valid:{},
        refus:{},
    },
    mounted(){
        this.GetListeMyNote();
    },
    computed:{

    },
    methods:{
        GetListeMyNote:function(){
            var scope = this;
            $.ajax({
                url:'data.php?cas=liste_Mynote',
                type:'POST',
                data:{},
                success:function(res){
                    scope.liste_Mynote = JSON.parse(res);
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
            // A modifier, il faut trouver un moyen d'upload la photo
			var test = (scope.ajout.libelle == '' || scope.ajout.montant == '' || scope.ajout.path_image == '')
			if(test){
				Notify('info','Veuillez saisir les informations de connexion.');
				return;
            }

			$.ajax({
				url:"data.php?cas=ajout_note",
				type:"POST",
				data:scope.ajout,
				success:function(res){
					
				},
				error:function(){
				}
			});
		},

        OuvrirModalValid:function(){

        },

        OuvrirModalRefus:function(elem){
            this.refus = JSON.parse(JSON.stringify(elem));
            $('#modal_refus').modal('show');
        },

        ValidNote:function(){

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
					scope.GetListeMyNote();
					scope.refus = {};
				},
				error:function(){
                    Notify('danger','Veuillez prévenir votre administrateur de cette erreur');
				}
			});
        },

        OuvrirModalPhoto:function(){
            $('#modal_photo').modal('show');
            // Trouver comment ramener le path de l'image
            document.getElementById("justifImg").setAttribute('src', "lol");
        },

    },
})