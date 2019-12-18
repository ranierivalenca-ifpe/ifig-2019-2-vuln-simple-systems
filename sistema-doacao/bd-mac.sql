drop database if exists web20192doacoes;
create database if not exists web20192doacoes;

use web20192doacoes;

-- DOWN
drop table if exists descriptions;
drop table if exists items;
drop table if exists users;
-- ENDDOWN

-- UP
create table users(
    id          int primary key auto_increment,
    name        varchar(255),
    username    varchar(255),
    email       varchar(255),
    password    varchar(255),
    admin       boolean
);

create table items(
    id      int primary key auto_increment,
    item    varchar(255)
);

create table descriptions(
    id           int primary key auto_increment,
    user_id      int,
    item_id      int,
    description  text,
    created_at   timestamp default current_timestamp,
    foreign key (item_id) references items(id),
    foreign key (user_id) references users(id)
);

-- ENDUP

-- drop user if exists web20192doacoes;
create user if not exists web20192doacoes identified with mysql_native_password by 'web20192doacoes';
grant all privileges on *.* to web20192doacoes;
