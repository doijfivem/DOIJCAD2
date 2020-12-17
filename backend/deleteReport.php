<?php
include '../functions.php';

if (isStaff(0)) {
    if(isset($_POST['repId'])) {
        $firstId = explode("-", $_POST['repId']);
        $repId = $firstId[1];
        $table = $_POST['sett'];
        $sql = "DELETE FROM $table WHERE id = $repId";
        $conn->query($sql);
        header('Location: /staff/reportmanager');
    }
} else {
    header('Location: ../noauth');
}
?>