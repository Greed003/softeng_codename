<?php
include('connection.php'); 

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare SQL statement to check user
  $stmt = $pdo->prepare("SELECT password_hash FROM admin WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
      // Verify password using PHP password_verify
      $hashed_password = $result['password_hash'];
      if (password_verify($password, $hashed_password)) {
          // Correct password; redirect to home page
          header("Location: orders.php");
          exit();
      } else {
          // Incorrect password
          $error_message = "Invalid username or password!";
      }
  } else {
      // User not found
      $error_message = "Invalid username or password!";
  }
}
?>