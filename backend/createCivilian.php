<?php
include '../functions.php';

function RandomString($length) {
    $keys = array_merge(range(0,9), range('a', 'z'));
 
    $key = '';
    for($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}


if(isset($_POST['firstname'])) {
    if(isset($_POST['address'])) {
        if(session('access_token')) {
            if(file_exists($_FILES['file']['tmp_name'])) {
                $filename = RandomString(30);
                $targetfile = $_FILES["file"]["name"];
                $fileType = pathinfo($targetfile, PATHINFO_EXTENSION);
            
                if (move_uploaded_file($_FILES['file']['tmp_name'], "$installLocation/assets/civimages/$filename.$fileType")) {
                    $image = $filename.'.'.$fileType;
                    $first = $_POST['firstname'];
                    $last = $_POST['lastname'];
                    $gender = $_POST['gender'];
                    $race = $_POST['race'];
                    $address = $_POST['address'];
                    $dob = $_POST['dob'];
                    $hair = $_POST['hair'];

                    $sql = "INSERT INTO civilians (discordId,firstName,lastName,gender,race,address,dob,hair,image,dead,licDrive,licWeapons,licHunt,licFish,licComm,licBoat,licAir) VALUES ('$user->id', '$first', '$last', '$gender', '$race', '$address', '$dob', '$hair', '$image', 0, 'None', 'None', 'None', 'None', 'None', 'None', 'None')";
                    if ($conn->query($sql) === TRUE) {
                        header('Location: /civ');
                    } else {
                        header('Location: /error?e=' . $sql . '<br>' . $conn->error);
                    };
                } else { 
                    header('Location: /error?e=Character image upload failed to move to the specified path.');
                }     
            } else {
                $image = 'nomale.png';
                $first = $_POST['firstname'];
                $last = $_POST['lastname'];
                $gender = $_POST['gender'];
                $race = $_POST['race'];
                $address = $_POST['address'];
                $dob = $_POST['dob'];
                $hair = $_POST['hair'];
                if($gender == 'Female') {
                    $image = 'nofemale.png';
                }
                $sql = "INSERT INTO civilians (discordId,firstName,lastName,gender,race,address,dob,hair,image,dead,licDrive,licWeapons,licHunt,licFish,licComm,licBoat,licAir) VALUES ('$user->id', '$first', '$last', '$gender', '$race', '$address', '$dob', '$hair', '$image', 0, 'None', 'None', 'None', 'None', 'None', 'None', 'None')";
                if($conn->query($sql) === TRUE) {
                    header('Location: /civ');
                } else {
                    header('Location: /error?e=' . $sql . '<br>' . $conn->error);
                };
            }
        }
    }
}
?>