<?php
include '../../functions.php';

if(get('q')) {
    $civId = get('q');
    $sql = "SELECT * FROM tickets WHERE civId = '$civId'";
    $count = 1;
    $r_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($r_query) > 0) {
        $data = [
            'status' => 'Found',
            'details' => 'Found civilians tickets.',
        ];
        while ($row = mysqli_fetch_assoc($r_query)){
            $plate = ($row['plate'] ? $row['plate'] : "N/A");
            $model = ($row['model'] ? $row['model'] : "N/A");
            $addingArray = [
                'id' => $row['id'],
                'civName' => $row['civName'],
                'offence' => $row['offence'],
                'officerName' => $row['officerName'],
                'officerDisId' => $row['officerDisId'],
                'fine' => $row['fine'],
                'jail' => $row['jail'],
                'location' => $row['location'],
                'plate' => $plate,
                'model' => $model,
                'date' => $row['date'],
                'time' => $row['time'],
            ];
            array_push($data, $addingArray);
            $count++;
        }
    } else {
        $data = [
            'status' => 'Error',
            'details' => 'This civilian has no tickets on record.',
        ];
    }
} else {
    $data = [
        'status' => 'Error',
        'details' => 'Search parameter not found (q).',
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>