NB: a tout lire!!!
1.utilisation en mode local 

la creation de base de donné garage:

CREATE DATABASE if not exist garage

une fois la database créé vous pouvez crée des tables ou des classes 

USE garage //cette commande me permet d'utiliser la base de donné garage

la creation de table users:

CREATE TABLE users(
idUser int(11) AUTO_INCREMENT,
username varchar(50),
name varchar(50),
email varchar(255),
numero varchar(255),
pays varchar(255),
adress varchar(255),
passw varchar(255),
image varchar(255),
embaucher date,
PRIMARY KEY(idUser)
);

//nous allons inserer un utilisateur admin: le mot de passe est:482c811da5d5b4bc6d497ffa98491e38 et
l'admin doit avoir ID=1 dans la base de donnée enfin de tout gerer
le password en md5:482c811da5d5b4bc6d497ffa98491e38 est egale a password123, 
NB: une fois connecté 
1. modifier le mot de passe et la photo de profil de l'admin. 
2. enregistrez un utilisateur qui aura un ID=2 car c'est employé  gerera les reviews ou temoignages des visiteurs 
pour qu'ils soient visible sur la page d'accueil du site.

INSERT INTO `users`(`username`, `name`, `email`, `numero`, `pays`,`adress`, `passw`, `image`, `embaucher`) VALUES ('Vincent','Vincent Parrot','admin@gmail.com','+33756321569','france lyon','5 rue andré bollier','482c811da5d5b4bc6d497ffa98491e38','','20/20/1'); //vous pouvez modifier le details si dessus en mettant vos propre details 

// la creation des article:les articles sont postés par l'admin et les employés. 

CREATE TABLE item(
idItem int(11) AUTO_INCREMENT,
voiture varchar(20),
kilometre varchar(20),
annee varchar(20),
prix varchar(20),
image varchar(255),
description text,
emailUser varchar(50),   //cette clé email vas nous permetre de joindre la table item avec la table users nous allons utiliser l'email
entrer date,
PRIMARY KEY(idItem)   
)

//la creation de la table services dans le quel les services proposés par le garage seront modifier par l'administrateur:

CREATE TABLE services(
serviceid int(11) AUTO_INCREMENT,
service varchar(255),
description text,
annee date,
PRIMARY KEY(serviceid)   
)

// nous pouvons enregistrer le nouveau service dans la base de donnéé:

INSERT INTO `services`(`service`, `description`, `annee`) 
   VALUES ('type de service', 'notre description',NOW())";

// administrateur doit gerer les heures d'ouverture et de la fermeture du garage
creons une table HORAIRE,elles seront maintenu par l'administrateur:

CREATE TABLE horraire(
horraireid int(11) AUTO_INCREMENT,
jour varchar(20),
heureDebut time,
heureFin time,
mididebut time,
midifin time,
description text,
PRIMARY KEY(horraireid)
)

//pour creer le tableau de temoignages:ces sont les reviews de clients 
ils seront crées par les visiteurs et enregistré dans la base de données. 

CREATE TABLE temoignages(
idtemoignage int(11) AUTO_INCREMENT,
name varchar(20),
note int(11),
description text,
status varchar(10),
entry date,
PRIMARY KEY(idtemoignage)
)

//nous allons cree une table dans la quelle un client pourra contacter diretement l'admin en lui envoyant 
un message direct : ce genre de message sera vu et repondu par l'administrateur soit en contactant le visiteur 
par son numero de telephone ou par son mail. donc c'est un message direct utilisant la base de donnée

CREATE TABLE message(
idmessage int(11) AUTO_INCREMENT,
name varchar(100),
mail varchar(100),
numero varchar(20),
message text,
entry date,
status varchar(10),
item int(11),
PRIMARY KEY(idmessage)
)




