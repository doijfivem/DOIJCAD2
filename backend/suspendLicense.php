<?php
include '../functions.php';

if (isStaff(1)) {
    if(get('lic')) {
        if(get('redir')) {
            $lic = get('lic');
            $redir = get('redir');
            if(session('access_token')) {
                $sql = "UPDATE civilians SET $lic = 'Suspended' WHERE id = " . $redir . "";
                $conn->query($sql);
                header('Location: ../leo/nc/?sq=' . $redir);
            } else {
                header('Location: ../noauth');
            }
        }
    }
} else {
    header('Location: ../noauth');
}
?>