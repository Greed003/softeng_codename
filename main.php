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
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        text-align: center;
      }

      h1 {
        font-family: '"Open Sans"';
        font-weight: bolder;
        font-size: 48px;
        margin-bottom: 70px;
      }
      .row {
        display: flex;
        justify-content: center;
      }
      .row img {
        margin: 0 75px;
      }
    </style>
  </head>

  <body>
    <img src="img/logo.png" width="507px" height="247px" />
    <h1>Welcome!</h1>
    <div class="row">
      <a href="#">
        <img src="img/admin.png" alt="admin" width="208px" height="204px" />
      </a>
      <a href="staff_login.php">
        <img src="img/staff.png" alt="staff" width="208px" height="204px" />
      </a>
    </div>
    <script src="script.js"></script>
  </body>
</html>
