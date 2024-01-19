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
} else {
    // Przycisk zaloguj jeśli nie
    echo "<button onclick=\"location.href='login.php'\">Zaloguj</button>";
}
    echo "<button onclick=\"location.href='index.php'\">Lista lekcji</button>";
?>
</nav>
<?php

$result = false;
// Pobieranie lekcji z bazy danych
if($_GET['action'] == 'edit'){
    $query = "SELECT * FROM lekcja WHERE id='{$_GET['id']}'";
    $result = $conn->query($query);
    $row = $result->fetchArray(SQLITE3_ASSOC);
}

if ($result || $_GET['action'] == 'add') {
    
    echo '<form action="edit.php" method="POST">';
    echo "<span>Tytuł:</span>";
    echo "<input name='lTytul' value='" . ($_GET['action'] == 'edit' ? $row['tytul'] : null) . "' >";
    echo "<span>Zawartość:</span>";
    echo "<textarea name='lTresc' class='letter'>" . ($_GET['action'] == 'edit' ? $row['tresc'] : null) . "</textarea>";
    echo "<button type='submit' name='lessonId' value=". ($_GET['action'] == 'edit' ? $row['id'] : null) .">Zatwierdź</button>";
    echo '</form>';  
} 

if(isset($_POST['lTytul']) && isset($_POST['lTresc'])){
    
    if(!empty($_POST['lessonId'])){
        $stmt = $conn->prepare("UPDATE lekcja SET tytul = :tytul, tresc = :tresc WHERE id = :lessonId");
        $stmt->bindValue(':tytul', $_POST['lTytul'], SQLITE3_TEXT);
        $stmt->bindValue(':tresc', $_POST['lTresc'], SQLITE3_TEXT);
        $stmt->bindValue(':lessonId', $_POST['lessonId'], SQLITE3_INTEGER);
        $stmt->execute();
        $stmt->close();
    }else{
        $stmt = $conn->prepare("INSERT INTO lekcja (tytul, tresc) VALUES (:tytul, :tresc)");
        $stmt->bindParam(':tytul', $_POST['lTytul'], SQLITE3_TEXT);
        $stmt->bindParam(':tresc', $_POST['lTresc'], SQLITE3_TEXT);
        $stmt->execute();
        $stmt->close();  
    }
    header("Location: index.php");
    exit();
}


?>



</body>
</html>
