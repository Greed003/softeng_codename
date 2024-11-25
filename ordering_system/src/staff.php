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
        position: absolute;
        margin: 0;
        font-family: 'Urbanist';
        font-weight: 600;
        width: 100vw;
      }
      .row {
        flex-direction: row;
        display: flex;
        justify-content: space-between;
      }
      .search {
        height: auto;
        width: 100%;
        display: flex;
        padding-top: 10px;
        align-items: center;
        justify-content: space-between;
        padding-left: 20px;
      }
      .tab,
      .col {
        display: flex;
        flex-direction: column;
      }
      .right {
        width: 410px;
      }
      .cat {
        flex-direction: column;
        display: flex;
        background-color: #ac8f64;
        width: auto;
        height: 100vh;
        align-items: left;
      }
      .cat2 {
        font-size: 20px;
        font-family: "Urbanist";
        font-weight: bolder;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-size: 40px 40px;
        margin: 10px 10px 0 10px;
        background-color: #fffbeb;
        border-radius: 20px;
        border: 1px solid black;
        width: auto;
        height: auto;
        padding: 10px;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 20px;
        flex-direction: row;
        cursor: pointer;
      }
      .cat3 {
        display: none;
        font-size: 20px;
        font-family: "Urbanist";
        font-weight: bolder;
        align-items: center;
        justify-content: center;
        margin: 5px 10px 0 10px;
        background-color: #fffbeb;
        border-radius: 20px;
        border: 1px solid black;
        width: 140px;
        height: auto;
        padding-top: 20px;
        padding-bottom: 20px;
        cursor: pointer;
      }
      #search {
        margin-left: 10px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: left;
        font-family: "Roboto";
        border-radius: 20px;
        border: none;
        outline: none;
        background-color: #dadada;
        width: auto;
        height: auto;
        font-size: 24px;
        padding: 10px;
      }
      .input {
        margin-left: 10px;
        width: calc(100vw - 600px);
        height: 25px;
        background-color: unset;
        border: unset;
        font-size: 20px;
        font-weight: bold;
      }
      .input:focus {
        background-color: transparent;
        border: none;
        outline: none;
      }
      .fo {
        font-size: 38px;
        font-weight: 600;
      }
      .items {
        display: none;
      }
      .mar {
        margin: 0;
      }
      .txt {
        white-space: nowrap;
        overflow: hidden;
      }
      .to {
        text-overflow: ellipsis;
      }
      .w {
        width: 180px;
        margin-right: 10px;
      }
      .w2 {
        width: 210px;
      }
      .col2 {
        display: flex;
        flex-direction: row;
      }
      .col3 {
        display: flex;
        flex-direction: column;
      }
      .tc {
        display: none;
      }
      .line {
            display: block;
            border: none; /* Remove default styling */
            height: 2px;  /* Line thickness */
            background-color: #D9D9D9; /* Line color */
            margin: 20px 0; /* Spacing around the line */
            width: 100%;
        }
        .drop{
          display: none;
          flex-direction: column;
          align-items: center;
        }
        .orders {
        flex-direction: column;
        font-size: 16px;
        display: flex;
        text-align: left;
        justify-content: space-between;
        background-color: #fffbeb;
        border-radius: 20px;
        border: 1px solid black;
        width: auto;
        height: auto;
        padding: 20px;
        margin-left: 20px;
        margin-bottom: 10px;
      }
      
      tr {
        display: flex;
        justify-content: space-between;
        width: 500px;
      }
      .input2{
        background-color: gainsboro;
        border-radius: 30px;
        text-align: center;
        width: 80px;
        height: 20px;
        border: unset;
        color: black;
        font-weight: bolder;
      }
      .done{
        margin-top: 10px;
        background-color: #AC8F64;
        border-radius: 30px;
        text-align: center;
        width: 100px;
        height: 30px;
        border: unset;
        color: black;
        font-weight: bolder;
      }
      .print{
        display: none;
      }

    </style>
  </head>

  <body>
    <div class="row">
      <div class="tab">
        <img src="img/logo2.png" width="200px" height="100px" />
        <div class="cat">
          <div class="cat2">
            Orders
            <img
              src="img/arrow_down.png"
              id="dropdown"
              width="30px"
              height="30px"
              style="margin-left: 20px; cursor: pointer;"
            />
          </div>
          <div class="cat3" data-filter="All">
            All
          </div>
          <div class="cat3" data-filter="Pending">
            Pending
          </div>
          <div class="cat3" data-filter="Completed">
            Completed
          </div>
        </div>
      </div>
      <div class="main">
        <div class="col">
          <div class="row search">
            <h2 class="fo">Ordered Items:</h2>
            <div id="search">
              <object data="img/search.svg" width="25px" height="25px"></object>
              <input
              class="input"
                type="search"
                name="search"
                placeholder="Search..."
                id="searchInput"
              />
            </div>
          </div>
          <?php include('get_orders.php'); ?>
          <div class="orders" data-status="Pending">
            <div class="row">
              <h2 class="mar w">Name: Reyes</h2>
              <h2 class="mar">Service: Dine In</h2>
              <h2 class="mar w">Total: ₱160.00</h2>
              <h2 class="mar">Status: Pending</h2>
              <img
                src="img/arrow_down.png"
                class="mar toggle-arrow"
                width="30px"
                height="30px"
              />
            </div>
            <div class="drop">
              <div class="line"></div>
              <table>
                <tr>
                  <th><h2 class="mar">Items</h2></th>
                  <th><h2 class="mar">Price</h2></th>
                </tr>
                <tr>
                  <td><h3 class="mar"id="product">1x Americano Hot 12oz</h3>
                    <h4 class="mar"id="addons">Add ons: 1x Shot Espresso
                      <br>&emsp;&emsp;&emsp;&emsp;1x Coffee Syrup<br>&emsp;&emsp;&emsp;&emsp;1x Coffee Sauce</h4></td>
                  <td><h3 class="mar"id="price">₱125.00</h3></td>
                </tr>
                <tr>
                  <td><h3 class="mar"id="product">1x Coffee Bun</h3><h4 class="mar"id="addons"></h4></td>
                  <td><h3 class="mar" id="price">₱35.00</h3></td>
                </tr>
              </table>
              <div class="line"></div>
              <table>
                <tr>
                  <th><h2 class="mar">Total:</h2></th>
                  <th><h2 class="mar" id="total">₱160.00</h2></th>
                </tr>
                <tr>
                  <td><h3 class="mar">Cash:</h3></td>
                  <td><input class="input2" type="text" id="cash" name="cash" placeholder=""/></td>
                </tr>
                <tr class="table">
                </tr>
                <tr>
                  <td></td>
                  <td><button class="done submit">Submit</button><button class="done print">Print</button></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="orders" data-status="Pending">
            <div class="row">
              <h2 class="mar w">Name: Rv</h2>
              <h2 class="mar">Service: Take Out</h2>
              <h2 class="mar w">Total: ₱260.00</h2>
              <h2 class="mar">Status: Pending</h2>
              <img
                src="img/arrow_down.png"
                class="mar toggle-arrow"
                width="30px"
                height="30px"
              />
            </div>
            <div class="drop">
              <div class="line"></div>
              <table>
                <tr>
                  <th><h2 class="mar">Items</h2></th>
                  <th><h2 class="mar">Price</h2></th>
                </tr>
                <tr>
                  <td><h3 class="mar"id="product">1x Americano Hot 12oz</h3>
                    <h4 class="mar"id="addons">Add ons: 1x Shot Espresso
                      <br>&emsp;&emsp;&emsp;&emsp;1x Coffee Syrup<br>&emsp;&emsp;&emsp;&emsp;1x Coffee Sauce</h4></td>
                  <td><h3 class="mar"id="price">₱125.00</h3></td>
                </tr>
                <tr>
                  <td><h3 class="mar"id="product">1x Coffee Bun</h3><h4 class="mar"id="addons"></h4></td>
                  <td><h3 class="mar" id="price">₱35.00</h3></td>
                </tr>
                <tr>
                  <td><h3 class="mar"id="product">1x Cafe Latte Hot 12oz</h3>
                    <h4 class="mar"id="addons">Add ons: 1x Shot Espresso</h4></td></td>
                  <td><h3 class="mar" id="price">₱100.00</h3></td>
                </tr>
              </table>
              <div class="line"></div>
              <table>
                <tr>
                  <th><h2 class="mar">Total:</h2></th>
                  <th><h2 class="mar" id="total">₱260.00</h2></th>
                </tr>
                <tr>
                  <td><h3 class="mar">Cash:</h3></td>
                  <td><input class="input2" type="text" id="cash" name="cash" placeholder=""/></td>
                </tr>
                <tr class="table">
                </tr>
                <tr>
                  <td></td>
                  <td><button class="done submit">Submit</button><button class="done print">Print</button></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      // Search functionality
      document.getElementById("searchInput").addEventListener("input", function () {
        const searchValue = this.value.toLowerCase().trim();
        const orders = document.querySelectorAll(".orders");
    
        orders.forEach((order) => {
          const nameElement = order.querySelector(".w");
          const orderName = nameElement.textContent.toLowerCase();
    
          if (orderName.includes(searchValue)) {
            order.style.display = "flex"; // Show the order
          } else {
            order.style.display = "none"; // Hide the order
          }
        });
      });
    
      // Toggle .cat3 elements display
      document.getElementById("dropdown").addEventListener("click", function () {
        const categories = document.querySelectorAll(".cat3");
        categories.forEach((category) => {
          if (category.style.display === "none" || category.style.display === "") {
            category.style.display = "flex";
          } else {
            category.style.display = "none";
          }
        });
    
        // Change the arrow image
        const arrow = document.getElementById("dropdown");
        if (arrow.src.includes("arrow_down.png")) {
          arrow.src = "img/arrow_up.png";
        } else {
          arrow.src = "img/arrow_down.png";
        }
      });
    
      // Filter orders based on category selection
      const categories = document.querySelectorAll(".cat3");
      categories.forEach((category) => {
        category.addEventListener("click", function () {
          const filterValue = this.getAttribute("data-filter");
          const orders = document.querySelectorAll(".orders");
    
          orders.forEach((order) => {
            const orderStatus = order.getAttribute("data-status");
    
            if (filterValue === "All" || orderStatus === filterValue) {
              order.style.display = "flex"; // Show the order
            } else {
              order.style.display = "none"; // Hide the order
            }
          });
    
          // Clear the search input when changing categories
          document.getElementById("searchInput").value = "";
          // Reset display to show all orders on 'All Orders' selection
          if (filterValue === "All") {
            orders.forEach((order) => {
              order.style.display = "flex"; // Show all orders
            });
          }
        });
      });
    
      // Toggle order details when arrow is clicked
      const orderArrows = document.querySelectorAll(".toggle-arrow");
      orderArrows.forEach((arrow) => {
        arrow.addEventListener("click", function () {
          const dropSection = this.closest(".orders").querySelector(".drop");

          if (dropSection.style.display === "none" || !dropSection.style.display) {
            // Show the drop section
            dropSection.style.display = "flex";
            // Change arrow to 'arrow up'
            arrow.src = "img/arrow_up.png";
          } else {
            // Hide the drop section
            dropSection.style.display = "none";
            // Change arrow to 'arrow down'
            arrow.src = "img/arrow_down.png";
          }
        });
      });

      // Handle the Submit button click
 // Function to handle Submit button click
