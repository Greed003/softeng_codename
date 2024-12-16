<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Redirect based on user type
if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] === 'admin' && basename($_SERVER['PHP_SELF']) !== 'admin.php') {
        // Redirect admin user to the admin dashboard if not already there
        header("Location: admin.php");
        exit();
    } elseif ($_SESSION['type'] === 'staff' && basename($_SERVER['PHP_SELF']) !== 'staff.php') {
        // Redirect staff user to the staff dashboard if not already there
        header("Location: staff.php");
        exit();
    } elseif ($_SESSION['type'] !== 'admin' && $_SESSION['type'] !== 'staff') {
        // If the user type is unrecognized, log out the user
        session_destroy();
        header("Location: login.php");
        exit();
    }
} else {
    // If no type is found in the session, log out the user
    session_destroy();
    header("Location: login.php");
    exit();
}
