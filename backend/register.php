<?php
include '../functions.php';
if(isset($_POST['username'])) {
    if(isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $unix = time();

        $sql = "SELECT * FROM classicusers WHERE username = '$username' OR id = '$unix'";
        $r_query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($r_query) > 0) {
            header('Location: /register/?err=Username taken');
        } else {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT, array(
                "cost" => 12
            ));
            $sql2 = "INSERT INTO classicusers (id,username,password) VALUES ('$unix', '$username', '$passwordHash')";
            if ($conn->query($sql2) === TRUE) {
                sleep(1);
                $sql3 = "SELECT * FROM classicusers WHERE username = '$username'";
                $r_query = mysqli_query($conn, $sql3);
                while ($row = mysqli_fetch_array($r_query)){
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['access_token'] = "manVerified";
                    header('Location: /');
                }
            } else {
                echo "Error: " . $sql3 . "<br>" . $conn->error;
                // header( 'Location: index.php');
            };
        }
    }
}
?>