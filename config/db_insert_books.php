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

// Adatbázis kiválasztása
$conn->select_db("library");

// Könyvek hozzáadása
$sql = 'INSERT INTO books (author, title, genre) VALUES
	("William Shakespeare", "Hamlet", "Tragedy"),
	("William Shakespeare", "Macbeth", "Tragedy"),
	("William Shakespeare", "Romeo and Juliet", "Romance"),
	("William Shakespeare", "Othello", "Tragedy"),
	("William Shakespeare", "A Midsummer Night\'s Dream", "Comedy"),

	("Agatha Christie", "Murder on the Orient Express", "Mystery"),
	("Agatha Christie", "The Murder of Roger Ackroyd", "Mystery"),
	("Agatha Christie", "And Then There Were None", "Mystery"),
	("Agatha Christie", "Death on the Nile", "Mystery"),
	("Agatha Christie", "The ABC Murders", "Mystery"),

	("Barbara Cartland", "A Hazard of Hearts", "Romance"),
	("Barbara Cartland", "The Secret of the Forest", "Romance"),
	("Barbara Cartland", "The Duke and the Preacher\'s Daughter", "Romance"),
	("Barbara Cartland", "The Love of a Princess", "Romance"),
	("Barbara Cartland", "The Reluctant Heiress", "Romance"),

	("Danielle Steel", "The Promise", "Romance"),
	("Danielle Steel", "The Ghost", "Romance"),
	("Danielle Steel", "Palomino", "Romance"),
	("Danielle Steel", "Zoya", "Fiction"),
	("Danielle Steel", "Safe Harbour", "Romance"),

	("Harold Robbins", "The Carpetbaggers", "Drama"),
	("Harold Robbins", "A Stone for Danny Fisher", "Drama"),
	("Harold Robbins", "The Dream Merchants", "Drama"),
	("Harold Robbins", "Where Love Has Gone", "Drama"),
	("Harold Robbins", "The Inheritors", "Drama"),

	("Georges Simenon", "The Man Who Watched Trains Go By", "Thriller"),
	("Georges Simenon", "The Inspector Maigret Series", "Crime"),
	("Georges Simenon", "The Strangers in the House", "Thriller"),
	("Georges Simenon", "The Saint-Fiacre Affair", "Crime"),
	("Georges Simenon", "The Blue Room", "Crime"),

	("Enid Blyton", "Famous Five: Five on a Treasure Island", "Children\'s"),
	("Enid Blyton", "The Secret Seven", "Children\'s"),
	("Enid Blyton", "Malory Towers", "Children\'s"),
	("Enid Blyton", "The Magic Faraway Tree", "Children\'s"),
	("Enid Blyton", "Noddy in Toyland", "Children\'s"),

	("J. K. Rowling", "Harry Potter and the Sorcerer\'s Stone", "Fantasy"),
	("J. K. Rowling", "Harry Potter and the Chamber of Secrets", "Fantasy"),
	("J. K. Rowling", "Harry Potter and the Prisoner of Azkaban", "Fantasy"),
	("J. K. Rowling", "Harry Potter and the Goblet of Fire", "Fantasy"),
	("J. K. Rowling", "Harry Potter and the Deathly Hallows", "Fantasy"),

	("Sidney Sheldon", "Master of the Game", "Thriller"),
	("Sidney Sheldon", "The Other Side of Midnight", "Thriller"),
	("Sidney Sheldon", "If Tomorrow Comes", "Thriller"),
	("Sidney Sheldon", "Rage of Angels", "Thriller"),
	("Sidney Sheldon", "Bloodline", "Thriller"),

	("Eiichiro Oda", "One Piece: Romance Dawn", "Adventure"),
	("Eiichiro Oda", "One Piece: Alabasta", "Adventure"),
	("Eiichiro Oda", "One Piece: Water 7", "Adventure"),
	("Eiichiro Oda", "One Piece: Dressrosa", "Adventure"),
	("Eiichiro Oda", "One Piece: Whole Cake Island", "Adventure"),

	("Gilbert Patten", "Frank Merriwell Series", "Fiction"),
	("Gilbert Patten", "The Football Follies of Frank Merriwell", "Fiction"),
	("Gilbert Patten", "Frank Merriwell at Yale", "Fiction"),
	("Gilbert Patten", "The Great Football Game", "Fiction"),
	("Gilbert Patten", "Frank Merriwell\'s First Year", "Fiction"),

	("Tom Clancy", "The Hunt for Red October", "Thriller"),
	("Tom Clancy", "Patriot Games", "Thriller"),
	("Tom Clancy", "Clear and Present Danger", "Thriller"),
	("Tom Clancy", "The Sum of All Fears", "Thriller"),
	("Tom Clancy", "Rainbow Six", "Thriller"),

	("Dr. Seuss", "The Cat in the Hat", "Children\'s"),
	("Dr. Seuss", "Green Eggs and Ham", "Children\'s"),
	("Dr. Seuss", "How the Grinch Stole Christmas", "Children\'s"),
	("Dr. Seuss", "Horton Hears a Who!", "Children\'s"),
	("Dr. Seuss", "One Fish Two Fish Red Fish Blue Fish", "Children\'s"),

	("Akira Toriyama", "Dragon Ball Z: Saiyan Saga", "Action"),
	("Akira Toriyama", "Dragon Ball Z: Frieza Saga", "Action"),
	("Akira Toriyama", "Dragon Ball: Pilaf Saga", "Adventure"),
	("Akira Toriyama", "Dr. Slump", "Comedy"),
	("Akira Toriyama", "Dragon Ball Z: Cell Saga", "Action"),

	("Leo Tolstoy", "War and Peace", "Fiction"),
	("Leo Tolstoy", "Anna Karenina", "Fiction"),
	("Leo Tolstoy", "Resurrection", "Fiction"),
	("Leo Tolstoy", "The Cossacks", "Fiction"),
	("Leo Tolstoy", "Family Happiness", "Fiction"),

	("Corín Tellado", "Un amor en la sombra", "Romance"),
	("Corín Tellado", "El amor es más fuerte", "Romance"),
	("Corín Tellado", "La casa del amor", "Romance"),
	("Corín Tellado", "Sueños en la arena", "Romance"),
	("Corín Tellado", "Todo por amor", "Romance"),

	("Dean Koontz", "Watchers", "Thriller"),
	("Dean Koontz", "Odd Thomas", "Thriller"),
	("Dean Koontz", "Phantoms", "Horror"),
	("Dean Koontz", "Intensity", "Thriller"),
	("Dean Koontz", "The Darkest Evening of the Year", "Thriller"),

	("Jackie Collins", "Hollywood Wives", "Drama"),
	("Jackie Collins", "Lucky", "Drama"),
	("Jackie Collins", "Chances", "Drama"),
	("Jackie Collins", "The Bitch", "Drama"),
	("Jackie Collins", "Lady Boss", "Drama"),

	("Horatio Alger", "Ragged Dick", "Adventure"),
	("Horatio Alger", "The Young Acrobat", "Adventure"),
	("Horatio Alger", "The Store Boy", "Adventure"),
	("Horatio Alger", "Paul the Peddler", "Adventure"),
	("Horatio Alger", "The Cash Boy", "Adventure"),

	("Nora Roberts", "Vision in White", "Romance"),
	("Nora Roberts", "The Bride Quartet Series", "Romance"),
	("Nora Roberts", "The Search", "Romance"),
	("Nora Roberts", "The Witness", "Romance"),
	("Nora Roberts", "Hidden Riches", "Romance")';
if ($conn->query($sql)) {
    echo "Az könyvek sikeresen hozzáadva<br>";
} else {
    echo "Hiba az adatbázis létrehozásakor: $conn->error<br>";
}

// Kapcsolat lezárása
$conn->close();
echo "A setup script sikeresen lefutott!<br>";
