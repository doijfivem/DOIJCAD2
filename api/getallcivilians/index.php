<?php
include '../../functions.php';

$sql = "SELECT * FROM civilians";
$count = 1;
$r_query = mysqli_query($conn, $sql);
if (mysqli_num_rows($r_query) > 0) {
    $data = [
        'status' => 'Found',
        'details' => 'Found civilians.',
    ];
    while ($row = mysqli_fetch_assoc($r_query)){
        $imageFormat = "https://$_SERVER[HTTP_HOST]/assets/civimages/" . $row['image'];
        $addingArray = [
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
        array_push($data, $addingArray);
        $count++;
    }
} else {
    $data = [
        'status' => 'Error',
        'details' => 'No civilians table.',
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>