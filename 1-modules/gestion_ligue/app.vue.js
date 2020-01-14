var vue = new Vue({
	el: '#app',
	data:{
		liste_ligues:[],
		liste_utilisateurs:[],
		recherche:'',
		ajout:{
			nom:'',
			id_utilisateur:0,
		},
	},
	mounted(){
		this.GetListeLigue();
		this.GetListeUtilisateur();
	},
	computed:{
		liste_ligue_filtree(){
			var resTmp = [];

			if(this.recherche == '') resTmp = this.liste_ligues;
			if(this.recherche != ''){
				resTmp = this.liste_ligues.filter( ligue => { 
					let recherche = this.recherche.toLowerCase();
					let nom = ligue.nom.toLowerCase();
					let directeur = ligue.directeur.toLowerCase();

					return nom.indexOf(recherche) > -1 || directeur.indexOf(recherche) > -1;
				});
			}

			return resTmp;
		},
	},
	methods:{
		GetListeLigue:function(){
			var scope = this;

			$.ajax({
				url:"data.php?cas=liste_ligues",
				type:"POST",
				data:{},
				success:function(res){
					scope.liste_ligues = JSON.parse(res);
				},
				error:function(){
				}
			});
		},

		OuvrirModalAjout:function(){
			$('#modal_ajout').modal('show');
		},

		GetListeUtilisateur:function(){
			var scope = this;

			$.ajax({
				url:"data.php?cas=liste_utilisateurs",
				type:"POST",
				data:{},
				success:function(res){
					scope.liste_utilisateurs = JSON.parse(res);
				},
				error:function(){
				}
			});
		},
	},
})