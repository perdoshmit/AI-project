<?php
session_start();

// Jeśli użytkownik jest już zalogowany, przekieruj go na stronę główną
if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Obsługa formularza logowania
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once 'db_connection.php';

    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    // Zabezpieczenie przed SQL injection
    $login = $conn->escapeString($login);
    $haslo = $conn->escapeString($haslo);

    $query = "SELECT * FROM administrator WHERE login='$login' AND haslo='$haslo'";
    $result = $conn->query($query);

    if ($result) {
        if ($result->fetchArray(SQLITE3_ASSOC)) {
            // Poprawne logowanie, ustaw sesję i przekieruj na stronę główną
            $_SESSION['admin_id'] = true;
            header('Location: index.php');
            exit();
        } else {
            // Nieprawidłowe dane logowania
            $error = "Nieprawidłowy login lub hasło";
        }
    } else {
        // Błąd w zapytaniu
        $error = "Błąd w zapytaniu: " . $conn->lastErrorMsg();
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>

<h1>Zaloguj się</h1>

<?php
if (isset($error)) {
    echo "<p style='color: red;'>{$error}</p>";
}
?>

<form method="POST" action="">
    <label>Login: <input type="text" name="login" required></label><br>
    <label>Hasło: <input type="password" name="haslo" required></label><br>
    <button type="submit">Zaloguj</button>
</form>

</body>
</html>
