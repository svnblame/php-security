<?php

// 1. Connect
$mysqli = new mysqli("localhost", "username", "password", "test");

if ($mysqli->connect_errno) {
    die("Database connection failed: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error);
}

// 2. Prepare
$sql = "SELECT id, username FROM users WHERE username = ? AND password = ?";
$stmt = $mysqli->prepare($sql);

if (! $stmt) {
    die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
}

// 3. Bind parameters
// s = string
// i = integer
// d = double (float)
// b = blob (binary data)
$username = 'testuser';
$password = 'secret';

$bind_result = $stmt->bind_param('ss', $username, $password);

if (! $bind_result) {
    echo "Bind failed: (" . $stmt->errno . ") " . $stmt->error;
}

// 4. Execute
$exec_result = $stmt->execute();

if (! $exec_result) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

// $stmt->store_result();

// 5. Bind selected columns to variables
$stmt->bind_result($id, $username);

// 6. Use results
while($stmt->fetch()) {
    echo 'ID: ' . $id . '<br />';
    echo 'Username: ' . $username . '<br />';
    echo '<br />';
}

// 7. Free results
$stmt->free_result();

// 8. Close statement
$stmt->close();

// 9. Close MySQL connection
$mysqli->close();
