<?php
include('connection.php'); 

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are set
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $type = $_POST['user'] ?? ''; // Match with 'user' in the HTML form

    if ($username && $password && $type) {
        // Prepare SQL statement to check user
        $stmt = $pdo->prepare("SELECT password_hash FROM admin WHERE username = :username AND type = :type");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Verify password using PHP password_verify
            $hashed_password = $result['password_hash'];
            if (password_verify($password, $hashed_password)) {
                // Redirect based on user type
                if ($type === 'admin') {
                    header("Location: admin.php"); // Replace with your admin page
                } else {
                    header("Location: staff.php"); // Replace with your staff page
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
    } else {
        $error_message = "Please fill out all fields.";
    }
}
?>