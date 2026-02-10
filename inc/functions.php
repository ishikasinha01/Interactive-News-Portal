<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// CSRF TOKEN
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function check_csrf($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Rate Limit (1 comment per 20 seconds)
function can_post_comment($article_id) {
    $key = "last_comment_".$article_id;
    $last = $_SESSION[$key] ?? 0;

    if (time() - $last < 20) {
        return false;
    }

    $_SESSION[$key] = time();
    return true;
}
?>
