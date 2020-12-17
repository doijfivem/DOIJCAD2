<?php
include '../functions.php';

if(isset($_POST['license'])) {
    if(isset($_POST['status'])) {
        $license = $_POST['license'];
        $status = $_POST['status'];
        $charId = $_POST['char'];
        if(session('access_token')) {
            $sql = "SELECT * FROM civilians WHERE id = " . $charId . "";
            $r_query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($r_query)){
                if($user->id != $row['discordId']) {
                    header('Location: ../noauth');
                }
                $sql2 = "UPDATE civilians SET " . $license . " = '$status' WHERE id = " . $charId . "";
                $conn->query($sql2);
                header('Location: ../civ/?c=' . $charId . '');
            }       
        }
    }
}
?>