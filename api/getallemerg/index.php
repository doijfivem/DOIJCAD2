<?php
include '../../functions.php';

$sql = "SELECT * FROM emerg";
$count = 1;
$r_query = mysqli_query($conn, $sql);
if (mysqli_num_rows($r_query) > 0) {
    $data = [
        'status' => 'Found',
        'details' => 'Found emergency table.',
    ];
    while ($row = mysqli_fetch_assoc($r_query)){
        $addingArray = [
            'id' => $row['id'],
            'ownerId' => $row['discordId'],
            'name' => $row['name'],
            'dept' => [
                'dept' => $row['dept'],
                'deptType' => $row['deptType'],
            ],
            'duty' => [
                'status' => $row['status'],
                'server' => $row['server'],
                'callId' => $row['callId'],
                'panic' => $row['panic'],
            ],
        ];
        array_push($data, $addingArray);
        $count++;
    }
} else {
    $data = [
        'status' => 'Error',
        'details' => 'No emergency table.',
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>