<?php
include '../functions.php';

if(get('q')) {
    $q = get('q');
    $rId = get('id');
    if (strlen($q) > 0) {
        $sql = 'SELECT * FROM civilians WHERE firstName LIKE "%' . $q . '%"';
        if (mysqli_query($conn, $sql)) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $count = 1;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($rowSearch = mysqli_fetch_assoc($result)) {
                echo "<p id='text99'><a href=?id=$rId&sq=" . $rowSearch['id'] . ">" . $rowSearch['firstName'] . " " . $rowSearch['lastName'] . " - " . $rowSearch['dob'] ."</a></p>";
                // echo '<option href="?sq=' . $rowSearch['id'] . '">' . $rowSearch['firstName'] . ' ' . $rowSearch['lastName'] . '</option>';
            }
        } else {
            echo '<p id="text99">No results</p>';
        }
    } else {
        echo '<p id="text99">No results</p>';
    }
}

if(get('qv')) {
    $qv = get('qv');
    $rId = get('id');
    if (strlen($qv) > 0) {
        $sql = 'SELECT * FROM vehicles WHERE plate LIKE "%' . strtoupper($qv) . '%"';
        if (mysqli_query($conn, $sql)) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $count = 1;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($rowSearch = mysqli_fetch_assoc($result)) {
                echo "<p id='text99'><a href=?id=$rId&sq=" . $rowSearch['id'] . ">" . $rowSearch['plate'] . " - " . $rowSearch['model'] . "</a></p>";
                // echo '<option href="?sq=' . $rowSearch['id'] . '">' . $rowSearch['firstName'] . ' ' . $rowSearch['lastName'] . '</option>';
            }
        } else {
            echo '<p id="text99">No results</p>';
        }
    } else {
        echo '<p id="text99">No results</p>';
    }
}
?>