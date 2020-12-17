<?php
include '../functions.php';

if(session('access_token')) {
    $sql = "SELECT * FROM emerg WHERE discordId = " . $user->id . " AND deptType = 2";
    $r_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($r_query)){
        if($user->id != $row['discordId']) {
            header('Location: ../noauth');
        }
        $sql2 = "UPDATE emerg SET panic = 0 WHERE panic = 1";
        $conn->query($sql2);
        $redir = get('r');
        header('Location: ' . $redir);
    }
}
?>