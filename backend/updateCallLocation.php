<?php
include '../functions.php';

if(isset($_POST['callId'])) {
    if(isset($_POST['location'])) {
        if (!isDispatch()) {
            header('Location: /noauth');
        }
        $location = $_POST['location'];
        $callId = $_POST['callId'];
        $redir = $_POST['redir'];
        $sql2 = "UPDATE calls SET location = '$location' WHERE id = $callId";
        $conn->query($sql2);
        header('Location: ' . $redir);
    }
}
?>