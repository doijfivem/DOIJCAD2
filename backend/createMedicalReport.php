<?php
include '../functions.php';

if(isset($_POST['name'])) {
    if(isset($_POST['details'])) {
        if (!isLEO()) {
            header('Location: /noauth');
        }

        $name_dob = explode(" ", $_POST['name']);
        $firstName = $name_dob[0];
        $lastName = $name_dob[1];
        $dob = $name_dob[3];
        $details = $_POST['details'];
        $redir = $_POST['redir'];

        $sql = "SELECT * FROM civilians WHERE firstName = '" . $firstName . "' AND lastName = '" . $lastName . "' AND dob = '" . $dob . "'";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)) {
            $cId = $row['id'];
            $sql2 = "INSERT INTO medicalreports (civId,civName,details) VALUES ($cId, '$firstName $lastName', '$details')";
            if ($conn->query($sql2) === TRUE) {
                header('Location: /fire/?c=' . $redir);
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
                // header( 'Location: index.php');
            }; 
        };
    }
}
?>