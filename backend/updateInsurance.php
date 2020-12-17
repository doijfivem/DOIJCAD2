<?php
include '../functions.php';

if(isset($_POST['vehicle'])) {
    if(isset($_POST['status'])) {
        $vehicle = $_POST['vehicle'];
        $status = $_POST['status'];
        $char = $_POST['char'];
        if(session('access_token')) {
            $sql = "SELECT * FROM vehicles WHERE id = $vehicle";
            $r_query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($r_query)){
                if($user->id != $row['discordId']) {
                    header('Location: ../noauth');
                }
                $sql2 = "UPDATE vehicles SET insure = '$status' WHERE id = " . $vehicle . "";
                $conn->query($sql2);
                header('Location: ../civ/?c=' . $char . '');
            }
        }
    }
}
?>