<?php
include 'connection.php'; // Ensure this file contains the correct connection details
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
      .row {
        flex-direction: row;
        display: flex;
        justify-content: left;
      }
      .search {
        height: 100px;
        width: 84vw;
        display: flex;
        padding-top: 30px;
        align-items: baseline;
        justify-content: center;
      }
      h2 {
        font-size: 40px;
        font-family: "Urbanist";
        font-weight: bolder;
        margin-right: 20px;
      }
      .tab,
      .col {
        display: flex;
        flex-direction: column;
      }
      .cat {
        flex-direction: column;
        display: flex;
        background-color: #ac8f64;
        width: 280px;
        height: 100vh;
        align-items: center;
      }
      .cat2 {
        font-size: 40px;
        font-family: "Urbanist";
        font-weight: bolder;
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: center;
        margin-top: 10px;
        background-color: #fffbeb;
        border-radius: 30px;
        border: 1px solid black;
        width: 261px;
        height: 93px;
      }
      #search {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: left;
        font-family: "Roboto";
        border-radius: 30px;
        border: none;
        outline: none;
        background-color: #dadada;
        width: 60vw;
        height: 60px;
        margin-bottom: 20px;
        font-size: 24px;
        padding-left: 20px;
      }
      .orders {
        flex-direction: row;
        margin: 10px;
        font-size: 24px;
        display: flex;
        align-items: center;
        text-align: left;
        justify-content: space-between;
        margin-top: 10px;
        background-color: #fffbeb;
        border-radius: 30px;
        border: 1px solid black;
        width: 1400px;
        height: 93px;
        padding-left: 20px;
        padding-right: 20px;
      }
      .orders h2 {
        margin-right: 50px;
      }
      .done {
        background-color: #483431;
        border-radius: 30px;
        width: 100px;
        height: 50px;
        font-size: 24px;
        color: white;
        font-weight: bolder;
      }
      input {
        width: 200px;
        height: 30px;
        background-color: unset;
        border: unset;
      }
    </style>
  </head>

  <body>
    <div class="row">
      <div class="tab">
        <img src="img/logo.png" width="280px" height="130px" />
        <div class="cat">
          <select name="cat2" id="cat2" class="cat2" onchange="filterOrders()">
            <option value="All">All Orders</option>
            <option value="Pending">Pending</option>
            <option value="Done">Done</option>
          </select>
        </div>
      </div>
      <div class="main">
        <div class="col">
          <div class="row search">
            <h2>Ordered Items:</h2>
            <div id="search">
              <object data="img/search.svg" width="32px" height="35px"></object>
              <input type="search" name="search" id="searchInput" placeholder="Search..." onkeyup="searchOrders()" />
            </div>
          </div>

          <div id="ordersContainer">
            <?php
            try {
                // Fetch orders and related data from the database
                $stmt = $conn->query("
                    SELECT ot.name, p.name, oi.quantity, ot.total, ot.order_date 
                    FROM order_total ot
                    JOIN order_items oi ON ot.order_item_id = oi.order_item_id
                    JOIN products p ON oi.product_id = p.product_id;
                ");

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="orders" data-state="Pending">';
                    echo '<h2>Name: ' . htmlspecialchars($row['name']) . '</h2>';
                    echo '<h2>Items: ' . $row['quantity'] . 'x ' . htmlspecialchars($row['name']) . '</h2>';
                    echo '<h2>Total: PHP ' . number_format($row['total'], 2) . '</h2>';
                    echo '<button class="done">Done</button>';
                    echo '<img src="img/arrow_up.png" width="47px" height="47px" />';
                    echo '</div>';
                }

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <script>
      function filterOrders() {
        const selectedState = document.getElementById("cat2").value;
        const orders = document.querySelectorAll(".orders");

        orders.forEach((order) => {
          const orderState = order.getAttribute("data-state");
          if (selectedState === "All" || orderState === selectedState) {
            order.style.display = "flex";
          } else {
            order.style.display = "none";
          }
        });
      }

      function searchOrders() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const orders = document.querySelectorAll(".orders");

        orders.forEach((order) => {
          const nameText = order.querySelector("h2:nth-child(1)").textContent.toLowerCase();
          const itemsText = order.querySelector("h2:nth-child(2)").textContent.toLowerCase();
          
          if (nameText.includes(searchInput) || itemsText.includes(searchInput)) {
            order.style.display = "flex";
          } else {
            order.style.display = "none";
          }
        });
      }
    </script>
  </body>
</html>
