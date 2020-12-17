<?php
include '../../functions.php';

if(get('q')) {
    $callId = get('q');

    $sql = "SELECT * FROM calls WHERE id = $callId";
    $r_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($r_query) > 0) {
        while ($row = mysqli_fetch_array($r_query)){

            $data = [
                'status' => 'Found',
                'details' => 'Found call.',
                'id' => $row['id'],
                'closed' => $row['closed'],
                'server' => $row['server'],
                'CallInfo' => [
                    'primaryId' => $row['primaryId'],
                    'primaryName' => $row['primaryName'],
                    'callType' => $row['callType'],
                    'location' => $row['location'],
                    'details' => $row['details'],
                ],
                'narrative' => $row['narrative'],
                'attachedUnits' => $row['attachedUnits'],
                'date' => $row['date'],
                'time' => $row['time'],
            ];
        }  
    } else {
        $data = [
            'status' => 'Error',
            'details' => 'Call Id not found.',
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