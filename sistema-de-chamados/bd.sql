drop database if exists web20192chamados;
create database if not exists web20192chamados;

use web20192chamados;

-- DOWN
drop table if exists problems;
drop table if exists equipments;
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

create table equipments(
    id          int primary key auto_increment,
    equipment    varchar(255)
);

create table problems(
    id           int primary key auto_increment,
    user_id      int,
    equipment_id int,
    problem      text,
    created_at   timestamp default current_timestamp,
    foreign key (equipment_id) references equipments(id),
    foreign key (user_id) references users(id)
);

-- ENDUP

-- drop user if exists web20192chamados;
create user if not exists web20192chamados identified by 'web20192chamados';
grant all privileges on *.* to web20192chamados;