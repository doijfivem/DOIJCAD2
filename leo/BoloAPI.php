<?php
include '../functions.php';

$sql = "SELECT * from bolos";
if (mysqli_query($conn, $sql)) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$count = 1;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

?>
    <div id="table08" class="table-wrapper">
        <div class="table-inner">
            <table>
                <thead>
                    <tr>
                        <th>Details</th>
                        <th>Date & Time Added</th>
                    </tr>
                </thead>
                <tbody>

<?php
                    while ($rowCall = mysqli_fetch_assoc($result)) {
?>
                        <tr>
                            <td><?php echo $rowCall['details']; ?></td>
                            <td><?php echo $rowCall['date']; ?> <?php echo $rowCall['time']; ?></td>
                        </tr>							
<?php
                        $count++;
                    }
?>
                </tbody>
            </table>
        </div>
    </div>
<?php
} else {
?>
    <p id="text03">There is no current BOLO's</p>
<?php
}
?>
