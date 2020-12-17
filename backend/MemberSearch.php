<?php
include '../functions.php';
if (!isStaff(1)) {
	header('Location: /noauth');
}

if(get('q')) {
    $q = get('q');
    if (strlen($q) > 0) {
        $sql = 'SELECT * FROM emerg WHERE name LIKE "%' . $q . '%"';
        if (mysqli_query($conn, $sql)) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $count = 1;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($rowSearch = mysqli_fetch_assoc($result)) {
                echo '<tr><td>' . $rowSearch['name'] . '</td> <td>' . $rowSearch['discordId'] . '</td> <td>' . $rowSearch['dept'] . '</td> <td><a href="?rem=' . $rowSearch['id'] . '">Remove</a></td></tr><br>';
                // echo "<p id='text99'><a href=?sq=" . $rowSearch['id'] . ">" . $rowSearch['firstName'] . " " . $rowSearch['lastName'] . "</a></p>";
                // echo '<option href="?sq=' . $rowSearch['id'] . '">' . $rowSearch['firstName'] . ' ' . $rowSearch['lastName'] . '</option>';
            }
        } else {
            echo '<tr><td>No results.</td><td></td><td></td><td></td></tr>';
        }
    } else {
        echo '<tr><td>No results.</td><td></td><td></td><td></td></tr>';
    }
}
?>