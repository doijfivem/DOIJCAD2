<?php
include '../functions.php';
$sql = "SELECT * from bolos";
$count = 1;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    echo '<div id="table04" class="table-wrapper">
        <div class="table-inner">
            <table>
                <thead>
                    <tr>
                        <th>Details</th>
                        <th>Date & Time Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                    while ($rowCall = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                            <td>' . $rowCall["details"] . '></td>
                            <td>' .  $rowCall["date"] . ' ' . $rowCall["time"] . '</td>
                            <td><a href="?delbolo=' . $rowCall["id"] . '&r=' . get("rId") . '">Delete</td>
                        </tr>';						
                        $count++;
                    }
                echo '</tbody>
            </table>
        </div>
    </div>';

} else {
    echo "<p id='text03'>There is no current BOLO's</p>";
}