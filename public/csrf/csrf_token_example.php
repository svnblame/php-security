<?php
session_start();
require_once __DIR__ . '/../../csrf/csrf_request_type_functions.php';
require_once __DIR__ . '/../../csrf/csrf_token_functions.php';

if (request_is_post()) {
    if (csrf_token_is_valid()) {
        $message = 'VALID FORM SUBMISSION';

        if (csrf_token_is_recent()) {
            $message .= ' (recent)';
        } else {
            $message .= ' (not recent)';
        }
    } else {
        $message = 'CSRF TOKEN MISSION OR MISMATCHED';
    }
} else {
    // form not submitted or was a GET request
    $message = 'Please login.';
}

?>

<html lang="en">
    <head>
        <title>CSRF Example</title>
    </head>
    <body>
        <?= $message ?>
        <form action="" method="POST">
            <?= csrf_token_tag(); ?>
            <label for="username">Username:
                <input type="text" name="username" />
            </label><br>
            <label for="password">Password:
                <input type="password" name="password" />
            </label><br>
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
