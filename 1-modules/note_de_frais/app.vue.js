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

        OuvrirPhoto:function(){
            $('#modal_photo').modal('show');
        },
    },
})