<?php
include '../functions.php';
if(get('id')) {
    $unitId = get('id');
    $sql = "SELECT * FROM emerg WHERE id = " . $unitId . " AND deptType = 1";
    $r_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($r_query)) {
        if($user->id != $row['discordId']) {
            header('Location: ../noauth');
        }


        if ($row['callId'] == 0 || $row['callId'] == 2) {
        ?>
            <p id="text03">You have no active call.</p>
            <script type="text/javascript" src="notify.js"></script>
            <script type="text/javascript">
                resetNotify();
            </script>
        <?php
        } else {
        ?>

            <div id="table07" class="table-wrapper">
            <div class="table-inner">
            <script type="text/javascript" src="notify.js"></script>
            <script type="text/javascript">
                notifyCall();
            </script>
                <table>
                <thead>
                    <tr>
                        <th>Primary Unit</th>
                        <th>Call Type</th>
                        <th>Location</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
        <?php
                    $sql = "SELECT * from calls WHERE primaryId = " . $unitId . " AND closed = 0";
                    if (mysqli_query($conn, $sql)) {
                        echo "";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                    $count = 1;
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($rowCall = mysqli_fetch_assoc($result)) {
        ?>
                            <tr>
                                <td><?php echo $rowCall['primaryName']; ?></td>
                                <td><?php echo $rowCall['callType']; ?></td>
                                <td><?php echo $rowCall['location']; ?>/Black</td>
                                <td><?php echo $rowCall['details']; ?></td>
                            </tr>
                                                
        <?php
                            $count++;
                        }
                    }
        ?>
                </tbody>
                </table>
            </div>
            </div>
        <?php
        }
    }
} else {
    echo '<p id="text03">You have no active call.</p>';
}
?>