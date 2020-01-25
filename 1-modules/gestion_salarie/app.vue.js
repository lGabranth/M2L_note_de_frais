const gestion_salarie = new Vue({
	el:'#app',
	data:{
		liste_salaries:[],
		liste_ligues:[],
		recherche:'',
		ajout:{
			nom:'',
			prenom:'',
			login:'',
			password:'',
			vacataire:0,
			date_validite:'',
		},
		modif:{},
		ancien_login:'',
		suppr:{},

		verif_dispo_login:0,
		date_du_jour:'',
	},
	mounted(){
		this.GetListeSalarie();

		var date = new Date();
		this.ajout.date_validite = date.getFullYear()+"-"+("0" + (date.getMonth() + 1)).slice(-2)+"-"+("0" + date.getDate()).slice(-2);
		this.date_du_jour = date.getFullYear()+"-"+("0" + (date.getMonth() + 1)).slice(-2)+"-"+("0" + date.getDate()).slice(-2);
	},
	computed:{
		liste_salaries_triee(){
			var resTmp = [];

			if(this.recherche == '') resTmp = this.liste_salaries;
			if(this.recherche != ''){
				resTmp = this.liste_salaries.filter(utilisateur => { 
					let nom = utilisateur.nom.toLowerCase();
					let prenom = utilisateur.prenom.toLowerCase();
					let ligue = utilisateur.ligue.toLowerCase();
					let recherche = this.recherche.toLowerCase().trim();
					return nom.indexOf(recherche) > -1 || prenom.indexOf(recherche) > -1 || ligue.indexOf(recherche) > -1;
				});
			}

			return resTmp;
		},
	},
	methods:{
		GetListeSalarie:function(){
			var scope = this;

			$.ajax({
				url:"data.php?cas=liste_salarie",
				type:"POST",
				data:{},
				success:function(res){
					scope.liste_salaries = JSON.parse(res);
				},
				error:function(){
				}
			});
		},

		OuvrirModalAjout:function(){
			$('#modal_ajout').modal('show');
		},

		ChangerValeurVacataire:function(valeur, type){
			if(type == 'modif') this.modif.vacataire = valeur;
			if(type == 'crea') this.ajout.vacataire = valeur;
		},

		VerifDispoLogin:_.debounce(function(){
			var scope = this;

			$.ajax({
				url:"data.php?cas=verif_dispo_login",
				type:"POST",
				data:{login : scope.ajout.login},
				success:function(res){
					scope.verif_dispo_login = res;
				},
				error:function(){
				}
			});
		}, 600),

		AjouterUtilisateur:function(){
			if(this.ajout.nom == '' || this.ajout.prenom == '' || this.ajout.login == '' || this.ajout.password == ''){
				Notify('danger','Veuillez saisir les informations exigées !');
				return;
			}
			var scope = this;

			$.ajax({
				url:"data.php?cas=ajout_salarie",
				type:"POST",
				data:scope.ajout,
				success:function(res){
					if(res == -2) Notify('warning','Veuillez saisir les données exigées');
					if(res == -1) Notify('danger','Cet utilisateur existe déjà');
					if(res == 1) Notify('success',`Utilisateur ${scope.ajout.nom+' '+scope.ajout.prenom} créé`);
					scope.GetListeSalarie();
					$('#modal_ajout').modal('hide');
					scope.ajout.nom           = '';
					scope.ajout.prenom        = '';
					scope.ajout.login         = '';
					scope.ajout.password      = '';
					scope.ajout.vacataire     =  0;
					scope.ajout.date_validite = scope.date_du_jour;
				},
				error:function(){
				}
			});
		},

		OuvrirModalModif:function(elem){
			this.modif = JSON.parse(JSON.stringify(elem));
			this.ancien_login = elem.login;
			$('#modal_modif').modal('show');
		},
	},
	watch:{
		'ajout.login'(){
			if(this.ajout.login == '') this.verif_dispo_login = 0;
			if(this.ajout.login != '') this.VerifDispoLogin();
		},
	},
})