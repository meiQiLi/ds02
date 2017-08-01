create database if not exists 'ds02';
use 'ds02';

--管理员表
drop table if exists 'food_admin';
create table 'food_admin'(
'id' tinyint unsigned auto_increment key,
'username' varchar(20) not null unique,
'password' char(32) not null,
'email' varchar(50) not null
);


--分类表
drop table if exists 'food_cate';
create table 'food_cate'(
'id' smallint unsigned auto_increment key,
'cName' varchar(50) unique
);


--商品表
drop table if exists 'food_pro';
create table 'food_pro'(
'id' int unsigned auto_increment key,
'pName' varchar(50) not null unique,
'pSn' varchar(50) not null,
'pNum' int unsigned default 1,
'mPrice' decimal(10,2) not null,
'pDesc' text,
'pImg' varchar(50) not null,
'pubTime' int unsigned not null,
'isShow' tinyint(1) default 1,
'isHot' tinyint(1) default 0,
'cId' smallint unsigned not null
);


--用户表
drop table if exists 'food_user';
create table 'food_user'(
'id' int unsigned auto_increment key,
'username' varchar(20) not null unique,
'password' char(32) not null,
'regTime' int unsigned not null
);


--相册表
drop table if exists 'food_album';
create table 'food_album'(
'id' int unsigned auto_increment key,
'pid' int unsigned not null,
'albumPath' varchar(50) not null
);













