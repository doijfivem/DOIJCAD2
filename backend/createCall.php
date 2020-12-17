<?php
include '../functions.php';

if(isset($_POST['primary'])) {
    if(isset($_POST['details'])) {
        if (!isDispatch()) {
            header('Location: /noauth');
        }
        $primaryField = explode("---", $_POST['primary']);
        $primary = $primaryField[0];
        $primaryId = $primaryField[1];
        $detailsOld = $_POST['details'];
        $details = str_replace("'", "\'", $detailsOld);
        $type = $_POST['type'];
        $redir = $_POST['redir'];
        $serverId = $_POST['serverId'];
        $location = $_POST['location'];
        $date = date("d/m/Y");
        $time = date("h:i:sa");

        $sql = "UPDATE emerg SET status = '10-97' WHERE id = $primaryId";
        $conn->query($sql);

        $sql2 = "INSERT INTO calls (primaryId,primaryName,callType,location,details,narrative,attachedUnits,date,time,closed,server) VALUES ($primaryId, '$primary', '$type', '$location', '$details', '<strong>$user->username:</strong> Created The Call.', '', '$date', '$time', 0, $serverId)";
        if ($conn->query($sql2) === TRUE) {
            header('Location: /dispatch/?c=' . $redir);
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
            // header( 'Location: index.php');
        };
    }
}
?>