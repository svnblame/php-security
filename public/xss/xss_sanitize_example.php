<?php

require_once(__DIR__ . '/../../xss/xss_sanitize_functions.php');

// XSS Prevention examples
echo h("<h1>Test string</h1><br>");
echo j("'}; alert('Gotcha!'); //");
echo u("?title=Working? Or not?");

echo '<p><a href="../index.php">Home</a></p>';
