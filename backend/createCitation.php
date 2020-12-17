<?php
include '../functions.php';
if (!isLEO()) {
    header('Location: /noauth');
}

if(isset($_POST['name'])) {
    if(isset($_POST['offence'])) {
        if(isset($_POST['plate']) == "") {
            $model = "N/A";
        } else {
            $model = $_POST['model'];
        }
        if(isset($_POST['plate']) == "") {
            $plate = "N/A";
        } else {
            $plate = $_POST['plate'];
            
        }

        $name_dob = explode(" ", $_POST['name']);
        $firstName = $name_dob[0];
        $lastName = $name_dob[1];
        $dob = $name_dob[3];

        $offence = $_POST['offence'];
        $fine = $_POST['fine'];
        $jail = $_POST['jail'];
        $location = $_POST['location'];
        $postal = $_POST['postal'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $dId = $_POST['dId'];
        $offName = $_POST['offName'];
        $redir = $_POST['redir'];

        $sql = "SELECT * FROM civilians WHERE firstName = '" . $firstName . "' AND lastName = '" . $lastName . "' AND dob = '" . $dob . "'";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)) {
            $cId = $row['id'];
            $sql2 = "INSERT INTO tickets (civId,civName,officerName,officerDisId,fine,jail,location,pcode,plate,model,date,time,offence) VALUES ('$cId', '$firstName $lastName', '$offName', '$dId', '$fine', '$jail', '$location', '$postal', '$plate', '$model', '$date', '$time', '$offence')";
            if ($conn->query($sql2) === TRUE) {
                header('Location: /leo/?c=' . $redir);
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
                // header( 'Location: index.php');
            };
        };
    }
}
?>