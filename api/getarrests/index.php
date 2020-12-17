<?php
include '../../functions.php';

if(get('q')) {
    $civId = get('q');
    $sql = "SELECT * FROM arrests WHERE civId = '$civId'";
    $count = 1;
    $r_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($r_query) > 0) {
        $data = [
            'status' => 'Found',
            'details' => 'Found civilians arrests.',
        ];
        while ($row = mysqli_fetch_assoc($r_query)){
            $addingArray = [
                'id' => $row['id'],
                'civName' => $row['civName'],
                'offence' => $row['offence'],
                'officerName' => $row['officerName'],
                'officerDisId' => $row['officerDisId'],
                'type' => $row['type'],
                'forceUsed' => $row['forceUsed'],
                'propDamage' => $row['propDamage'],
                'lethalUsed' => $row['lethalUsed'],
                'injuryCaused' => $row['injuryCaused'],
                'reportDetails' => $row['reportDetails'],
                'jail' => $row['jail'],
                'fine' => $row['fine'],
                'pcode' => $row['pcode'],
                'location' => $row['location'],
                'date' => $row['date'],
                'time' => $row['time'],
            ];
            array_push($data, $addingArray);
            $count++;
        }
    } else {
        $data = [
            'status' => 'Error',
            'details' => 'This civilian has no arrests on record.',
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