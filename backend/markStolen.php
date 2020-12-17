<?php
include '../functions.php';

if (isStaff(1)) {
    if(get('id')) {
        if(get('redir')) {
            $id = get('id');
            if(session('access_token')) {
                $sql = "UPDATE vehicles SET stolen = 'Yes' WHERE id = " . $id . "";
                $conn->query($sql);
                header('Location: ../leo/vc/?sq=' . $id);
            } else {
                header('Location: ../noauth');
            }
        }
    }
} else {
    header('Location: ../noauth');
}
?>