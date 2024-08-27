<?php
    if ($_POST) {
        $db = require_once __DIR__ . "/../db.inc.php";

        $salt = 'PHP_SECURITY';
        $password_hash = md5($_POST["password"]);

        $query = "SELECT `username`, `password` FROM users WHERE username = '{$_POST['username']}' AND password = '{$password_hash}'";

        $result = $db->query($query);

        /* fetch associative array */
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                printf("Hello, %s", $row['username']);
            }
        } else {
            print "Invalid username or password.";
        }

        exit(0);
    }
?>

<form action="/login.php" method="POST">
    <p><label for="username">Username: <input type="text" name="username"></label></p>
    <p><label for="password">Password: <input type="password" name="password"></label></p>
    <p><input type="submit" value="Log In"></p>
</form>
