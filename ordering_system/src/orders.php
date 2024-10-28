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
        justify-content: left;
      }
      .search {
        height: auto;
        width: auto;
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
      .cat4 {
        position: fixed;
        bottom: 20px;
        height: 60px;
        width: 180px;
        justify-content: center;
        padding:0;
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
      .orders {
        flex-direction: row;
        font-size: 16px;
        display: flex;
        text-align: left;
        justify-content: space-between;
        background-color: #fffbeb;
        border-radius: 20px;
        border: 1px solid black;
        width: calc(100vw - 300px);
        height: auto;
        padding: 20px;
        margin-left: 20px;
        margin-bottom: 10px;
      }
      .done {
        background-color: #483431;
        border-radius: 30px;
        width: 120px;
        height: 30px;
        font-size: 16px;
        color: white;
        font-weight: bolder;
        cursor: pointer;
      }
      input {
        margin-left: 10px;
        width: calc(100vw - 600px);
        height: 25px;
        background-color: unset;
        border: unset;
        font-size: 20px;
        font-weight: bold;
      }
      input:focus {
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
      .hidden {
        background-color: transparent;
        border: 1px solid;
        width: 120px;
        height: 30px;
      }
      a{
        text-decoration: none;
        color: unset;
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
          <a href="main.php" id="doneButton">
            <div class="cat2 cat4">
                Log Out
            </div>
          </a>
        </div>
      </div>
      <div class="main">
        <div class="col">
          <div class="row search">
            <h2 class="fo">Ordered Items:</h2>
            <div id="search">
              <object data="img/search.svg" width="25px" height="25px"></object>
              <input
                type="search"
                name="search"
                placeholder="Search..."
                id="searchInput"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
  /// Fetch orders from get_orders.php and render them
  function fetchOrders() {
  fetch('get_orders.php')
    .then(response => response.json())
    .then(orders => {
      const ordersContainer = document.querySelector(".main .col");

      // Group orders by `order_id` and `name` to handle items properly
      const groupedOrders = {};
      orders.forEach(order => {
        if (!groupedOrders[order.order_id]) {
          groupedOrders[order.order_id] = {
            order_id: order.order_id,
            name: order.name,
            status: order.status,
            total: order.total,
            items: []
          };
        }
        groupedOrders[order.order_id].items.push({
          quantity: order.quantity,
          product_name: order.product_name
        });
      });

      // Render each grouped order
      Object.values(groupedOrders).forEach(order => {
        const orderElement = document.createElement("div");
        orderElement.classList.add("orders");
        orderElement.setAttribute("data-status", order.status);
        orderElement.setAttribute("data-order-id", order.order_id);
        let itemsHtml = '';
        order.items.forEach((item, index) => {
          if (index === 0) {
            // For the first item, use the specific format
            itemsHtml += `<h2 class="mar to txt">Items: ${item.quantity}x ${item.product_name}&emsp;</h2>`;
          } else {
            // For subsequent items, use the normal format
            itemsHtml += `<h2 class="mar tc">&emsp;&emsp;&emsp;${item.quantity}x ${item.product_name}</h2>`;
          }
        });
        // Determine whether to show the button based on order status
        const buttonHtml = order.status === "Completed" 
          ? `<button class="done mar hidden">Completed</button>` 
          : `<button class="done mar">Completed</button>`;

        orderElement.innerHTML = `
          <div class="col2">
            <h2 class="mar txt to w">Name: ${order.name}</h2>
            <div class="mar col3 txt w2">${itemsHtml}</div>
          </div>
          <h2 class="mar">Total: ₱${parseFloat(order.total).toFixed(2)}</h2>
          <h2 class="mar status">Status: ${order.status}</h2>
          ${buttonHtml}
          <img src="img/arrow_down.png" class="toggle-arrow" width="30px" height="30px" />
        `;

        ordersContainer.appendChild(orderElement);
      });

      // Reapply event listeners (e.g., search)
      setupEventListeners();
    })
    .catch(error => {
      console.error('Error fetching orders:', error);
    });
}

// Setup event listeners (search functionality, dropdown toggle, etc.)
function setupEventListeners() {
    const doneButtons = document.querySelectorAll('.done');
    doneButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const orderElement = button.closest('.orders');
            const orderId = orderElement.getAttribute('data-order-id'); // This should be set correctly
            const newStatus = 'Completed'; // or whatever status you want to set

            console.log(`Updating Order ID: ${orderId} New Status: ${newStatus}`);  // Log the orderId for debugging

            fetch('update_order_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ order_id: orderId, status: newStatus }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Optionally, update the UI to reflect the new status
                    orderElement.querySelector('.status').textContent = `Status: ${newStatus}`;
                    button.classList.add('hidden');
                } else {
                    console.error('Failed to update order status:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    // Existing event listeners for search, dropdown, etc.
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
      category.style.display = (category.style.display === "none" || category.style.display === "") ? "flex" : "none";
    });

    // Change the arrow image
    const arrow = document.getElementById("dropdown");
    arrow.src = arrow.src.includes("arrow_down.png") ? "img/arrow_up.png" : "img/arrow_down.png";
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
      const order = arrow.parentElement;
      const expanded = order.classList.toggle("details");

      // Change arrow direction and update styles
      arrow.src = expanded ? "img/arrow_up.png" : "img/arrow_down.png";
      order.querySelector(".w").style.width = expanded ? "390px" : "180px";
      order.querySelector(".w2").style.width = expanded ? "390px" : "210px";
      order.querySelector(".col2").style.flexDirection = expanded ? "column" : "row";
      order.querySelectorAll(".tc").forEach((item) => {
        item.style.display = expanded ? "flex" : "none";
      });
    });
  });
}

// Fetch orders on page load
window.onload = fetchOrders;

    </script>
  </body>
</html>
