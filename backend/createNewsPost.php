<?php
include '../functions.php';

if(isset($_POST['post'])) {
    $postOld = $_POST['post'];
    $post = str_replace("'", "\'", $postOld);
    $day = getdate()["mday"];
    $month = getdate()["month"];
    $year = getdate()["year"];
    if (!isStaff(0)) {
        header('Location: /noauth');
    }

    $sql2 = "INSERT INTO news (date,details) VALUES ('$day $month $year', '$post')";
    if ($conn->query($sql2) === TRUE) {
        header('Location: /staff/newssettings');
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        // header( 'Location: index.php');
    };
}
?>