document.querySelectorAll(".submit").forEach((button) => {
  button.addEventListener("click", function () {
    const orderContainer = this.closest(".drop");
    const cashInput = orderContainer.querySelector("#cash");
    const totalElement = orderContainer.querySelector("#total");
    const submitButton = this;
    const printButton = orderContainer.querySelector(".print");

    // Get cash input and total
    const cashValue = parseFloat(cashInput.value) || 0;
    const totalValue = parseFloat(totalElement.textContent.replace("₱", "")) || 0;

    // Validate cash input
    if (cashValue < totalValue) {
      alert("Insufficient cash!");
      return;
    }

    // Calculate change
    const changeValue = cashValue - totalValue;
      // Store the order details in localStorage for the receipt page
// Store the order details in localStorage for the receipt page
const orderDetails = {
          products: [],
          total: totalValue,
          cash: cashValue,
          change: changeValue,
        };

    // Get product details
    const products = orderContainer.querySelectorAll("#product");
    const prices = orderContainer.querySelectorAll("#price");
    const addons = orderContainer.querySelectorAll("#addons");
    
    products.forEach((product, index) => {
      orderDetails.products.push({
        name: product.textContent,
        addons: addons[index] ? addons[index].innerHTML : '',
        price: prices[index] ? prices[index].innerHTML : '',
      });
    });

    // Store the data in localStorage
    localStorage.setItem('orderDetails', JSON.stringify(orderDetails));
    console.log(orderDetails);
    // Update the cash input to display value as text
    const cashCell = cashInput.closest("td");
    cashCell.innerHTML = `<h3 class="mar">₱${cashValue.toFixed(2)}</h3>`;

    // Add a new row for change
    const table = orderContainer.querySelector(".table");
    const changeRow = document.createElement("tr");
    changeRow.innerHTML = `
      <td><h3 class="mar">Change:</h3></td>
      <td><h3 class="mar" id="change">₱${changeValue.toFixed(2)}</h3></td>
    `;
    table.appendChild(changeRow);

    // Update the status to "Completed"
    const statusElement = this.closest(".orders").querySelector("h2.mar:nth-child(4)");
    statusElement.textContent = "Status: Completed";

    // Update the status attribute
    this.closest(".orders").dataset.status = "Completed";

    // Hide Submit button and show Print button
    submitButton.style.display = "none";
    printButton.style.display = "inline-block";
  });
});
    
const printButtons = document.querySelectorAll(".print");
  printButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const printWindow = window.open(
        "receipt.html",
        "PrintWindow",
        "width=600,height=800"
      );

      printWindow.addEventListener("load", function () {
        printWindow.print();
      });
    });
  });


    </script>    
  </body>
</html>