<?php
include '../functions.php';
if(get('server')) {
    $server = get('server');
    
}
if(get('rId')) {
    $rId = get('rId');
}

function upZuluTime







///////////// UNIT TABLE
$sql = "SELECT * from emerg WHERE NOT status = '10-7' AND server = $server";
$count = 1;
$result = mysqli_query($conn, $sql);
?>
<script>
    let resp1 = `<div id="table08" class="table-wrapper">
        <div class="table-inner">
            <table>
                <thead>
                    <tr>
                        <th class="tableWhiteOverride">Unit</th>
                        <th class="tableWhiteOverride">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($rowUnits = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><span style="color: <?php getDeptColor($row['department']); ?>"><?php echo $rowUnits['name']; ?></span></td>
                            <td><?php convertResultToColor($rowUnits['status']); ?></td>
                        </tr>
                    <?php
                            $count++;
                        }
                    } else {
                    ?>
                        <tr>
                            <td>No active units.</td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>`

$("#getUnitTable").html(resp1);
</script>