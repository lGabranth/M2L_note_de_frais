var vue = new Vue({
	el: '#app',
	data:{
		liste_utilisateurs:[],
		recherche:'',
		ajout:{
			nom:'',
			prenom:'',
			login:'',
			password:'',
			vacataire:0,
			data_valide:null,
			id_groupe_utilisateur:2,
			id_ligue:0,
		},
		modif:{},
		suppr:{},
	},
	mounted(){
		this.GetListeUtilisateur();
	},
	computed:{
		liste_utilisateur_filtree(){
			var resTmp = [];

			if (this.recherche == '') resTmp = this.liste_utilisateurs;
			if (this.recherche != '') {
				resTmp = this.liste_utilisateurs.filter( utilisateur => {
					let recherche = this.recherche.toLowerCase();
					let nom = utilisateur.nom.toLowerCase();
					let prenom = utilisateur.prenom.toLowerCase();
					let ligue = utilisateur.ligue.toLowerCase();

					return nom.indexOf(recherche) > -1 || ligue.indexOf(recherche) > -1 || prenom.indexOf(recherche) > -1;
				})
			}
		},
	},
	methods:{
		GetListeUtilisateur:function(){
			var scope = this;

			$.ajax({
				url:"data.php?cas=liste_utilisateurs",
				type:"POST",
				data:{},
				success:function(res){
					scope.liste_utilisateurs = JSON.parse(res);
				},
				error:function(){}
			});
		},

	},
})