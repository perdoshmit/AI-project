<?php
$databaseFile = 'db.sqlite';
//php -S localhost:8000

try {
    $conn = new SQLite3($databaseFile);

    // Tworzenie tabeli jeśli nie istnieją
    $conn->exec('CREATE TABLE IF NOT EXISTS administrator (
                    id INTEGER PRIMARY KEY,
                    login VARCHAR NOT NULL,
                    haslo VARCHAR NOT NULL
                )');


    $conn->exec('CREATE TABLE IF NOT EXISTS lekcja (
                    id INTEGER PRIMARY KEY,
                    tytul VARCHAR NOT NULL,
                    tresc VARCHAR NOT NULL
                )');
} catch (Exception $e) {
    die('Nie udało się połączyć z bazą danych: ' . $e->getMessage());
}
?>
