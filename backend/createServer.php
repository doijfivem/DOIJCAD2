<?php
include '../functions.php';

if(isset($_POST['name'])) {
    $name = $_POST['name'];
    if (!isStaff(0)) {
        header('Location: /noauth');
    }
    $sql = "INSERT INTO servers (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        header('Location: /staff/sitesettings/');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        // header( 'Location: index.php');
    }; 
}
?>