<?php

$db_user = 'sweetscomplete';
$db_pass = 's3cr3t!*';
$db_name = 'sweetscomplete';
$db_host = 'localhost';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

return new mysqli($db_host, $db_user, $db_pass, $db_name);
