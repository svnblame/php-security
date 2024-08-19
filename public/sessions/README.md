# Session Hijacking and Fixation

- Sessions work by storing information on the server and then giving a user's browser a cookie that contains the session ID to reference that information.
- In general, storing the information on the server is safer because it is never sent to the browser.
- You can't view the information in the cookie, and you can't observe it in transit.
- However, the session ID is sent to the browser and an attacker can steal that session ID. Once they have it, they can include it in future requests to impersonate a user.
- If the user is currently logged in, the hacker will be logged in too without needing to have any credentials.
- Session IDs are often discovered through network eavesdropping, such as on open wireless networks at coffee shops and airports.

## Session Hijacking

- A stolen session ID can access the session
- Impersonate a user
- Gain logged-in status without credentials
- Steal personal info; change password that will lock legitimate user out of their account

## Session Fixation

- Attacker tricks a user into using a hacker-provided session identifier
- Successful if user authenticates a known session identifier
- Session identifier can be in a URL string or added using Javascript

## Remediation / Solutions

- Do not accept session identifiers from GET or POST variables. (only accept from HttpOnly Cookies)
- Use HTTPOnly cookies to prevent Javascript from having access
- Use HTTPS for all web pages / resources; especially pages that require authentication
- Most of these can be managed using settings in the php.ini file:
  - `session.cookie_lifetime = 0            // until browser closed`
  - `session.use_only_cookies = 1           // ID not from GET/POST`
  - `session.cookie_httponly = 1            // prevent XSS theft`
  - `session.cookie_secure = 1              // assumes using SSL`
  - `session.cookie_samesite = "Lax"        // PHP >= 7.3 ('None', 'Lax', or 'Strict')`
- Can also be set in code BEFORE session_start() is called:
  - `session_set_cookie_params(expire, path, domain, secure, httponly)`
- Regenerate the session identifier periodically, at key points
  - Especially important to regenerate after login; then the user will have a brand new session ID and any other identifiers out in the world are now invalid.
  - This method prevents session fixation almost entirely and puts an end to any hijacked sessions
  - Expire and remove old session files regularly which can be done by keeping track of the last activity or the last user login
  - Keep track of last activity in session:
    - Track and compare the browser's user_agent string and/or the IP address to check if the requests appear to be from the same computer
    - If not, force the user to log in again
    - These aren't enough on their own, but they add defense and depth