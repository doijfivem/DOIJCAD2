<?php
include '../functions.php';
$server = get('s');
$sql4 = "SELECT * from emerg WHERE NOT status = '10-7' AND server = $server";
$count4 = 1;
$result4 = mysqli_query($conn, $sql4);

echo '<div id="table08" class="table-wrapper">
    <div class="table-inner">
        <table>
            <thead>
                <tr>
                    <th class="tableWhiteOverride">Unit</th>
                    <th class="tableWhiteOverride">Status</th>
                </tr>
            </thead>
            <tbody>';
                if (mysqli_num_rows($result4) > 0) {
                    while ($rowUnits = mysqli_fetch_assoc($result4)) {
                    echo '<tr>
                        <td><span style="color: ' . getDeptColorReturn($rowUnits["dept"]) . '">' . $rowUnits["name"] . '</span></td>
                        <td>' . convertResultToColorReturn($rowUnits["status"]) . '</td>
                    </tr>';
                        $count4++;
                    }
                } else {
                    echo '<tr>
                        <td>No active units.</td>
                        <td></td>
                    </tr>';
                }
                echo '
            </tbody>
        </table>
    </div>
</div>';