<?php // Sanitize functions
// Make sanitizing easy and you will do it often

// Sanitize for HTML output
function h(string $string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Sanitize for Javascript output
function j(string $string) {
    return json_encode($string, JSON_UNESCAPED_UNICODE);
}

// Sanitize for use in a URL
function u(string $string) {
    return urlencode($string);
}


// Usage examples
echo h("<h1>Test string</h1><br>");
echo j("'}; alert('Gotcha!'); //");
echo u("?title=Working? Or not?");
