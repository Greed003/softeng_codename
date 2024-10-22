<?php
include('connection.php'); 

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare SQL statement to check user
  $stmt = $conn->prepare("SELECT password_hash FROM staff WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
      // Verify password using PHP password_verify
      $hashed_password = $result['password_hash'];
      if (password_verify($password, $hashed_password)) {
          // Correct password; redirect to home page
          header("Location: home.php");
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Kaskada Cafe</title>
    <style>
      body {
        background-color: #f4f4f4;
        display: flex;
        height: 100vh;
        margin: 0;
      }
      h1 {
        color: #483431;
      }
      .row {
        display: flex;
        justify-content: left;
      }
      .logo {
        display: flex;
        background-color: #f5f5dc;
        width: 50vw;
        height: 100vh;
        justify-content: center;
        align-items: center;
      }
      .col {
        display: flex;
        width: 50vw;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 0;
        text-align: center;
      }
      .left {
        text-align: left;
      }
      input {
        font-family: "Roboto";
        border-radius: 30px;
        border: none;
        outline: none;
        background-color: #dadada;
        width: 467px;
        height: 60px;
        margin-bottom: 20px;
        font-size: 24px;
        padding-left: 20px;
      }
      .styled-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 480px;
        height: 60px;
        padding: 10px 20px;
        border: none;
        border-radius: 30px;
        background-color: #483431;
        font-family: Roboto;
        font-weight: bold;
        color: #eeeeee;
        font-size: 24px;
        cursor: pointer;
        transition: background-color 0.3s;
      }
      a {
        text-decoration: none;
      }
      .styled-button:hover {
        background-color: #494444;
      }
      .right {
        text-align: right;
        width: 467px;
      }
      .error-message {
        color: red;
        font-size: 18px;
        margin-bottom: 20px;
      }
    </style>
  </head>

  <body>
    <div class="row">
      <div class="logo">
        <img src="img/logo.png" width="500px" height="250px" />
      </div>
      <form action="login.php" method="post">
        <div class="col">
          <h1>WELCOME BACK</h1>
          <h3>Please enter your login information</h3>
          <div class="left">
            <h2>Username</h2>
            <input type="text" id="Name" name="username" placeholder="Username" required />
          </div>
          <div class="left">
            <h2>Password</h2>
            <input
              type="password"
              id="Password"
              name="password"
              placeholder="Password"
              required
            />
          </div>
          <!-- Display error message here -->
          <?php if (!empty($error_message)) : ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
          <?php endif; ?>
          <div class="right">
            <h3><a href="#">Forgot Password?</a></h3>
          </div>
          <button type="submit" class="styled-button">Login</button>
        </div>
      </form>
    </div>
    <script src="script.js"></script>
  </body>
</html>
