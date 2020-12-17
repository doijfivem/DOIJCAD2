<?php
include '../functions.php';

if(isset($_POST['weapon'])) {
    if(isset($_POST['status'])) {
        $weapon = $_POST['weapon'];
        $status = $_POST['status'];
        $charId = $_POST['char'];
        // echo $weapon, $status, $charId;
        if(session('access_token')) {
            $sql = "SELECT * FROM weapons WHERE id = $weapon";
            $r_query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($r_query)){
                if($user->id != $row['discordId']) {
                    header('Location: ../noauth');
                }
                $sql2 = "UPDATE weapons SET status = '$status' WHERE id = $weapon";
                $conn->query($sql2);
                header('Location: ../civ/?c=' . $charId . '');
            }       
        }
    }
}
?>