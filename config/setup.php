<?php

require "./database.php";

/*
try {
	$pdo = new PDO('mysql:host=localhost;port=3306;charset=utf8;', $DB_USER, $DB_PASSWORD);
} catch (PDOException $exception) {
	print "Error : " . $exception->getMessage() . ".";
	return (false);
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = 'CREATE DATABASE IF NOT EXISTS camagru';

$stmt = $pdo->prepare($query);
$query = $stmt->execute();

$pdo = NULL;
*/

try {
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
} catch (PDOException $exception) {
	print "Error : " . $exception->getMessage() . ".";
	return (false);
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Creation of users' table

$query = 'CREATE TABLE IF NOT EXISTS users
	(id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255),
	surname VARCHAR(255),
	mail VARCHAR(255) NOT NULL,
	login VARCHAR(255) NOT NULL,
	passwd VARCHAR(128) NOT NULL,
	date_creation DATETIME NOT NULL);';

$stmt = $pdo->prepare($query);
$query = $stmt->execute();

// Creation of comments' table

$query = 'CREATE TABLE IF NOT EXISTS comments
	(id INT PRIMARY KEY AUTO_INCREMENT,
	id_img INT NOT NULL,
	comment TEXT NOT NULL,
	login VARCHAR(255) NOT NULL,
	date_creation DATETIME NOT NULL)';

$stmt = $pdo->prepare($query);
$query = $stmt->execute();

// Creation of likes' table

$query = 'CREATE TABLE IF NOT EXISTS likes
	(id INT PRIMARY KEY AUTO_INCREMENT,
	id_img INT NOT NULL,
	login VARCHAR(255) NOT NULL,
	date_creation DATETIME NOT NULL);';

$stmt = $pdo->prepare($query);
$query = $stmt->execute();

// Creation of images' table

$query = 'CREATE TABLE IF NOT EXISTS imgs
	(id INT PRIMARY KEY AUTO_INCREMENT,
	login VARCHAR(255) NOT NULL,
	number_likes INT DEFAULT 0,
	number_comments INT DEFAULT 0,
	date_creation DATETIME NOT NULL);';

$stmt = $pdo->prepare($query);
$query = $stmt->execute();

$pdo = NULL;

// Creation of images' folder

$imgFolder = "../database";

if (!file_exists($imgFolder))
	mkdir("../database", 0777, true);


?>
