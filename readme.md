NB: a tout lire!!! et ne modifier aucune lettre etc... copier les comme ils sont !!!

1.utilisation en mode local 
Nb: tout sur ce site est basé sur la base de donné vous trouverai au debut que le site est vide.
voici les clés pour se connecter a la base de donnée local :
$dsn = 'mysql:host=localhost;dbname=garage';
$username = 'root';
$password = getenv('');
---------------------------------------------------------------------------------------------
2. ce que vous devez faire pour bien utiliser ce site:

-la creation de la base de donné garage:

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

voici le code sql en mode local pour enregistrer un admin:

INSERT INTO `users`(`username`, `name`, `email`, `numero`, `pays`,`adress`, `passw`, `image`, `embaucher`) VALUES ('Vincent','Vincent Parrot','admin@gmail.com','+33756321569','france lyon','5 rue andré bollier','482c811da5d5b4bc6d497ffa98491e38','','20/20/1'); 
//vous pouvez modifier le details si dessus en mettant vos propre details


NB: une fois enregistrer et dont connectez vous.
 le contact et l'adress de l'admin sera afficher sur le pieds de toute les pages.
 il faut que l'admin puisse avoir le id ==1 


1. modifier le mot de passe et la photo de profil de l'admin. 
2. enregistrez un utilisateur qui aura un ID=2 car c'est employé  gerera les reviews ou temoignages des visiteurs 
pour qu'ils soient visible sur la page d'accueil du site.

-----------------------------------------------------------------------------------------

// la creation des article:les articles sont postés par l'admin et les employés. 

CREATE TABLE item(
idItem int(11) AUTO_INCREMENT,
voiture varchar(20),
kilometre varchar(20),
annee varchar(20),
prix varchar(20),
image varchar(255),
description text,
emailUser varchar(50),   
//cette clé email vas nous permetre de joindre la table item avec la table users nous allons utiliser l'email
entrer date,
PRIMARY KEY(idItem)   
)
---------------------------------------------------------------------------------------
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

-------------------------------------------------------------------------------------
// administrateur doit gerer les heures d'ouverture et de la fermeture du garage
creons une table HORAIRE,elles seront maintenu par l'administrateur:
NB: ne modifier aucune lettre ou aucun mot copier comme vous voyez

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

---------------------------------------------------------------------------------
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

----------------------------------------------------------------------------------------------------
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

le site utilise un systeme de messagerie direct et l'admin s'en occupera  




