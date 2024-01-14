<?php

require_once 'Model/Lesson.php';
require_once 'Service/Config.php';
use App\Model\Lesson;


$l = new Lesson;
$lessons = $l->findAll();
?>
<h1>Lista Zajęć</h1>

<ul class="index-list">
    <?php foreach ($lessons as $lesson): ?>
        <li> <?= $lesson->getTitle() ?>
            <button onClick=document.location.href="<?='/Pages/lesson.html.php?id='.$lesson->getId()?>">
                START
            </button>
        </li>
    <?php endforeach; ?>
</ul>
