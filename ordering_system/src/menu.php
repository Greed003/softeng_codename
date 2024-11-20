<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('connection.php'); ?>
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
        text-align: center;
        flex-direction: column;
      }
      .top {
        flex-wrap: wrap;
        margin-top: 30px;
        display: flex;
        justify-content: center;
        flex-direction: row;
      }
      .container {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        text-align: center;
        border-radius: 30px;
        background-color: hsl(0, 0%, 85%);
        width: calc(100vw - 700px);
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
        width: calc(100vw - 600px);
        height: 63px;
      }
      .order {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 230px;
        height: 83px;
        border: none; /* Remove default border */
        border-radius: 30px; /* Set border radius */
        background-color: #ac8f64;
        cursor: pointer; /* Change cursor to pointer */
        transition: background-color 0.3s; /* Smooth transition */
      }
      .text1 {
        margin-left: 20px;
        font-family: Rosarivo;
        font-weight: bold;
        color: #483431; /* Text color */
        font-size: 20px;
      }
      .main-content {
        display: flex;
        margin-top: 50px;
      }

      .cat {
        margin: 0 40px;
        background-color: #ffffff;
        width: 159px; /* Fixed width */
        height: 950px; /* Allow height to adjust */
        border-radius: 30px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
          0 6px 20px 0 rgba(0, 0, 0, 0.19);
          padding-top: 20px;
      }

      .menu {
        display: flex;
        flex-wrap: wrap; /* Allow products to wrap to the next line */
        justify-content: flex-start; /* Align products to the left */
        margin-left: 20px; /* Space between category and products */
      }

      .product {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding-top: 20px;
        padding-bottom: 20px;
        margin: 30px; /* Adjust margin for spacing */
        background-color: #ffffff;
        height: 500px;
        width: 350px; /* Adjust width for three products */
        border-radius: 30px;
        border: 2px solid transparent; /* Initial border style */
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
                    0 6px 20px 0 rgba(0, 0, 0, 0.19);
        transition: border-color 0.3s; /* Smooth transition for border color */
      }

      .product:hover {
        border-color: #ac8f64; /* Change this to your desired hover border color */
      }
      
      a{
        text-decoration: none;
        color: unset;
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
        width: auto;
        padding-left: 10px;
      }
      h3 {
        font-size: 20px;
        font-family: "Open Sans";
        font-weight: bold;
        margin-right: 10px;
      }
      .overlay {
        display: none;
        position: fixed; /* Fixed position to cover the viewport */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3); /* Semi-transparent black */
        z-index: 1; /* Ensure it's above other content */
      }
      .order_container {
        display: flex;
        flex-direction: column;
        position: fixed; /* Fixed position to cover the viewport */
        top: 0;
        right: -500px; /* Hide it off-screen to the right */
        width: 479px;
        height: 100%;
        background-color: #F4F4F4; /* Semi-transparent black */
        z-index: 1;
        transition: right 0.5s ease; /* Smooth sliding transition */
      }

      .order_container.active {
        right: 0; /* Slide it in from the right */
      }
      .overlay.active {
        display: block; /* Make overlay visible */
      }
      .row {
        display: flex;
        flex-direction: row;
        margin: 20px 30px 20px 30px;
        justify-content: space-between; /* Add this line */
        width: 419px;
        align-items: center;
      }
      .total {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #e9e9e9;
        width: 479px;
        height: 209px;
        position: fixed;
        bottom: 0;
        border-top: 2px solid;
        border-color: rgba(0, 0, 0, 0.2);
      }
      .total_btn {
        border-radius: 30px;
        background-color: #d65c43;
        width: 402px;
        height: 64px;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .item {
        flex-direction: column;
        display: flex;
        text-align: left;
        margin-left: 27px;
        justify-content: center;
      }
      .item_con {
        display: flex;
        background-color: #ffffff;
        height: auto;
        width: 402px;
        border-radius: 20px;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2),
          0 2px 2px 0 rgba(0, 0, 0, 0.19);
        padding: 10px;
        align-items: center;
        flex-direction: column;
        margin-bottom: 20px;
      }
      .scroll{
        flex-wrap: wrap;
        overflow-y:auto;
        height: calc(100vh - 440px);
      }
      .pr_img {
        border-radius: 20px;
        border: 1px solid #483431;
        width: 121px;
        height: 115px;
      }
      .name_con {
        flex-direction: column;
        justify-content: space-between;
        margin-left: 20px;
      }
      .rows {
        display: flex;
        flex-direction: row;
        width: 240px;
        justify-content: space-between;
        align-items: center;
      }
      .name {
        font-size: 25px;
      }
      #price{
        font-size: 16px;
      }
      .f20 {
        font-size: 20px;
        font-weight: 400;
      }
      .f40 {
        font-size: 40px;
        font-weight: 600;
      }
      .f30 {
        font-size: 30px;
        font-weight: 500;
      }
      /* .menu2 {
        border-radius: 20px;
        font-size: 30px;
        font-weight: 600;
        background-color: #AC8F64;
        border: 3px solid black;
        width: 159px;
        color: #483431;
        margin: 20px;
      } */
      button{
        border: unset;
        background: none;
      }
      .price img, #ok, .total_btn {
        cursor: pointer; 
      }
      .quantity{
        font-size: 24px;
      }
      h2, .name{
        color:#483431;
      }
      .flex_row{
        flex-direction: row;
        display: flex;
      }
      .x{
        display: flex;
        width: 100%;
        justify-content: right;
      }
      .check_over {
        display: none;
        position: fixed; /* Fixed position to cover the viewport */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3); /* Semi-transparent black */
        z-index: 1; /* Ensure it's above other content */
        justify-content: center;
        align-items: center;
      }
      .check{
        display: none;
        border-radius: 30px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 479px;
        height: auto;
        background-color: #F4F4F4; /* Semi-transparent black */
        z-index: 1;
        transition: right 0.5s ease; /* Smooth sliding transition */
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2),
          0 2px 2px 0 rgba(0, 0, 0, 0.19);
      }
      .check_n{
        display: flex;
        width: 459px;
        border-bottom: 2px solid #dddbdb;
        padding-left: 20px;
        font-weight: 500;
      }
      .check_n1{
        padding-left: 20px;
        font-weight: 500;
        font-size: 19px;
        text-align: left;
      }
      .check_n2{
        font-weight: 600;
        font-size: 20px;
        cursor: pointer;
      }
      .check_n3{
        font-weight: 500;
        font-size: 10px;
        margin-bottom: 20px;
      }
      .check_n4{
        color: #776363;
        font-size: 16px;
      }
      .check_n5{
        
        font-size: 16px;
      }
      .check_oc{
        width: 380px;
        height: auto;
        border-radius: 30px;
        border: 1px solid;
        padding: 10px 20px 10px 20px;
        text-align: center;
      }
      .check_b{
        display:flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin: 10px;
        width: 170px;
        height: 56px;
        background-color: #cd4226d5;
        border-radius: 30px;
      }
      .check_d{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
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
        <img src="img/bread.png" id="bread" alt="bread" width="159px" height="140px" data-type-id="5" />
        <img src="img/coffee2.png" id="coffee" alt="coffee" width="159px" height="140px" data-type-id="1" />
        <img src="img/non-coffee2.png" id="non-coffee" alt="non-coffee" width="159px" height="140px" data-type-id="2" />
        <img src="img/soda2.png" id="soda" alt="soda" width="159px" height="140px" data-type-id="3" />
        <img src="img/pizza2.png" id="pizza" alt="pizza" width="159px" height="140px" data-type-id="4" />
      </div>
    
      <div class="menu" id="menu">
      <?php include('get_products.php'); ?>
      </div>
    </div>
    <div class="overlay"></div>
    <div class="order_container">
      <div class="row">
        <h1 class="f40">My Order</h1>
        <h1 class="f20">HIDE ></h1>
      </div>
      <div class="item">
        <h1 class="f30">Total Order</h1>
        <div class="scroll">
        </div>
      </div>
      <div class="total">
        <div class="row">
          <h2 class="text3">Total</h2>
          <h2 class="text1">₱00.00</h2>
        </div>
        <div class="total_btn">
          <h2 class="text3">CHECKOUT</h2>
        </div>
      </div>
    </div>
    <div class="check_over">
      <div class="check">
        <h1 class="check_n">Checkout</h1>
        <p class="check_n1">Thank you for ordering. Kindly wait for your name to be called.</p>
        <div class="check_oc">
            <div class="check_p">  
                <div class="check_d">
                    <h6 class="check_n5">Orders</h6>
                    <h6 class="check_n5">Price</h6>
                </div>
            </div>
            <h5 class="check_n5" id="check_n5">Total: ₱00.00</h5>
        </div>
        <div class="check_b" id="ok">
          <p class="check_n2">OK</p>
        </div>
        
        <h3 class="check_n3">If you have any complaints or issues kindly move to the cashier for customer support.</h3>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const orderButton = document.querySelector(".order");
        const orderContainer = document.querySelector(".order_container");
        const overlay = document.querySelector(".overlay");
        const totalButton = document.querySelector(".total_btn");
        const checkOver = document.querySelector(".check_over");
        const checkSection = document.querySelector(".check");
        let totalAmount = 0;
        //
        const categoryImages = document.querySelectorAll(".cat img");

        const searchInput = document.getElementById('search');

        // Function to re-apply search functionality to updated product elements
        function attachSearchFunctionality() {
            const products = document.querySelectorAll('.product');
            searchInput.addEventListener('keyup', function () {
                const searchText = searchInput.value.toLowerCase().trim();

                // Loop through all product elements
                products.forEach(product => {
                    const productName = product.getAttribute('data-product-name').toLowerCase();

                    // Check if the product name includes the search text
                    if (productName.includes(searchText)) {
                        product.style.display = 'flex'; // Show matching products
                    } else {
                        product.style.display = 'none'; // Hide non-matching products
                    }
                });
            });
        }
        attachSearchFunctionality();

  categoryImages.forEach(image => {
    image.addEventListener("click", function() {
      const selectedTypeId = this.getAttribute("data-type-id");

      // Change the image source based on the clicked category
      if (this.id) {
        this.src = `img/${this.id}.png`; // Change to the new image with a "2" suffix
      }

      // Reset other images to their original state
      categoryImages.forEach(img => {
        if (img.id !== this.id) {
          img.src = `img/${img.id}2.png`; // Reset to original image without "2"
        }
      });

      // Update the URL to reflect the current type_id (optional)
      const url = new URL(window.location.href);
      url.searchParams.delete('type_id'); // Remove the type_id parameter
      window.history.pushState({}, '', url); // Update the URL without reloading

      // Refresh the products
      refreshProducts(selectedTypeId);
    });
  });

  function refreshProducts(typeId) {
    const menu = document.getElementById("menu");
    const searchInput = document.getElementById('search');
    searchInput.value = ''; 
    // Fetch new products based on selected type_id (AJAX)
    fetch(`get_products.php?type_id=${typeId}`)
      .then(response => response.text())
      .then(data => {
        menu.innerHTML = data; // Update the menu with new products
        attachAddButtons(); // Re-attach event listeners for add buttons
        attachSearchFunctionality();
      })
      .catch(error => console.error('Error fetching products:', error));
  }

  function attachAddButtons() {
    const addButtons = document.querySelectorAll(".add");
    addButtons.forEach(button => {
      button.addEventListener("click", function() {
        const productElement = this.closest(".product");
        const productName = productElement.querySelector("h2").innerText;
        const priceText = productElement.querySelector(".price h3").innerText;
        const sizeText = productElement.querySelector(".price h3[id='size']").innerText; // Get size
        const price = parseFloat(priceText.replace("₱", ""));

        // Call your existing function to add the product to the order
        addProductToOrder(productName, price, productElement.querySelector("img").src, sizeText); // Pass size
      });
    });
  }

        // Function to toggle the order container and overlay visibility
        function toggleOrderContainer() {
          orderContainer.classList.toggle("active");
          overlay.classList.toggle("active");
        }
  
        // Add event listener to the order button
        orderButton.addEventListener("click", toggleOrderContainer);
  
        // Close the order container when clicking on the overlay
        overlay.addEventListener("click", toggleOrderContainer);
  
        function addProductToOrder(productName, price, imageSrc, size) {
          const itemContainer = document.querySelector(".scroll");

          // Create the product HTML element
          const newItem = document.createElement("div");
          newItem.classList.add("item_con");

          newItem.innerHTML = `
              <div class="x">
                  <img src="img/delete.png" alt="delete" class="delete" style="border-radius: 50px;" width="25px" height="25px"/>
              </div>
              <div class="flex_row">
                  <div class="pr_img">
                      <img src="${imageSrc}" alt="${productName}" style="border-radius: 20px;" width="121px" height="115px"/>
                  </div>
                  <div class="name_con">
                      <div class="rows">
                          <h1 class="name" style="margin-left:10px;">${productName}</h1><h1 class="size name" id="size">${size ? size: ''}</h1>
                      </div> 
                      <div class="rows">
                          <img src="img/minus.png" alt="minus" class="minus" style="border-radius: 12px;" width="47px" height="47px"/>
                          <h1 class="quantity">1</h1>
                          <img src="img/plus.png" alt="plus" class="plus" style="border-radius: 12px;" width="47px" height="47px"/>
                          <h1 class="name" id="price">₱${price.toFixed(2)}</h1>
                      </div>
                  </div>
              </div>
          `;

          // Add the new product to the order list
          itemContainer.appendChild(newItem);

          // Convert price to a number and add it to the total
          totalAmount += parseFloat(price);
          updateTotal();

          // Add event listeners for the plus and minus buttons
          const plusButton = newItem.querySelector(".plus");
          const minusButton = newItem.querySelector(".minus");
          const quantityDisplay = newItem.querySelector(".quantity");

          // Function to handle the plus button
          plusButton.addEventListener("click", function () {
              const currentQuantity = parseInt(quantityDisplay.innerText);
              const newQuantity = currentQuantity + 1;
              quantityDisplay.innerText = newQuantity;
              
              // Update the price displayed for the item
              //const priceElement = newItem.querySelector("#price");
              //priceElement.innerText = `₱${(parseFloat(price) * newQuantity).toFixed(2)}`;
              
              totalAmount += parseFloat(price); // Increase total
              updateTotal();
          });

          // Function to handle the minus button
          minusButton.addEventListener("click", function () {
              const currentQuantity = parseInt(quantityDisplay.innerText);
              if (currentQuantity > 1) {
                  const newQuantity = currentQuantity - 1;
                  quantityDisplay.innerText = newQuantity;
                  
                  // Update the price displayed for the item
                  //const priceElement = newItem.querySelector("#price");
                  //priceElement.innerText = `₱${(parseFloat(price) * newQuantity).toFixed(2)}`;
                  
                  totalAmount -= parseFloat(price); // Decrease total
                  updateTotal();
              }
          });

          // Add event listener for the delete button
          const deleteButton = newItem.querySelector(".delete");
          deleteButton.addEventListener("click", function () {
              const quantity = parseInt(quantityDisplay.innerText);
              totalAmount -= (quantity * parseFloat(price)); // Adjust total amount
              updateTotal();
              itemContainer.removeChild(newItem); // Remove the item from the order list
          });
        }

        // Function to update the total price
        function updateTotal() {
          const totalDisplay = document.querySelector(".total .text1");
          totalDisplay.innerText = `₱${totalAmount.toFixed(2)}`;
        }
  
        // Attach click event to each plus button in the product list
        const plusButtons = document.querySelectorAll(".price img");
  
        plusButtons.forEach((button) => {
          button.addEventListener("click", function () {
            const productElement = button.closest(".product");
            const productName = productElement.querySelector("h2").innerText;
            const priceText = productElement.querySelector(".price h3").innerText;
            const imageSrc = productElement.querySelector("img").src;
  
            // Remove "₱" from the price text and convert it to a number
            const price = parseFloat(priceText.replace("₱", ""));
            
            // Add the product to the order list
            addProductToOrder(productName, price, imageSrc);
          });
        });
  
       // Function to navigate to the check section
        // Function to navigate to the check section
        function showCheckSection() {
          const itemContainer = document.querySelector(".scroll");
          const checkContainer = document.querySelector(".check_p"); // Check section container
          const totalDisplay = document.querySelector("#check_n5"); 

          // Loop through each item in the order list and add to the check section
          const items = itemContainer.querySelectorAll(".item_con");
          let totalCheckAmount = 0; // Initialize a variable to hold the total amount for the check section

          items.forEach(item => {
              const productName = item.querySelector(".name").innerText;
              const quantity = parseInt(item.querySelector(".quantity").innerText);
              const priceText = item.querySelector("#price").innerText; // Get the price directly from the #price element
              const price = parseFloat(priceText.replace("₱", "").trim()); // Remove "₱" and convert to a number
              const size = item.querySelector("#size").innerText; // Get the size element

              totalCheckAmount += price; 

              const checkItem = document.createElement("div");
              checkItem.classList.add("check_d");
              checkItem.innerHTML = `
                  <h1 class="check_n4 quantity" id="q">${quantity}x</h1>
                  <h1 class="check_n4 product-name" id="pn">${productName}</h1>
                  <h1 class="check_n4 size" id="size">${size}</h1> 
                  <h1 class="check_n4 p" id="p">₱${price.toFixed(2)}</h1>
              `;
              checkContainer.appendChild(checkItem);
          });

          // Update total in the check section
          if (totalDisplay) {
              totalDisplay.innerText = `Total: ₱${totalCheckAmount.toFixed(2)}`; 
          } else {
              console.error("Total display element not found.");
          }

          // Show the check section
          checkSection.style.display = "flex";
          checkOver.style.display = "flex"; 
        }


        // Attach event listener to the total button
        totalButton.addEventListener("click", showCheckSection);
        function insertOrderIntoDatabase() {
    const checkItems = document.querySelectorAll(".check_d"); // Select each check item properly
    let orderData = [];
    const userName = localStorage.getItem("userName") || "Guest"; // Default to "Guest" if no name

    checkItems.forEach(item => {
        // Use more specific selectors based on your inner HTML structure
        const quantityElement = item.querySelector(".quantity"); // Change to class selector
        const nameElement = item.querySelector(".product-name"); // Change to class selector
        const priceElement = item.querySelector(".p"); // Change to class selector
        const sizeElement = item.querySelector(".size"); // Change to class selector

        // Check if the item has the required elements
        if (nameElement && priceElement && quantityElement) {
            const quantity = parseInt(quantityElement.innerText.replace("x", "").trim()); // Extract quantity
            const price = parseFloat(priceElement.innerText.replace("₱", "").trim()); // Extract price

            orderData.push({
                productName: nameElement.innerText, // Use innerText for product name
                quantity: quantity,
                price: price,
                size: sizeElement ? sizeElement.innerText : '' // Ensure size is included even if undefined
            });
        } else {
            console.error("Could not retrieve product information.", {
                nameElement: nameElement ? nameElement.innerText : null,
                quantityElement: quantityElement ? quantityElement.innerText : null,
                priceElement: priceElement ? priceElement.innerText : null
            }); // Debugging output with checks
        }
    });

    console.log(orderData);
  const total = parseFloat(document.querySelector("#check_n5").innerText.replace("Total: ₱", "").trim());

    fetch('insert_order.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ 
          userName: userName,
          total: total,
          orderItems: orderData
      })
  })
  .then(response => response.text()) // Change this to text() for debugging
  .then(data => {
      console.log(data); // Log the raw response
      return JSON.parse(data); // Try parsing it to JSON
  })
  .then(data => {
      if (data.success) {
          alert("Order placed successfully!");
          window.location.href = 'index.php';
      } else {
          alert("Error placing order: " + data.error);
      }
  })
  .catch(error => {
      console.error('Error:', error);
      alert("An error occurred while placing the order.");
  });

}

  // Attach event listener to the OK button
  document.getElementById("ok").addEventListener("click", insertOrderIntoDatabase);

      });
      
  </script>
  
      
  </body>
</html>