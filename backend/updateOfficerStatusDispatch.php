<?php
include '../functions.php';
if (!isDispatch()) {
    header('Location: /noauth');
}

if(isset($_POST['name'])) {
    if(isset($_POST['status'])) {
        $redir = $_POST['redir'];
        $status = $_POST['status'];
        $name = $_POST['name'];
        $serverId = $_POST['serverId'];
        if(session('access_token')) {
            $sql2 = "UPDATE emerg SET status = '$status' WHERE name = '$name' AND server = $serverId AND NOT deptType = 2";
            $conn->query($sql2);
            header('Location: ' . $redir . '');
        }
    }
}
?>