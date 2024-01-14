<?php

require_once '../Model/Lesson.php';
require_once '../Service/Config.php';
use App\Model\Lesson;
$l = new Lesson();
$lesson = $l->find($_GET['id']);
$title = "{$lesson->getTitle()} ({$lesson->getId()})";
$bodyClass = 'show';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../Styles/lesson.css">
</head>
<body>
    <h1><?= $lesson->getTitle()?></h1>
    <article id="lesson-content">
        <?php
        $content = $lesson->getContent();
        for ($i=0; $i<strlen($content); $i++):
            ?>
            <span class="letter"><?=$content[$i]?></span>
        <?php endfor; ?>
    </article>
    <input type="text" id="input">
    <div><?php require('keyboard.html.php') ?></div>
    <button onClick=document.location.href="../index.php">
        BACK
    </button>
    <script src="../Scripts/typed.js"></script>

</body>
</html>
