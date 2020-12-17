<?php
include '../../functions.php';

$sql = "SELECT * FROM sitesettings WHERE id = 1";
$r_query = mysqli_query($conn, $sql);
if (mysqli_num_rows($r_query) > 0) {
    while ($row = mysqli_fetch_array($r_query)){
        $favicon = "https://$_SERVER[HTTP_HOST]/assets/favicon.png";
        $data = [
            'status' => 'Found',
            'details' => 'Found site settings.',
            'id' => $row['id'],
            'masterAdmin' => $ownerId,
            'debugMode' => $debugMode,
            'installLocation' => $installLocation,
            'branding' => [
                'name' => $row['name'],
                'nameSml' => $row['nameSml'],
                'description' => $row['description'],
                'shareColor' => $row['shareColor'],
                'favicon' => $favicon,
            ],
            'discord' => [
                'invite' => $row['invite'],
                'discordGuildId' => $row['discordGuildId'],
            ],
            'cad' => [
                'logintype' => $row['logintype'],
                'backgroundColor' => $row['backgroundColor'],
                'maxChars' => $row['maxChars'],
                'penalCode' => $row['penalCode'],
                'liveMap' => $row['liveMap'],
                'nameFormat' => $row['nameFormat'],
            ],
        ];
    }  
} else {
    $data = [
        'status' => 'Error',
        'details' => 'MAJOR! No sitesettings were found.',
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>