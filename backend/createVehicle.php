<?php
include '../functions.php';

if(isset($_POST['model'])) {
    if(isset($_POST['color'])) {
        if(isset($_POST['insurance'])) {
            if(session('access_token')) {
                $model = $_POST['model'];
                $plate = strtoupper($_POST['plate']);
                $color = $_POST['color'];
                $registration = $_POST['registration'];
                $insurance = $_POST['insurance'];
                $char = $_POST['char'];
                $charName = $_POST['charName'];

                $sql = "INSERT INTO vehicles (model,plate,color,rego,insure,stolen,discordId,charId,charName) VALUES ('$model', '$plate', '$color', '$registration', '$insurance', 'No', '$user->id', $char, '$charName')";
                if ($conn->query($sql) === TRUE) {
                    header('Location: /civ/?c=' . $char);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    // header( 'Location: index.php');
                }; 
            }
        }
    }
}
?>