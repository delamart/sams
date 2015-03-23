-- SQL for an sqlite database

BEGIN TRANSACTION;
CREATE TABLE "vtype" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	`name`	TEXT NOT NULL,
	`license_id`	INTEGER,
	`license_trailer_id`	INTEGER
);

CREATE TABLE "vehicle" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	`vtype_id`	INTEGER NOT NULL,
	`number`	TEXT NOT NULL
);

CREATE TABLE `user` (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	`username`	TEXT UNIQUE,
	`password`	TEXT,
	`name`	TEXT
);

CREATE TABLE "rank" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	`order`	INTEGER NOT NULL,
	`short_name`	TEXT NOT NULL,
	`name`	TEXT NOT NULL UNIQUE
);

CREATE TABLE "personelgroup" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`short_name`	TEXT NOT NULL,
	`name`	TEXT NOT NULL
);

CREATE TABLE `personelcheck` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`name`	TEXT NOT NULL,
	`description`	TEXT NOT NULL
);

CREATE TABLE `personel_has_personelcheck` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`personel_id`	INTEGER NOT NULL,
	`personelcheck_id`	INTEGER NOT NULL
);

CREATE TABLE "personel_has_license" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`personel_id`	INTEGER NOT NULL,
	`license_id`	INTEGER NOT NULL
);

CREATE TABLE "personel" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`rank_id`	INTEGER NOT NULL,
	`name`	TEXT NOT NULL,
	`group_id`	INTEGER NOT NULL,
	`tel`	TEXT,
	`discharged`	INTEGER
);

CREATE TABLE "mission" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	`vehicle_id`	INTEGER,
	`personel_id`	INTEGER,
	`summary`	TEXT NOT NULL,
	`description`	INTEGER NOT NULL,
	`start`	INTEGER,
	`end`	INTEGER,
	`load`	TEXT,
	`origin`	TEXT,
	`destination`	TEXT,
	`contact_name`	TEXT,
	`contact_tel`	TEXT
);

CREATE TABLE "license" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`name`	TEXT NOT NULL,
	`description`	TEXT NOT NULL,
	`trailer`	INTEGER NOT NULL DEFAULT 0
);

-- user: admin, password: admin
INSERT INTO `user` VALUES (1,'admin','$2y$10$c43KXQitkGUYI/7Wc6P9xumWjEc3.35I9ysIbTQURMa8iKMoYrkfG','Admin');

COMMIT;
