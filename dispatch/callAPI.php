<?php
include '../functions.php';
if(get('server')) {
    $server = get('server');
    $url = get('url');
}

$sql = "SELECT * from calls WHERE closed = 0 AND server = $server";
if (mysqli_query($conn, $sql)) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$count = 1;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
?>
    <div id="table06" class="table-wrapper">
        <div class="table-inner">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Primary Unit</th>
                        <th>Call Type</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
<?php
    while ($rowActCalls = mysqli_fetch_assoc($result)) {
?>
        
                    <tr>
                        <td><a href="<?php echo $url; ?>&ext=<?php echo $rowActCalls['id']; ?>">#<?php echo $rowActCalls['id']; ?></a></td>
                        <td><?php echo $rowActCalls['primaryName']; ?></td>
                        <td><?php echo convertResultToColor($rowActCalls['callType']); ?></td>
                        <td><?php echo $rowActCalls['location']; ?></td>
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
    <p id="text03">There's no active calls.</p>
<?php
}
?>