create database fantacalcio;
use fantacalcio;

create table user(
id INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
name nnvarchar(64) not null,
surname nnvarchar(64) not null,
email nnvarchar(128) not null,
credits int default (1000));

create table team(
id INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
id_user int UNSIGNED NOT NULL,
name nvarchar(64),
points int default(0)
);

ALTER TABLE fantacalcio.team 
ADD CONSTRAINT FK_user
FOREIGN KEY (id_user) REFERENCES fantacalcio.user(id);

create table football_player(
id INT UNSIGNED NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
name nvarchar(64),
team nvarchar(64),
role nvarchar(64),
quotation nvarchar(10),
midfielder nvarchar(10)
);

create table squad(
id_team int unsigned not null,
id_foot int unsigned not null
);

alter table squad add constraint fk_team foreign key (id_team) references team(id);
alter table squad add constraint fk_foot foreign key (id_foot) references football_player(id);
alter table squad add constraint pk_tf primary key (id_team,id_foot);


create table day(
id int unsigned  AUTO_INCREMENT  PRIMARY key,
description nvarchar(70),
game_date date,
played bool default(false)
);

create table game(
id_day int unsigned not null,
id_team1 int unsigned not null,
id_team2 int unsigned not null,
points_p1 int default(0),
points_p2 int default(0)
);

alter table game add constraint fk_day foreign key (id_day) references day(id);
alter table game add constraint fk_team1 foreign key (id_team1) references team(id);
alter table game add constraint fk_team2 foreign key (id_team2) references team(id);
alter table game add constraint pk primary key (id_day, id_team1, id_team2);

create table formation(
id_gameDay int unsigned not null,
id_foot int unsigned not null,
id_team int unsigned not null,
points int default (0)
);

alter table formation add constraint fk_game foreign key (id_gameDay) references game(id_day);
alter table formation add constraint fk_foot2 foreign key (id_foot) references football_player(id);
alter table formation add constraint fk_team3 foreign key (id_team) references team(id);
alter table formation add constraint pk_form primary key (id_gameDay, id_foot, id_team);


alter table user add column psw nvarchar(100) not null;
alter table user add column active bool default(1) not null ;
