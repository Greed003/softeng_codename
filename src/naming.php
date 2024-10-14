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
        margin: 0; /* Remove default body margin */
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
      input {
        border-radius: 30px;
        border: none;
        outline: none;
        background-color: #dadada;
        width: 861px;
        height: 83px;
        margin-bottom: 70px;
        font-size: 46px;
        padding-left: 20px;
      }
      .styled-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 313px;
        height: 67px;
        padding: 10px 20px; /* Adjust padding as needed */
        border: none; /* Remove default border */
        border-radius: 30px; /* Set border radius */
        background-color: #483431; /* Button background color */
        font-family: Roboto;
        font-weight: bold;
        color: #eeeeee; /* Text color */
        font-size: 32px; /* Font size */
        cursor: pointer; /* Change cursor to pointer */
        transition: background-color 0.3s; /* Smooth transition */
      }

      .styled-button:hover {
        background-color: #494444; /* Change background on hover */
      }
    </style>
  </head>

  <body>
    <object data="logo.svg" width="430px" height="230px"></object>
    <h2>Where flavor flows</h2>
    <h1>What should we call you?</h1>
    <input type="text" id="Name" name="name" />
    <a href="menu.php">
    <div class="styled-button">Done</div>
    </a>
    <script src="script.js"></script>
  </body>
</html>
