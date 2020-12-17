<?php
include '../functions.php';
$redir = get('r');

if(isset($_POST['update'])) {
    $settingUpdate = $_POST['update'];
    $setting = $_POST['sett'];
    $authNeeded = $_POST['auth'];
    if (!isStaff(intval($authNeeded))) {
        header('Location: /noauth');
    }
    if($setting == "maxChars") {
        $sql = "UPDATE sitesettings SET $setting = $settingUpdate WHERE id = 1";
    } else {
        $sql = "UPDATE sitesettings SET $setting = '$settingUpdate' WHERE id = 1";
    }
    if ($conn->query($sql) === TRUE) {
        header('Location: ' . $redir);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        // header( 'Location: index.php');
    };
}

if(file_exists($_FILES['favicon']['tmp_name'])) {
    $filename = "favicon";
    $targetfile = $_FILES["favicon"]["name"];
    $fileType = pathinfo($targetfile, PATHINFO_EXTENSION);
    if (!isStaff(0)) {
        header('Location: /noauth');
    }
    if (move_uploaded_file($_FILES['favicon']['tmp_name'], "$installLocation/assets/favicon.png")) {
        header('Location: ' . $redir);
    } else { 
        echo "File move failed.";
    } 
}
?>