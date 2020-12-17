<?php
include '../../functions.php';

$sql = "SELECT * FROM warrants";
$count = 1;
$r_query = mysqli_query($conn, $sql);
if (mysqli_num_rows($r_query) > 0) {
    $data = [
        'status' => 'Found',
        'details' => 'Found warrants.',
    ];
    while ($row = mysqli_fetch_assoc($r_query)){
        $addingArray = [
            'id' => $row['id'],
            'civId' => $row['civId'],
            'civName' => $row['civName'],
            'details' => $row['details'],
        ];
        array_push($data, $addingArray);
        $count++;
    }
} else {
    $data = [
        'status' => 'Error',
        'details' => 'There are no current warrants.',
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>