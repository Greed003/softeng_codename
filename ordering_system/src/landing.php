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
      h2 {
        margin-left: 350px;
        font-family: Open Sans;
        font-weight: 100;
        font-size: 24px;
        margin-bottom: 70px;
      }
      h1 {
        font-family: Open Sans;
        font-weight: bold; /* Corrected property name */
        font-size: 46px;
        margin-bottom: 70px;
      }
      .row {
        display: flex;
        justify-content: center;
      }
      .row img {
        margin: 0 50px;
      }
    </style>
  </head>

  <body>
    <object data="img/logo.svg" width="430px" height="230px"></object>
    <h2>Where flavor flows</h2>
    <h1>Where will you be eating today?</h1>
    <div class="row">
      <a href="naming.php">
        <img src="img/dine.png" alt="dine in" width="208px" height="204px" />
      </a>
      <a href="naming.php">
        <img src="img/take.png" alt="take out" width="208px" height="204px" />
      </a>
    </div>
    <script src="script.js"></script>
  </body>
</html>
