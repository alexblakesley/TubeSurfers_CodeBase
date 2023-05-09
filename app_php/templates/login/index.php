<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Perform authentication here
  if ($username == "guest" && $password == "TubeSurfer") {
    // If authentication is successful, set a session id and redirect to the index.html page
    $_SESSION['logged_in'] = true;
    header('Location: ../');
    exit;
  }
}

?>

<form action="" method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login">
</form>