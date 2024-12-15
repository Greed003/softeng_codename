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
        font-family: 'Open Sans';
      }
      h2 {
        margin-left: 350px;
        font-weight: 100;
        font-size: 24px;
        margin-bottom: 70px;
      }
      h1 {
        font-weight: bold;
        font-size: 46px;
        margin-bottom: 70px;
      }
      .row {
        display: flex;
        justify-content: center;
      }
      .row img {
        margin: 0 50px;
        cursor: pointer;
      }
    </style>
  </head>

  <body>
    <object data="img/logo.svg" width="430px" height="230px"></object>
    <h2>Where flavor flows</h2>
    <h1>Where will you be eating today?</h1>
    <div class="row">
      <img
        src="img/dine.png"
        alt="Dine In"
        width="208px"
        height="204px"
        onclick="setService('Dine In')"
      />
      <img
        src="img/take.png"
        alt="Take Out"
        width="208px"
        height="204px"
        onclick="setService('Take Out')"
      />
    </div>
    <script>
      function setService(serviceType) {
        // Set the selected service in local storage
        localStorage.setItem('service', serviceType);
        // Redirect to the naming.php page
        window.location.href = 'naming.php';
      }
    </script>
  </body>
</html>
