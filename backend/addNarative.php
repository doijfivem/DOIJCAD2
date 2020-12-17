<?php
include '../functions.php';

if(isset($_POST['callId'])) {
    if(isset($_POST['text'])) {
        if (!isDispatch()) {
            header('Location: /noauth');
        }
        $text = $_POST['text'];
        $callId = $_POST['callId'];
        $redir = $_POST['redir'];

        $sql = "SELECT * FROM calls WHERE id = $callId";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)) {
            $newNarrative = $row["narrative"] . "||&%&||<strong>" . $user->username . ":</strong> " . $text;

            $sql2 = "UPDATE calls SET narrative = '$newNarrative' WHERE id = $callId";
            $conn->query($sql2);
            header('Location: ' . $redir);
        }
    }
}
?>