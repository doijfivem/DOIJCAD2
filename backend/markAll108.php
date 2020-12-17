<?php
include '../functions.php';

if(get('callId')) {
    $callId = get('callId');
    $redir = get('redir');
    if (!isDispatch()) {
        header('Location: /noauth');
    }

    $sql = "SELECT * FROM calls WHERE id = " . $callId . "";
    $r_query = mysqli_query($conn, $sql);
    while ($rowCallExt = mysqli_fetch_array($r_query)) {

        $primaryId = $rowCallExt['primaryId'];
        $sql3 = "UPDATE emerg SET status = '10-8' WHERE id = " . $primaryId . "";
        $conn->query($sql3);

        $attachExplode = explode("||&%&||", $rowCallExt['attachedUnits']);
        foreach ($attachExplode as &$attachId) {
            $sql2 = "UPDATE emerg SET status = '10-8' WHERE id = " . $attachId . "";
            $conn->query($sql2);
        }
        header('Location: ' . $redir);
    }
}
?>