<?php
include '../../functions.php';

if(get('q')) {
    $searchQuery = explode(" ", get('q'));
    $firstName = $searchQuery[0];
    $lastName = $searchQuery[1];

    $sql = "SELECT * FROM civilians WHERE firstName = '$firstName' AND lastName = '$lastName'";
    $r_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($r_query) > 0) {
        while ($row = mysqli_fetch_array($r_query)){
            $imageFormat = "https://$_SERVER[HTTP_HOST]/assets/civimages/" . $row['image'];
            $data = [
                'status' => 'Found',
                'details' => 'Found character.',
                'id' => $row['id'],
                'ownerId' => $row['discordId'],
                'charInfo' => [
                    'firstName' => $row['firstName'],
                    'lastName' => $row['lastName'],
                    'DoB' => $row['dob'],
                    'address' => $row['address'],
                    'gender' => $row['gender'],
                    'race' => $row['race'],
                    'hairColor' => $row['hair'],
                    'dead' => $row['dead'],
                ],
                'image' => $imageFormat,
                'license' => [
                    'drivers' => $row['licDrive'],
                    'commercial' => $row['licComm'],
                    'firearms' => $row['licWeapons'],
                    'boat' => $row['licBoat'],
                    'aviation' => $row['licAir'],
                    'hunting' => $row['licHunt'],
                    'fishing' => $row['licFish'],
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