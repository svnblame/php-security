<?php

session_start();

// Forcibly end the session
function end_session(): void
{
    // Use both for compatibility with all browsers and all versions of PHP
    session_unset();
    session_destroy();
}

// Does the request IP match the stored value?
function request_ip_matches_session(): bool
{
    // return false if either value is not set
    if (! isset($_SESSION['ip']) || ! isset($_SERVER['REMOTE_ADDR'])) {
        return false;
    }

    return ($_SESSION['ip'] === $_SERVER['REMOTE_ADDR']);
}

// Does the request user agent match the stored value?
function request_user_agent_matches_session(): bool
{
    // return false if either value is not set
    if (! isset($_SESSION['user_agent']) || ! isset($_SERVER['HTTP_USER_AGENT'])) {
        return false;
    }

    return ($_SERVER['HTTP_USER_AGENT'] === $_SESSION['user_agent']);
}

// Has too much time passed since the last login?
function last_login_is_recent(): bool
{
    $max_elapsed = 60 * 60 * 24;   // 1 day

    // return false if value is not set
    if (! isset($_SESSION['last_login'])) {
        return false;
    }

    return (($_SESSION['last_login'] + $max_elapsed) >= time());
}

// Should the session be considered valid?
function is_session_valid(): bool
{
    $check_ip = true;
    $check_user_agent = true;
    $check_last_login = true;

    if ($check_ip && ! request_ip_matches_session()) {
        return false;
    }

    if ($check_user_agent && ! request_user_agent_matches_session()) {
        return false;
    }

    if ($check_last_login && ! last_login_is_recent()) {
        return false;
    }

    return true;
}

// If session is not valid, end and redirect to login page
function confirm_session_is_valid(): void
{
    if (! is_session_valid()) {
        end_session();
        // Note that header redirection requires output buffering
        // to be turned on or requires nothing has been output
        // (not even whitespace)
        header("Location: login.php");
        exit;
    }
}

// Is user logged in already?
function is_logged_in(): bool
{
    return (isset($_SESSION['logged_in']) && $_SESSION['logged_in']);
}

// If user is not logged in, end and redirect to login page
function confirm_user_logged_in(): void
{
    if (! is_logged_in()) {
        end_session();
        // Note that header redirection requires output buffering
        // to be turned on or requires nothing has been output
        // (not even whitespace)
        header("Location: login.php");
        exit;
    }
}

// Actions to perform after every successful login
function after_successful_login(): void
{
    // Regenerate session ID to invalidate the old one
    // Super important to prevent session hijacking/fixation
    session_regenerate_id();

    $_SESSION['logged_in'] = true;

    // Save these values in the session, even when checks aren't enables
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['last_login'] = time();
}

// Actions to perform after every successful logout
function after_successful_logout(): void
{
    $_SESSION['logged_in'] = false;
    end_session();
}

// Actions to perform before giving access to any restricted page
function before_protected_page(): void
{
    confirm_user_logged_in();
    confirm_session_is_valid();
}
