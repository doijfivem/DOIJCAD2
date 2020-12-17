<?php
include '../functions.php';

if(isset($_POST['forceused'])) {
    $forceused = "Yes";
} else {
    $forceused = "No";
}
if(isset($_POST['lethalused'])) {
    $lethalused = "Yes";
} else {
    $lethalused = "No";
}
if(isset($_POST['propertydamaged'])) {
    $propertydamaged = "Yes";
} else {
    $propertydamaged = "No";
}
if(isset($_POST['injury_caused'])) {
    $injury_caused = "Yes";
} else {
    $injury_caused = "No";
}

if(isset($_POST['name'])) {
    if(isset($_POST['offence'])) {
        if (!isLEO()) {
            header('Location: /noauth');
        }

        $name_dob = explode(" ", $_POST['name']);
        $firstName = $name_dob[0];
        $lastName = $name_dob[1];
        $dob = $name_dob[3];
        $arresttype = $_POST['arresttype'];
        $offence = str_replace("'", "\'", $_POST['offence']);
        $fine = $_POST['fine'];
        $jail = $_POST['jail'];
        $location = str_replace("'", "\'", $_POST['location']);
        $postal = $_POST['postal'];
        $details = str_replace("'", "\'", $_POST['details']);
        $time = $_POST['time'];
        $date = $_POST['date'];
        $dId = $_POST['dId'];
        $offName = $_POST['offName'];
        $redir = $_POST['redir'];

        $sql = "SELECT * FROM civilians WHERE firstName = '" . $firstName . "' AND lastName = '" . $lastName . "' AND dob = '" . $dob . "'";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)) {
            $cId = $row['id'];
            $sql2 = "INSERT INTO arrests (civId,civName,officerName,officerDisId,offence,type,forceUsed,lethalUsed,propDamage,injuryCaused,fine,jail,location,pcode,reportDetails,date,time) VALUES ('$cId', '$firstName $lastName', '$offName', '$dId', '$offence', '$arresttype', '$forceused', '$lethalused', '$propertydamaged', '$injury_caused', '$fine', '$jail', '$location', '$postal', '$details', '$date', '$time')";
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