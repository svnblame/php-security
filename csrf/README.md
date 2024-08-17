# Cross-Site Request Forgery

- Hacker tricks users into making a request to a third-party website (your server)
- Can be used for fraudulent clicks (requests)
- Can take advantage of a user's logged-in state to perform privileged actions

## Prevention / Solutions
- GET requests should always be idempotent
- Idempotent: makes no changes; can be called repeatedly and nothing will change
- Only use POST requests for making changes
- Store a form token in user's session
- Add a hidden field to forms with form token as value
- Compare session form token and submitted form token
- Store the token generation time in user's session  