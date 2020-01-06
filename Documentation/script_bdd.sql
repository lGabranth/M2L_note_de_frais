#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: groupe_utilisateur
#------------------------------------------------------------

CREATE TABLE groupe_utilisateur(
        id                 Int  Auto_increment  NOT NULL ,
        groupe_utilisateur Varchar (50) NOT NULL
	,CONSTRAINT groupe_utilisateur_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        id                    Int  Auto_increment  NOT NULL ,
        nom                   Varchar (50) NOT NULL ,
        prenom                Varchar (50) NOT NULL ,
        login                 Varchar (50) NOT NULL ,
        password              Varchar (50) NOT NULL ,
        vacataire             TinyINT NOT NULL ,
        date_validite         Datetime NOT NULL ,
        id_groupe_utilisateur Int NOT NULL
	,CONSTRAINT utilisateur_PK PRIMARY KEY (id)

	,CONSTRAINT utilisateur_groupe_utilisateur_FK FOREIGN KEY (id_groupe_utilisateur) REFERENCES groupe_utilisateur(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type_note_de_frais
#------------------------------------------------------------

CREATE TABLE type_note_de_frais(
        id                 Int  Auto_increment  NOT NULL ,
        type_note_de_frais Varchar (50) NOT NULL
	,CONSTRAINT type_note_de_frais_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: etat_note_de_frais
#------------------------------------------------------------

CREATE TABLE etat_note_de_frais(
        id                 Int  Auto_increment  NOT NULL ,
        etat_note_de_frais Varchar (50) NOT NULL
	,CONSTRAINT etat_note_de_frais_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: note_de_frais
#------------------------------------------------------------

CREATE TABLE note_de_frais(
        id                    Int  Auto_increment  NOT NULL ,
        path_image            Varchar (50) NOT NULL ,
        commentaire           Varchar (50) NOT NULL ,
        montant               Double NOT NULL ,
        id_utilisateur        Int NOT NULL ,
        id_type_note_de_frais Int NOT NULL ,
        id_etat_note_de_frais Int NOT NULL
	,CONSTRAINT note_de_frais_PK PRIMARY KEY (id)

	,CONSTRAINT note_de_frais_utilisateur_FK FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
	,CONSTRAINT note_de_frais_type_note_de_frais0_FK FOREIGN KEY (id_type_note_de_frais) REFERENCES type_note_de_frais(id)
	,CONSTRAINT note_de_frais_etat_note_de_frais1_FK FOREIGN KEY (id_etat_note_de_frais) REFERENCES etat_note_de_frais(id)
)ENGINE=InnoDB;

