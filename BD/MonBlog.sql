/* Testé sous MySQL 5.x */

drop table if exists T_COMMENTAIRE cascade;
drop table if exists T_BILLET cascade;
drop table if exists T_UTILISATEUR cascade;

/*alter table*/



create table T_BILLET (
  BIL_ID integer primary key auto_increment,
  BIL_DATE datetime not null,
  BIL_TITRE varchar(100) not null,
  BIL_CONTENU varchar(3000) not null
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

create table T_COMMENTAIRE (
  COM_ID integer primary key auto_increment,
  COM_DATE datetime not null,
  COM_AUTEUR varchar(100) not null,
  COM_CONTENU varchar(200) not null,
  BIL_ID integer not null,
  COM_FLAG int(1) not null,
  constraint fk_com_bil foreign key(BIL_ID) references T_BILLET(BIL_ID)
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;


create table T_UTILISATEUR (
  UTIL_ID integer primary key auto_increment,
  UTIL_LOGIN varchar(100) not null,
  UTIL_MDP varchar(100) not null
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;


insert into T_BILLET(BIL_DATE, BIL_TITRE, BIL_CONTENU) values
(NOW(), 'Premier billet', 'Bonjour monde ! Ceci est le premier billet sur mon blog.');
insert into T_BILLET(BIL_DATE, BIL_TITRE, BIL_CONTENU) values
(NOW(), 'Au travail', 'Il faut enrichir ce blog dès maintenant.');

insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID, COM_FLAG) values
(NOW(), 'A. Nonyme', 'Bravo pour ce début', 1, 0);
insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID, COM_FLAG) values
(NOW(), 'Moi', 'Merci ! Je vais continuer sur ma lancée', 1, 0);

insert into T_UTILISATEUR(UTIL_LOGIN, UTIL_MDP) values
('admin', '$2y$10$Ml.NiP30.8RsdnwembzzmegXvcpYZHVg2pAb/uTp6e8otw9laQ6Z.');