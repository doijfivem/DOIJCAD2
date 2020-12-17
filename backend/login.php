<?php
session_start();
include '../functions.php';

if(isset($_POST['username'])) {
    if(isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];


        $sql = "SELECT * FROM classicusers WHERE username = '$username'";
        $r_query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($r_query) > 0) {
            while ($row = mysqli_fetch_array($r_query)){
                $validPassword = password_verify($password, $row['password']);
                if($validPassword) {
                    // Login user
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['access_token'] = "manVerified";
                    session_write_close();
                    header('Location: /');die();
                } else {
                    header('Location: /login/?err=Incorrect username or password');die();
                }
            }
        } else {
            header('Location: /login/?err=Username not found');die();
        }
    }
}
?>