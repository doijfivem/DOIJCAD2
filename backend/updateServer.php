<?php
include '../functions.php';

if(isset($_POST['server'])) {
    $server = $_POST['server'];
    $charId = $_POST['char'];
    $redirect = $_POST['redir'];

    if(session('access_token')) {
        $sql = "SELECT * FROM emerg WHERE id = $charId";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            if($user->id != $row['discordId']) {
                header('Location: ../noauth');
            }
            $sql2 = "UPDATE emerg SET server = $server WHERE id = " . $charId . "";
            $conn->query($sql2);
            $_SESSION['patrolServer'] = $server;
            header('Location: ' . $redirect);     
        }
    }
}

?>