<!DOCTYPE html>
<html lang="en">
  <?php include('connection.php'); ?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kaskada Cafe</title>
    <style>
      body {
        background-color: #f4f4f4;
        display: flex;
        height: 100vh;
        margin: 0;
        text-align: center;
        flex-direction: column;
      }
      .top {
        margin-top: 30px;
        display: flex;
        justify-content: center;
      }
      .container {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 30px;
        background-color: hsl(0, 0%, 85%);
        width: 841px;
        height: 63px;
        margin-bottom: 70px;
        padding: 10px;
        font-size: 46px;
        font-weight: bold;
        margin: 0 20px;
      }
      #search {
        font-family: Rosarivo;
        border: none;
        outline: none;
        background-color: #dadada;
        font-size: 25px;
        width: 800px;
        height: 63px;
      }
      .order {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 252px;
        height: 83px;
        border: none; 
        border-radius: 30px; 
        background-color: #ac8f64;
        cursor: pointer; 
        transition: background-color 0.3s; 
      }
      .text1 {
        margin-left: 20px;
        font-family: Rosarivo;
        font-weight: bold;
        color: #483431; 
        font-size: 20px;
      }
      .main-content {
        display: flex;
        margin-top: 50px;
      }

    .cat {
      margin: 0 40px;
      background-color: #ffffff;
      width: 159px;
      height: 541px;
      border-radius: 30px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
        0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .menu {
      display: flex;
      flex-wrap: wrap; 
      justify-content: flex-start; 
      margin-left: 20px;
    }

    .product {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding-top: 10px;
      padding-bottom: 10px;
      margin: 30px; 
      background-color: #ffffff;
      height: 515px;
      width: 350px; 
      border-radius: 30px;
      border: 2px solid transparent; 
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
                  0 6px 20px 0 rgba(0, 0, 0, 0.19);
      transition: border-color 0.3s; 
    }

    .product:hover {
      border-color: #ac8f64; 
    }

    .cat img {
      margin: 20px 0;
    }
      
      h2 {
        font-size: 30px;
        font-family: "Rosarivo";
      }
      .price {
        margin-top: 30px;
        display: flex;
        align-items: center;
        justify-content: right;
        flex-direction: row;
        background-color: #dadada;
        border-radius: 12px;
        height: 47px;
        width: 133px;
      }
      h3 {
        font-size: 20px;
        font-family: "Open Sans";
        font-weight: bold;
        margin-right: 20px;
      }
      .product #img {
        border-radius: 20px; /* Adjust the value as needed */
      }
    </style>
  </head>

  <body>
    <div class="top">
      <object data="img/logo.svg" width="159px" height="83px" margin="0 50px"></object>
      <div class="container">
        <input
          type="text"
          id="search"
          name="search"
          placeholder="Browse your favorite here..."
        />
        <img src="img/search.png" id="icon" alt="search" width="32px" height="35.2px" />
      </div>
      <button class="order">
        <img src="img/bell.png" alt="order" width="48px" height="38px" />
        <h2 class="text1">MY ORDER</h2>
      </button>
    </div>
  
    <div class="main-content">
      <div class="cat">
        <img src="img/bread.png" id="icon" alt="search" width="159px" height="140px" />
        <img src="img/coffee2.png" id="icon" alt="search" width="159px" height="140px" />
        <img src="img/pizza1.png" id="icon" alt="search" width="159px" height="140px" />
      </div>
    
      <div class="menu">
        <?php
          $sql = "SELECT * FROM products WHERE type_id = 5";

          $stmt = $conn->query($sql);
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach ($rows as $row): ?>                             
        <div class="product">
          <img src="<?php echo $row['img']; ?>" style="border-radius: 20px;" id="icon" width="309px" height="309px"/>
          <h2><?php echo $row['name']; ?></h2>
          <div class="price">
            <h3>₱<?php echo $row['price']; ?></h3>
            <img src="img/plus.png" id="icon" alt="plus" width="47px" height="47px" />
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

  </body>
</html>
