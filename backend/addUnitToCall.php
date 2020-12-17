<?php
include '../functions.php';

if(isset($_POST['callId'])) {
    if(isset($_POST['name'])) {
        if (!isDispatch()) {
            header('Location: /noauth');
        }
        $name = explode("---", $_POST['name']);
        $nameBoi = $name[0];
        $nameId = $name[1];
        $callId = $_POST['callId'];
        $redir = $_POST['redir'];

        $sql = "SELECT * FROM calls WHERE id = $callId";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)) {
            $newAttach = $row["attachedUnits"] . "||&%&||" . $nameId;

            $sql2 = "UPDATE calls SET attachedUnits = '$newAttach' WHERE id = $callId";
            $conn->query($sql2);

            $newNarrative = $row["narrative"] . "||&%&||<strong>" . $user->username . ":</strong> Attached $nameBoi to call.";

            $sql3 = "UPDATE calls SET narrative = '$newNarrative' WHERE id = $callId";
            $conn->query($sql3);

            header('Location: ' . $redir);
        }
    }
}
?>