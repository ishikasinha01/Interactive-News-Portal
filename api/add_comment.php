<?php
// api/add_comment.php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405); exit('Method Not Allowed');
}

// CSRF check
$token = $_POST['csrf_token'] ?? '';
if (!check_csrf($token)) {
  $_SESSION['form_error'] = 'Session expired. Please refresh and try again.';
  header('Location: ../article.php?id=' . intval($_POST['article_id'] ?? 0));
  exit;
}

// required fields
$article_id = intval($_POST['article_id'] ?? 0);
$comment_text = trim($_POST['comment'] ?? '');
$name = trim($_POST['name'] ?? null);
$email = trim($_POST['email'] ?? null);
$user = $_SESSION['user'] ?? null;

// basic validation
if ($article_id <= 0 || $comment_text === '') {
  $_SESSION['form_error'] = 'Please write a comment.';
  header('Location: ../article.php?id=' . $article_id);
  exit;
}

// rate limit (per session)
if (!can_post_comment($article_id)) {
  $_SESSION['form_error'] = 'You are posting too fast. Please wait a little and try again.';
  header('Location: ../article.php?id=' . $article_id);
  exit;
}

// sanitize minimal — store raw text, escape on output
$ip = $_SERVER['REMOTE_ADDR'] ?? null;
$user_id = $user['id'] ?? null;
if ($user_id) {
  // if logged in, fill name/email from user
  $name = $user['name'] ?? $name;
  $email = $user['email'] ?? $email;
}

// anti-spam simple checks
if (strlen($comment_text) < 3) {
  $_SESSION['form_error'] = 'Comment too short.';
  header('Location: ../article.php?id=' . $article_id);
  exit;
}

// decide default status: if user is logged in -> auto-approve, else pending
$status = $user_id ? 'approved' : 'pending';

// Prepared statement insert
$stmt = $mysqli->prepare("INSERT INTO comments (article_id, user_id, name, email, comment, status, ip_address) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param('iisssss', $article_id, $user_id, $name, $email, $comment_text, $status, $ip);
$ok = $stmt->execute();
$stmt->close();

if (!$ok) {
  $_SESSION['form_error'] = 'Unable to save comment. Try later.';
  header('Location: ../article.php?id=' . $article_id);
  exit;
}

// record engagement (optional): add view/comment event
$e = $mysqli->prepare("INSERT INTO engagements (article_id, user_id, session_id, event) VALUES (?,?,?,?)");
$sess = session_id();
$event = 'comment';
$uid = $user_id ?? null;
$e->bind_param('iiss', $article_id, $uid, $sess, $event);
$e->execute();
$e->close();

// success message
if ($status === 'approved') {
  $_SESSION['form_success'] = 'Comment posted.';
} else {
  $_SESSION['form_success'] = 'Comment submitted for review.';
}

header('Location: ../article.php?id=' . $article_id . '#comments');
exit;
