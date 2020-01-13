var Menu = new Vue({
	el:'#menu',
	data:{

	},
	methods:{
		Deconnexion:function(){
			var scope = this;

			$.ajax({
				url:RACINE_GLOBAL_RELATIF+"js/composants/menu/data.php?cas=deconnexion",
				type:"POST",
				datas:{},
				success:function(data){
					window.location.href = RACINE_GLOBAL_RELATIF+"login.php";
				},
				error:function(){
				}
			});
		},
	}
})