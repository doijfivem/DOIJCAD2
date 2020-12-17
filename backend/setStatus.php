<?php
include '../functions.php';

if(get('id')) {
    if(get('status')) {
        $unitId = get('id');
        $stat = get('status');

        if(session('access_token')) {
            $sql = "SELECT * FROM emerg WHERE id = $unitId";
            $r_query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($r_query)){
                if($user->id != $row['discordId']) {
                    header('Location: ../noauth');
                }
                $redir = get('r');
                header('Location: ' . $redir);
                $sql2 = "UPDATE emerg SET status = '$stat' WHERE id = " . $unitId . "";
                $conn->query($sql2);
            }
        }
    }
}

if(get('panic')) {
    if(get('status')) {
        $unitId = get('panic');
        $stat = get('status');

        if(session('access_token')) {
            $sql = "SELECT * FROM emerg WHERE id = $unitId";
            $r_query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($r_query)){
                if($user->id != $row['discordId']) {
                    header('Location: ../noauth');
                }
                $redir = get('r');
                header('Location: ' . $redir);
                $sql2 = "UPDATE emerg SET panic = $stat WHERE id = " . $unitId . "";
                $conn->query($sql2);
                
            }
        }
    }
}

?>