<?php
include '../functions.php';
if (getPanicStatus()['status'] == true) {
?>
    <script>
        var audio = new Audio('../assets/audio/panicActivate.mp3');
        audio.volume = 0.2;
        audio.play();
        // setTimeout(() => {
        //     var msg = new SpeechSynthesisUtterance('Unit activated panic button! Hold traffic.');
        //     var voices = window.speechSynthesis.getVoices();
        //     window.speechSynthesis.speak(msg);
        //     setTimeout(() => {
        //         var audio = new Audio('../assets/audio/panicActivate.mp3');
        //         audio.volume = 0.2;
        //         audio.play();
        //     }, 4000);	
        // }, 2000);
    </script>
    <ul id="buttons14" class="buttons">
        <li>
            <a class="button n01"><svg><use xlink:href="../assets/icons.svg#location"></use></svg><span class="label">Panic Button Pressed By: &#39;<?php echo getPanicStatus()['name']; ?>&#39;</span></a>
        </li>
    </ul>
<?php
}
?>