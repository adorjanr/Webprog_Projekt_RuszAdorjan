<?php

$servername = "localhost";
$username = "root";
$password = "";

// Kapcsolódás MySQL szerverhez
$conn = new mysqli($servername, $username, $password);

// Kapcsolat ellenőrzése
if (!$conn->connect_error) {
	echo "Sikeres csatlakozás<br>";
} else {
    die("Kapcsolódási hiba: $conn->connect_error");
}

// Adatbázis létrehozása
$sql = "CREATE DATABASE IF NOT EXISTS library";
if ($conn->query($sql)) {
    echo "Az adatbázis sikeresen létrehozva<br>";
} else {
    echo "Hiba az adatbázis létrehozásakor: $conn->error<br>";
}

// Adatbázis kiválasztása
$conn->select_db("library");

// Tábla létrehozása
$sql = "CREATE TABLE IF NOT EXISTS books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    author VARCHAR(64) NOT NULL,
    title VARCHAR(128) NOT NULL,
	genre VARCHAR(32) NOT NULL,
	available INT DEFAULT 5
)";
if ($conn->query($sql)) {
    echo "A books tábla sikeresen létrehozva<br>";
} else {
    echo "Hiba a tábla létrehozásakor: $conn->error<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql)) {
    echo "A users tábla sikeresen létrehozva<br>";
} else {
    echo "Hiba a tábla létrehozásakor: $conn->error<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    book_id INT NOT NULL,
    user_id INT NOT NULL,
	FOREIGN KEY (book_id) REFERENCES books(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
)";
if ($conn->query($sql)) {
    echo "A users tábla sikeresen létrehozva<br>";
} else {
    echo "Hiba a tábla létrehozásakor: $conn->error<br>";
}

// Kapcsolat lezárása
$conn->close();
echo "A setup script sikeresen lefutott!<br>";
