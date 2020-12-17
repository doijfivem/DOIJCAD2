<?php
include '../functions.php';
$server = get('s');
if (getPanicStatus($server)['status'] == true) {
    echo '<script>
        var audio = new Audio("../assets/audio/panicActivate.mp3");
        audio.volume = 0.2;
        audio.play();
    </script>
    <ul id="buttons14" class="buttons">
        <li>
            <a class="button n01"><svg><use xlink:href="../assets/icons.svg#location"></use></svg><span class="label">Panic Button Pressed By: &#39;' . getPanicStatus()["name"] . '&#39;</span></a>
        </li>
    </ul>';
}
?>