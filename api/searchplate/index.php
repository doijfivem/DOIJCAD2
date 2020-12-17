<?php
include '../../functions.php';

if(get('q')) {
    $plate = get('q');

    $sql = "SELECT * FROM vehicles WHERE plate = '$plate'";
    $r_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($r_query) > 0) {
        while ($row = mysqli_fetch_array($r_query)){

            $data = [
                'status' => 'Found',
                'details' => 'Found vehicle.',
                'id' => $row['id'],
                'ownerId' => $row['discordId'],
                'VehInfo' => [
                    'plate' => $row['plate'],
                    'model' => $row['model'],
                    'color' => $row['color'],
                    'registration' => $row['rego'],
                    'insurance' => $row['insure'],
                    'stolen' => $row['stolen'],
                    'ownerName' => $row['charName'],
                ],
            ];
        }  
    } else {
        $data = [
            'status' => 'Error',
            'details' => 'Character name was not found.',
        ];
    }
} else {
    $data = [
        'status' => 'Error',
        'details' => 'Search name parameter not found (q).',
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>