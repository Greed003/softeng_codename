
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('staff_verify.php'); ?>
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
        border-radius: 30px;
        border: none;
        outline: none;
        background-color: #dadada;
        width: 467px;
        height: 60px;
        margin-bottom: 20px;
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
        color: unset;
      }
      .styled-button:hover {
        background-color: #494444;
      }
      .right {
        text-align: right;
        width: 467px;
      }
    </style>
  </head>

  <body>
    <div class="row">
      <div class="logo">
        <img src="img/logo.png" width="500px" height="250px" />
      </div>
      <form action="staff_login.php" method="post" class="col">
        <div>
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
          <a href="#"><h3>Forgot Password?</h3></a>
          </div>
          <button type="submit" class="styled-button">Login</button>
        </div>
      </form>
    </div>
    <script src="script.js"></script>
  </body>
</html>