<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include('verify.php'); ?>
    <title>Kaskada Cafe - Admin</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">
    
    <link rel="stylesheet" href="css/signin.css" type="text/css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="POST" action="">
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST" action="">
                <h3>Log in</h3>
                <input type="text" placeholder="Username" id="username" name="username" required />
                <select id="user" name="user" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
                <input type="password" placeholder="Password" id="password" name="password" required />
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error_message): ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <button type="submit">Log In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                </div>
                <div class="overlay-panel overlay-right">
                    <h3 style="color: white;">Hello, Friend!</h3>
                    <p style="color: white;">Enter your personal details and start your journey with us</p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    </script>
</body>

</html>
