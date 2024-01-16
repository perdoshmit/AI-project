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
    <link rel="stylesheet" href="styles/lesson.css">
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
echo "<script>var lessonId = {$_GET['id']};</script>";
// Pobieranie lekcji z bazy danych
$query = "SELECT * FROM lekcja WHERE id='{$_GET['id']}'";
$result = $conn->query($query);


if ($result) {
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<h1>{$row['tytul']}</h1>";

        for($i=0; $i<strlen($row['tresc']); $i++){
            echo "<span class='letter'>{$row['tresc'][$i]}</span>";
        }
        echo '<input type="text" id="input">';
    
    }
} 

?>

<div class="keyboard" id="keyboard">
    <?php
    $keys = [
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
        'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P',
        'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L',
        'Z', 'X', 'C', 'V', 'B', 'N', 'M'
    ];
    echo '<div class="row">';
    foreach ($keys as $key) {
        if($key == "Q" or $key == "A" or $key == "Z" ){
            echo '</div> <div class="row">';
        }
        echo '<div class="key" data-key="' . $key . '">' . $key . '</div>';
    }
    echo '</div> <div class="row"> <div class="key space" data-key=" "></div></div>';
    ?>
</div>

<script src="scripts/lesson.js"></script>

</body>
</html>
