<?php
include '../functions.php';

if(get('q')) {
    $q = get('q');
    $rId = get('id');
    if (strlen($q) > 0) {
        $sql = 'SELECT * FROM classicusers WHERE username LIKE "%' . $q . '%"';
        if (mysqli_query($conn, $sql)) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $count = 1;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($rowSearch = mysqli_fetch_assoc($result)) {
                echo '<tr><td>' . $rowSearch['id'] . '</td> <td>' . $rowSearch['username'] . '</td> <td>' . date('Y-m-d h:i:s', $row['id']) . '</td> <td><a href="?del=' . $rowSearch['id'] . '">Delete</a></td></tr><br>';
                // echo '<option href="?sq=' . $rowSearch['id'] . '">' . $rowSearch['firstName'] . ' ' . $rowSearch['lastName'] . '</option>';
            }
        } else {
            echo 'No results';
        }
    } else {
        echo 'No results';
    }
?>