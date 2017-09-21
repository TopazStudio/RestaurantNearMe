create table cuisine
(
	id int(10) unsigned auto_increment
		primary key,
	Name varchar(191) not null,
	Type varchar(191) not null,
	Likes varchar(191) not null,
	DisLikes varchar(191) not null,
	restaurantId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

create index cuisine_restaurantid_foreign
	on cuisine (restaurantId)
;

create table migrations
(
	id int(10) unsigned auto_increment
		primary key,
	migration varchar(191) not null,
	batch int not null
)
;

create table password_resets
(
	email varchar(191) not null,
	token varchar(191) not null,
	created_at timestamp null
)
;

create index password_resets_email_index
	on password_resets (email)
;

create table pictures
(
	id int(10) unsigned auto_increment
		primary key,
	location varchar(191) not null,
	picturable_id int(10) unsigned not null,
	picturable_type varchar(191) not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

create index pictures_picturable_id_picturable_type_index
	on pictures (picturable_id, picturable_type)
;

create table restaurants
(
	id int(10) unsigned auto_increment
		primary key,
	Name varchar(191) not null,
	Location varchar(191) not null,
	Likes varchar(191) not null,
	DisLikes varchar(191) not null,
	managerId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

create index restaurants_managerid_foreign
	on restaurants (managerId)
;

alter table cuisine
	add constraint cuisine_restaurantid_foreign
		foreign key (restaurantId) references testdb.restaurants (id)
			on delete cascade
;

create table users
(
	id int(10) unsigned auto_increment
		primary key,
	name varchar(191) not null,
	email varchar(191) not null,
	password varchar(191) not null,
	role varchar(191) not null,
	remember_token varchar(100) null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint users_email_unique
		unique (email)
)
;

alter table restaurants
	add constraint restaurants_managerid_foreign
		foreign key (managerId) references testdb.users (id)
			on delete cascade
;

