<?php
session_start(); // Start session to store user data after successful login
include('connection.php'); 

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input to avoid SQL injection
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $type = trim($_POST['user'] ?? ''); // Match with 'user' in the HTML form

    if ($username && $password && $type) {
        try {
            // Prepare SQL statement to check user
            $stmt = $pdo->prepare("SELECT admin_id, username, password_hash FROM admin WHERE username = :username AND type = :type");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Verify password using password_verify
                if (password_verify($password, $result['password_hash'])) {
                    // Store user data in session
                    $_SESSION['user_id'] = $result['admin_id'];
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['type'] = $type;

                    // Redirect based on user type
                    if ($type === 'admin') {
                        header("Location: admin.php"); // Replace with your admin dashboard
                    } else {
                        header("Location: staff.php"); // Replace with your staff dashboard
                    }
                    exit();
                } else {
                    // Incorrect password
                    $error_message = "Invalid username or password!";
                }
            } else {
                // User not found
                $error_message = "Invalid username or password!";
            }
        } catch (Exception $e) {
            // Log the error message for debugging (optional in production)
            error_log($e->getMessage());
            $error_message = "An error occurred. Please try again.";
        }
    } else {
        $error_message = "Please fill out all fields.";
    }
}
?>