<?php
include '../functions.php';

if (isStaff(1)) {
    if(get('id')) {
        if(get('redir')) {
            $lic = get('id');
            $redir = get('redir');
            if(session('access_token')) {
                
                $sql = "DELETE FROM warrants WHERE civId = $redir"
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