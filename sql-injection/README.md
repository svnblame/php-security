# SQL Injection

- Hacker is able to execute arbitrary SQL requests
- Can be used to steal database data
- Can be used to add, delete, or change database data

## Example
`$sql = "SELECT * FROM users ";`

`$sql .= WHERE username='${$username}' ";`

`$sql .= AND password='${password}';`

`// Values from $_POST`

`$username = "jsmith' OR 1=1; --";`

`$password = "blank";`

`SELECT * FROM users`

`WHERE username='jsmith' OR 1=1; --' AND`

`password='blank'`

## Prevention / Solutions

- Database: Give limited (least) privileges to application's database user
- PHP: Sanitize input for SQL
- PHP: Use prepared statements
- 