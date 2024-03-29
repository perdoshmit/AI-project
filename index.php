<?php
session_start();

// wylogowywanie + kończenie sesji
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}

// wywołanie połączenia z bazą
require_once 'db_connection.php';

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dream-Team</title>
</head>
<body>
<nav>

<?php
// Sprawdzanie, czy użytkownik jest zalogowany
if (isset($_SESSION['admin_id']) && $_SESSION['admin_id']) {
    // Przycisk Wyloguj jeśli tak
    echo "<form method='post' action=''>
            <button type='submit' name='logout'>Wyloguj</button>
          </form>";
 
    // echo "<button onclick=document.location.href='addLesson.php'>Dodaj lekcję</button>";
    echo "<button onClick=document.location.href='edit.php?&action=add'>Dodaj lekcję</button>";
} else {
    // Przycisk zaloguj jeśli nie
    echo "<button onclick=\"location.href='login.php'\">Zaloguj</button>";
}
?>

</nav>
<h1>Lista lekcji</h1>

<?php

// Pobieranie lekcji z bazy danych
$query = "SELECT * FROM lekcja";
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<p>ID: {$row['id']} - Tytuł: {$row['tytul']}</p>";
        // echo "<button onclick='executeLesson({$row['id']})'>Wykonaj</button>";
        echo "<button onClick=document.location.href='lesson.php?id={$row['id']}'>Wykonaj</button>";

        // Sprawdzanie, czy użytkownik jest zalogowany
        if (isset($_SESSION['admin_id']) && $_SESSION['admin_id']) {
            // Przyciski  administratora
            echo "<button onClick=document.location.href='edit.php?id={$row['id']}&action=edit'>Edytuj</button>";
            echo "<button onclick='deleteLesson({$row['id']})'>Usuń</button>";
        } 
        
        
    }
}

?>

<!-- !!!!!!!!!! przenieść do pliku scripts/script.js !!!!!!!!!!!!-->
<script>
    

    function deleteLesson(id) {
        // Logika usuwania lekcji
        // ...
    }

    
</script>

</body>
</html>
