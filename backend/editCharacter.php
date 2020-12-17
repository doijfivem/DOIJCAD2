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

if(get('c')) {
	$charId = get('c');
	if(session('access_token')) {
		$sql = "SELECT * FROM civilians WHERE id = " . $charId . "";
		$r_query = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($r_query)){
			if($user->id != $row['discordId']) {
				header('Location: ../noauth');
            }
            // Hair Color
            if(isset($_POST['hair'])) {
                $hair = $_POST['hair'];
                $sql2 = "UPDATE civilians SET hair = '$hair' WHERE id = " . $charId . "";
                $conn->query($sql2);
                header('Location: ../civ/?c=' . $charId . '');
            }

            // Gender
            if(isset($_POST['gender'])) {
                $gender = $_POST['gender'];
                $sql2 = "UPDATE civilians SET gender = '$gender' WHERE id = " . $charId . "";
                $conn->query($sql2);
                header('Location: ../civ/?c=' . $charId . '');
            }

            // Address
            if(isset($_POST['address'])) {
                $address = $_POST['address'];
                $sql2 = "UPDATE civilians SET address = '$address' WHERE id = " . $charId . "";
                $conn->query($sql2);
                header('Location: ../civ/?c=' . $charId . '');
            }

            // Image
            if(file_exists($_FILES['file']['tmp_name'])) {
                $filename = RandomString(30);
                $targetfile = $_FILES["file"]["name"];
                $fileType = pathinfo($targetfile, PATHINFO_EXTENSION);
            
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetdir.$filename.'.'.$fileType)) {
                    $image = $filename.'.'.$fileType;
                    $sql2 = "UPDATE civilians SET image = '$image' WHERE id = " . $charId . "";
                    $conn->query($sql2);
                    header('Location: ../civ/?c=' . $charId . '');
                }
            }
		}
	} else {
        header('Location: ../noauth');
    }
} else {
    header('Location: ../noauth');
}



?>