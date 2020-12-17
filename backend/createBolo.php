<?php
include '../functions.php';

if(isset($_POST['details'])) {
    if (!isDispatch()) {
        header('Location: /noauth');
    }
    $details = str_replace("'", "\'", $_POST['details']);
    $redir = $_POST['redir'];
    $date = date("d/m/Y");
    $time = date("h:i:sa");

    $sql2 = "INSERT INTO bolos (details,date,time) VALUES ('$details', '$date', '$time')";
    if ($conn->query($sql2) === TRUE) {
        header('Location: /dispatch/?c=' . $redir);
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        // header( 'Location: index.php');
    };
}
?>