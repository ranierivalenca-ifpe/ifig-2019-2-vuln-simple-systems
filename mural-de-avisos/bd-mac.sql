drop database if exists web20192mural;
create database if not exists web20192mural;

use web20192mural;

-- DOWN
drop table if exists messages;
drop table if exists categories;
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

create table categories(
    id          int primary key auto_increment,
    category    varchar(255)
);

create table messages(
    id          int primary key auto_increment,
    user_id     int,
    category_id int,
    message     text,
    created_at  timestamp default current_timestamp,
    foreign key (category_id) references categories(id),
    foreign key (user_id) references users(id)
);

-- ENDUP

-- drop user if exists web20192mural;
create user if not exists web20192mural identified with mysql_native_password by 'web20192mural';
grant all privileges on *.* to web20192mural;