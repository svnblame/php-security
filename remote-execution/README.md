## Remote System Execution

- Remotely run operating system commands on a web server
- Can run any operating system command
- Most powerful attack
- Typically hardest to achieve (unless you make it easy)
- PHP's system execution functions are what allow code to access the underlying system:
  - exec
  - passthru
  - popen
  - proc_open
  - shell_exec
  - back tick (\`)
  - system

### Remediation / Solutions

- Avoid using system execution functions unless absolutely necessary
- Perform system execution with extreme caution
- Ensure you understand the function and its syntax completely (what you don't know CAN hurt you)
- Sanitize any dynamic data carefully
- Add additional data validations
- PHP has functions to help sanitize dynamic data for use with system commands:
  - `escapeshellcmd(string)`
  - `escapeshellarg(string)`
