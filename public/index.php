<?php
    $token = md5(uniqid(rand(), true));
    $_SESSION['token'] = $token;

    $url = [];
    $html = [];

    $url['token'] = rawurlencode($token);
    $html['token'] = htmlentities($url['token'], ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Security</title>
<!--    <link rel="stylesheet" href="./style.css">-->
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
  </head>
  <body>
    <main>
        <h1>PHP Security</h1>

        <ul>
            <li><a href="xss/xss_sanitize_example.php">XSS Cross-Site Scripting</a></li>
            <li><a href="csrf/csrf_token_example.php">CSRF Cross Site Request Forgery</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="index.php?token=<?= $html['token'] ?>">Click Here</a></li>
        </ul>
    </main>
<!--	<script src="index.js"></script>-->
  </body>
</html>
