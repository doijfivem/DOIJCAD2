<?php
include '../../functions.php';

$sql = "SELECT * FROM bolos";
$count = 1;
$r_query = mysqli_query($conn, $sql);
if (mysqli_num_rows($r_query) > 0) {
    $data = [
        'status' => 'Found',
        'details' => 'Found BOLOs.',
    ];
    while ($row = mysqli_fetch_assoc($r_query)){
        $addingArray = [
            'id' => $row['id'],
            'details' => $row['details'],
            'date' => $row['date'],
            'time' => $row['time'],
        ];
        array_push($data, $addingArray);
        $count++;
    }
} else {
    $data = [
        'status' => 'Error',
        'details' => 'There are no current BOLOs.',
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>