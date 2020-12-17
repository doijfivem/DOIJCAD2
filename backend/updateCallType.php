<?php
include '../functions.php';

if(isset($_POST['callId'])) {
    if(isset($_POST['type'])) {
        if (!isDispatch()) {
            header('Location: /noauth');
        }
        $type = $_POST['type'];
        $callId = $_POST['callId'];
        $redir = $_POST['redir'];
        $sql2 = "UPDATE calls SET callType = '$type' WHERE id = $callId";
        $conn->query($sql2);
        header('Location: ' . $redir);
    }
}
?>