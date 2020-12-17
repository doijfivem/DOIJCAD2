<?php
include '../functions.php';

if(isset($_POST['model'])) {
    if(isset($_POST['status'])) {
        if(session('access_token')) {
            $model = $_POST['model'];
            $status = $_POST['status'];
            $charId = $_POST['char'];

            $sql = "INSERT INTO weapons (model,status,discordId,charId) VALUES ('$model', '$status', '$user->id', $charId)";
            if ($conn->query($sql) === TRUE) {
                header('Location: /civ/?c=' . $charId);
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                // header( 'Location: index.php');
            }; 
        }
    }
}
?>