<?php
function clean_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function escape($conn, $data){
    return mysqli_real_escape_string($conn, $data);
}
?>
