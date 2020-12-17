<?php
include '../functions.php';
if(get('s')) {
    $server = get('s');
    $url = get('url');
}

$sql = "SELECT * from calls WHERE closed = 0 AND server = $server";
$count = 1;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    echo '<div id="table06" class="table-wrapper">
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
                <tbody>';
    while ($rowActCalls = mysqli_fetch_assoc($result)) {
        
        echo '<tr>
            <td><a href="' . $url . '&ext=' . $rowActCalls["id"] . '">#' . $rowActCalls["id"] . '</a></td>
            <td>' . $rowActCalls["primaryName"] . '</td>
            <td>' . convertResultToColorReturn($rowActCalls["callType"]) . '</td>
            <td>' . $rowActCalls["location"] . '</td>
        </tr>';
        $count++;
    }
                echo '</tbody>
            </table>
        </div>
    </div>';
} else {
    echo "<p id='text03'>There's no active calls.</p>";
}