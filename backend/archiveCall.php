<?php
include '../functions.php';

if(get('callId')) {
    $callId = get('callId');
    $redir = get('redir');
    if (!isDispatch()) {
        header('Location: /noauth');
    }
        $sql2 = "UPDATE calls SET closed = 1 WHERE id = " . $callId . "";
        $conn->query($sql2);
        header('Location: ' . $redir);
}
?>