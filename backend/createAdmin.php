<?php
include '../functions.php';

if(isset($_POST['aname'])) {
    $aname = $_POST['aname'];
    $id = $_POST['id'];
    if (!isStaff(0)) {
        header('Location: /noauth');
    }
    $sql2 = "INSERT INTO admins (id,name,type) VALUES ('$id', '$aname', 0)";
    if ($conn->query($sql2) === TRUE) {
        // sendAdminWebHook("http://$_SERVER[HTTP_HOST]/staff/adminsettings", "Admin Added", "$aname ($id) was added as an admin.");
        header("Location: /staff/adminsettings");
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        // header( 'Location: index.php');
    };
}

if(isset($_POST['sname'])) {
    $sname = $_POST['sname'];
    $id = $_POST['id'];
    if (!isStaff(0)) {
        header('Location: /noauth');
    }
    $sql2 = "INSERT INTO admins (id,name,type) VALUES ('$id', '$sname', 1)";
    if ($conn->query($sql2) === TRUE) {
        // sendAdminWebHook("http://$_SERVER[HTTP_HOST]/staff/supersettings", "Admin Added", "$sname ($id) was added as an admin.");
        header('Location: /staff/supersettings');
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        // header( 'Location: index.php');
    };
}

if(isset($_POST['bname'])) {
    $bname = $_POST['bname'];
    $id = $_POST['id'];
    if (!isStaff(0)) {
        header('Location: /noauth');
    }
    $sql2 = "INSERT INTO bans (name,discordId,ip) VALUES ('$bname', '$id', 'N/A')";
    if ($conn->query($sql2) === TRUE) {
        // sendAdminWebHook("http://$_SERVER[HTTP_HOST]/staff/bans", "User Banned", "$bname ($id) was banned.");
        header('Location: /staff/bans');
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        // header( 'Location: index.php');
    };
}
?>