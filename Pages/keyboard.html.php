
<head>
    <link rel="stylesheet" href="../Styles/keyboard.css">
</head>

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

<script src="../Scripts/keyboard.js"></script>


