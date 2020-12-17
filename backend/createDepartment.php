<?php
include '../functions.php';

if(isset($_POST['name'])) {
    $nameOld = $_POST['name'];
    $name = str_replace("'", "\'", $nameOld);
    $color = $_POST['color'];
    $type = $_POST['type'];
    $verification = $_POST['verification'];
    if (!isStaff(0)) {
        header('Location: /noauth');
    }
    if($type == "0") {
        $typeName = "Law Enforcement";
    } elseif($type == "1") {
        $typeName = "Fire";
    } else {
        $typeName = "Dispatch";
    }

    $sql2 = "INSERT INTO departments (name,color,type,typeName,locked) VALUES ('$name', '$color', $type, '$typeName', $verification)";
    if ($conn->query($sql2) === TRUE) {
        header('Location: /staff/departmentsettings');
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        // header( 'Location: index.php');
    };
}
?>