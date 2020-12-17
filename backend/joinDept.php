<?php
include '../functions.php';

if(isset($_POST['name'])) {
    if(isset($_POST['department'])) {
        $name = $_POST['name'];
        $departmentOld = $_POST['department'];
        $department = str_replace("'", "\'", $departmentOld);
        if(session('access_token')) {
            $sql = "SELECT * FROM departments WHERE id = " . $department . "";
            $r_query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($r_query)){
                if($row['locked'] == 1) {
                    $newName = str_replace("'", "\'", $name);
                    $deptName = $row['name'];
                    $deptType = $row['type'];
                    $sql = "INSERT INTO pending (name,department,deptType,deptId,discordId) VALUES ('$newName', '$deptName', $deptType, '$department', '$user->id')";
                    if ($conn->query($sql) === TRUE) {
                        header('Location: /pending');
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        // header( 'Location: index.php');
                    };  
                } else {
                    $newName = str_replace("'", "\'", $name);
                    $deptName = $row['name'];
                    $deptType = $row['type'];
                    $sql = "INSERT INTO emerg (discordId,name,dept,deptType,status,server,callId) VALUES ('$user->id', '$newName', '$deptName', $deptType, '10-7', 1, 0)";
                    if ($conn->query($sql) === TRUE) {
                        header('Location: /');
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        // header( 'Location: index.php');
                    };
                }
            }       
        }
    }
}
?>