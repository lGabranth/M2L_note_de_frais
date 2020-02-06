Dictionnaire des données
========================

* **Structure de la table `utilisateur`**
	- id : -
	- nom, prenom : Minimum de données personnelles afin de s'assurer de l'identité de la personne
	- login, password : Informations de connexion
	- vacataire : 0 signifie qu'il s'agit d'un salarié, 1 signifie qu'il s'agit d'une vacataire
	- date_validite : Pas pris en compte pour les salariés en CDI, date à partir de laquelle les vacataires ne peuvent plus se connecter à l'interface
	- id_groupe_utilisateur : Permet de faire le lien et savoir à quel type d'utilisateur le profil appartient (admin, directeur, salarié/vacataire)
* **Structure de la table `groupe_utilisateur`**
	- id : -
	- groupe_utilisateur : Dénomination (Administrateur, Directeur de Ligue, Salarié)
* **Structure de la table `type_note_de_frais`**
	- id : - 
	- type_note_de_frais : Dénomination (Essence, Hotel, Restaurant, etc..)
* **Structure de la table `etat_note_de_frais`**
	- id : - 
	- etat_note_de_frais : Dénomination (En cours de traitement, acceptée, refusée, etc..)
* **Structure de la table `note_de_frais`**
	- id : - 
	- libelle : Dénomination de la note de frais
	- path_image : Contient le chemin vers le fichier prouvant la note de frais
	- id_utilisateur : id de l'utilisateur auteur de la NDF
	- montant : Montant de la NDF
	- id_type_note_de_frais : id du type de note de frais
	- id_etat_note_de_frais : Atteste de l'état de la NDF