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
        height: 390px;
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
      .add_btn1 {
        border-radius: 30px;
        background-color: #d65c43;
        width: 250px;
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        cursor: pointer;
        font-size: small;
        font-weight: lighter;
        margin-top: 20px;
      }
      .pd {
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
      .des{
        padding: 30px;
        display: flex;
        border-radius: 30px;
        width: auto;
        height: auto;
        flex-direction: column;
        background-color: #F4F4F4; /* Semi-transparent black */
        z-index: 1;
        transition: right 0.5s ease; /* Smooth sliding transition */
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2),
          0 2px 2px 0 rgba(0, 0, 0, 0.19);
      }
      .des2{
        display: flex;
        flex-direction: row;
      }
      .des3{
        padding-left: 20px;
        text-align: left;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
      .pdt1{
        font-size: 40px;
        margin-top: 0;
        font-family:'Times New Roman', Times, serif;
      }
      .addons{
        background-color: white;
        border-radius: 30px;
        border: 2px solid;
        width: 150px;
        height: auto;
        text-align: center;
        font-weight: bold;
        margin-right: 10px;
        cursor: pointer;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2),
          0 2px 2px 0 rgba(0, 0, 0, 0.19);
      }
      .pdp{
        width: 500px;
      }
    .pdrow{
        display: flex;
        flex-direction: row;
        margin-bottom: 20px;
    }
    .pdprice{
        font-size: 38px;
        font-weight: bold;
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        margin-left: 10px;
        margin: 0;
        margin-right: 20px;
      }
      .hh5{
        margin: 0;
        margin-bottom: 10px;
      }
      .va{
        display: block;
      }
      .ao{
        display: block;
      }
      #icon{
        cursor: pointer;
      }
      .quan{
        padding-left: 10px;
        padding-right: 10px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        width: 120px;
        height: 47px;
        border-radius: 30px;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2),
          0 2px 2px 0 rgba(0, 0, 0, 0.19);
        border: 1px solid;
      }
      .cprice{
        display: flex;
        flex-direction: row;
      }
      .minus, .plus{
        cursor: pointer;
        color: #AC8F64;
      }
      .xx {
        width: 100%;
        text-align: right;
      }
      .opd{
        height: 150px;
      }
      .hot{
        display: block;
      }
      .cold{
        display: block;
      }
      .hco{
        display: flex;
        flex-direction: row;
      }
      .ino{
        display: none;
        flex-direction: row;
      }
      .cf{
        display: flex;
      }
      .pz{
        display: none;
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
        <img id="arrow-back" src="img/arrow-right.png" id="soda" alt="soda" width="80px" height="40px" cursor="pointer"/>
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
    <div class="pd">
  <div class="des">
    <div class="des2">
      <img id="product-img" src="img/coffee_bun.png" alt="product" width="450px" height="450px" style="margin-top: 30px; border-radius: 20px;"/>
      <div class="des3">
        <div class="xx">
          <img src="img/x.png" id="icon" class="close1" alt="close" width="30px" height="30px"/>
        </div>
        <div>
          <h1 class="pdt1" id="product-name">Coffee Bun</h1>
          <p class="pdp" id="product-description">A coffee bun is a sweet, soft bread roll topped with a crunchy, coffee-flavored glaze.</p>
        </div>
        <div class="opd">
          <div class="va">
            <h5 class="hh5">OPTION</h5>
            <div class="hco">
              <div class="hot">
                <img id="hot-option" data-size="Hot 12oz" src="img/hot.png" alt="hot" width="130px" height="130px" />
              </div>
              <div class="cold">
                <img id="cold-option" data-size="Cold 16oz" src="img/cold1.png" alt="cold" width="130px" height="130px" />
              </div>
            </div>
            <div class="ino">
              <div class="ten">
                <img id="ten-option" data-size="10\"" src="img/10inch.png" alt="10\"" width="130px" height="130px" />
              </div>
              <div class="twelve">
                <img id="twelve-option" data-size="12\"" src="img/12inch1.png" alt="12\"" width="130px" height="130px" />
              </div>
            </div>
          </div>
        </div>
        <div class="ao">
          <h5 class="hh5">ADD ONS</h5>
          <div class="pdrow cf">
            <div class="addons shot_espresso" data-add-ons="" data-add-price="25">Shot Espresso</div>
            <div class="addons coffee_syrup" data-add-ons=""  data-add-price="15">Coffee Syrup</div>
            <div class="addons coffee_sauce" data-add-ons="" data-add-price="20">Coffee Sauce</div>
          </div>
          <div class="pdrow pz">
            <div class="addons" data-add-ons="" data-add-price="70">Mozzarella 100g</div>
            <div class="addons" data-add-ons="" data-add-price="40">Pepperoni 100g</div>
            <div class="addons" data-add-ons="" data-add-price="20">Pineapple 50g</div>
            <div class="addons" data-add-ons="" data-add-price="30">Ham 50g</div>
          </div>
        </div>
        <div class="">
          <div class="cprice">
            <h3 class="pdprice" id="product-price">₱35</h3>
            <div class="quan">
              <h1 class="minus">-</h1>
              <h1 class="quantity1">1</h1>
              <h1 class="plus">+</h1>
            </div>
          </div>
          <div class="add_btn1">
            <h3 class="">ADD TO CART</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const orderButton = document.querySelector(".order");
        const arrowBack = document.querySelector("#arrow-back");
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
        
        function showProductDetails(product) {
    const pdContainer = document.querySelector(".pd"); // The container for product details
    const pz = document.querySelector(".pz");
    const cf = document.querySelector(".cf");
    const ino = document.querySelector(".ino");
    const hco = document.querySelector(".hco");

    // Populate the details with the clicked product data
    document.getElementById("product-img").src = product.img;
    document.getElementById("product-name").textContent = product.name;
    document.getElementById("product-description").textContent = product.description;

    // Set initial price for the first size option
    const initialSize = product.sizes[0]; // Default to the first size
    document.getElementById("product-price").textContent = `₱${initialSize.price}`;

    // Option buttons logic
    const hotOption = document.getElementById("hot-option");
    const coldOption = document.getElementById("cold-option");
    const tenOption = document.getElementById("ten-option");
    const twelveOption = document.getElementById("twelve-option");

    const hot = document.querySelector(".hot");

    // Set size and price for Hot and Cold options dynamically
    hotOption.setAttribute("data-size", initialSize.size);
    hotOption.setAttribute("data-price", initialSize.price);
    hotOption.src = "img/hot.png"; // Default hot option image

    coldOption.setAttribute("data-size", product.sizes[1]?.size || "Cold 16oz");
    coldOption.setAttribute("data-price", product.sizes[1]?.price || initialSize.price);
    coldOption.src = "img/cold1.png"; // Default cold option image

    // Set size and price for 10-inch and 12-inch options dynamically
    tenOption.setAttribute("data-size", "10\"");
    tenOption.setAttribute("data-price", product.sizes[0]?.price || initialSize.price);
    tenOption.src = "img/10inch.png"; // Default 10-inch option image

    twelveOption.setAttribute("data-size", "12\"");
    twelveOption.setAttribute("data-price", product.sizes[1]?.price || initialSize.price);
    twelveOption.src = "img/12inch1.png"; // Default 12-inch option image

    // Remove existing event listeners and add new ones for Hot, Cold, 10-inch, and 12-inch options
    hotOption.replaceWith(hotOption.cloneNode(true));
    coldOption.replaceWith(coldOption.cloneNode(true));
    tenOption.replaceWith(tenOption.cloneNode(true));
    twelveOption.replaceWith(twelveOption.cloneNode(true));

    const newHotOption = document.querySelector("#hot-option");
    const newColdOption = document.querySelector("#cold-option");
    const newTenOption = document.querySelector("#ten-option");
    const newTwelveOption = document.querySelector("#twelve-option");

    // Hot Option Click Event
    newHotOption.addEventListener("click", function () {
        newHotOption.src = "img/hot.png"; // Update hot option image
        newColdOption.src = "img/cold1.png"; // Reset cold option image
        document.getElementById("product-price").textContent = `₱${newHotOption.getAttribute("data-price")}`;
        // Reset all selected add-ons
        resetAddons();
    });

    // Cold Option Click Event
    newColdOption.addEventListener("click", function () {
        newColdOption.src = "img/cold.png"; // Update cold option image
        newHotOption.src = "img/hot1.png"; // Reset hot option image
        document.getElementById("product-price").textContent = `₱${newColdOption.getAttribute("data-price")}`;
        // Reset all selected add-ons
        resetAddons();
    });

    // 10-inch Option Click Event
    newTenOption.addEventListener("click", function () {
        newTenOption.src = "img/10inch.png"; // Update 10-inch option image
        newTwelveOption.src = "img/12inch1.png"; // Reset 12-inch option image
        document.getElementById("product-price").textContent = `₱${newTenOption.getAttribute("data-price")}`;
        // Reset all selected add-ons
        resetAddons();
    });

    // 12-inch Option Click Event
    newTwelveOption.addEventListener("click", function () {
        newTwelveOption.src = "img/12inch.png"; // Update 12-inch option image
        newTenOption.src = "img/10inch1.png"; // Reset 10-inch option image
        document.getElementById("product-price").textContent = `₱${newTwelveOption.getAttribute("data-price")}`;
        // Reset all selected add-ons
        resetAddons();
    });

    // Reset Add-ons function
    function resetAddons() {
        const addons = document.querySelectorAll('.addons');
        addons.forEach(addon => {
            addon.style.backgroundColor = ''; // Reset background color
            addon.setAttribute('data-add-ons', ''); // Clear the selected add-on data
        });
    }

    // Display product size options based on product attributes
    const vaSection = document.querySelector(".va");
    const aoSection = document.querySelector(".ao");

    if (!product.sizes || product.sizes.length === 0 || product.sizes.some(size => !size.size)) {
        vaSection.style.display = "none";
    } else {
        vaSection.style.display = "block";
    }

    if (product.sizes.length === 1 && product.sizes[0].size === "Cold 16oz") {
        hot.style.display = "none"; // Hide the hot option
        newColdOption.src = "img/cold.png";
    } else {
        hot.style.display = "block"; // Show the hot option
    }

    if (product.type_id === "1") {
        aoSection.style.display = "block";
        pz.style.display = "none";
        cf.style.display = "flex";
    } else if (product.type_id === "4") {
        aoSection.style.display = "block";
        pz.style.display = "flex";
        cf.style.display = "none";
        ino.style.display = "flex";
        hco.style.display = "none";
    } else {
        aoSection.style.display = "none";
    }

    pdContainer.style.display = "flex";

    // Reset quantity and set up listeners
    const quantityElement = document.querySelector(".quantity1");

    const minusButton = document.querySelector(".minus");
    const plusButton = document.querySelector(".plus");

    minusButton.replaceWith(minusButton.cloneNode(true));
    plusButton.replaceWith(plusButton.cloneNode(true));

    const newMinusButton = document.querySelector(".minus");
    const newPlusButton = document.querySelector(".plus");

    newMinusButton.addEventListener("click", function () {
        if (quantity > 1) {
            quantity -= 1;
            quantityElement.textContent = quantity;
        }
    });

    newPlusButton.addEventListener("click", function () {
        quantity += 1;
        quantityElement.textContent = quantity;
    });
    handleAddonSelection();
    const priceElement = document.getElementById("product-price");
    attachAddButton(product, quantityElement, priceElement); // Pass priceElement for real-time updates
    let quantity = 1; // Reset quantity to 1
    quantityElement.textContent = quantity;
}


// Function to handle addon selection and price update
function handleAddonSelection() {
    const addons = document.querySelectorAll('.addons'); // Select all addon elements
    const priceElement = document.getElementById("product-price"); // Element that displays the price

    addons.forEach(addon => {
        addon.addEventListener('click', function() {
            // Get the price of the selected addon from data-add-price attribute
            const addonPrice = parseFloat(addon.getAttribute('data-add-price')) || 0;

            // Get the current product price displayed
            let currentPrice = parseFloat(priceElement.textContent.replace('₱', '').trim());

            // Check if the addon is already selected
            const currentAddonText = addon.textContent.trim();
            if (addon.style.backgroundColor === 'rgb(172, 143, 100)') {  // RGB equivalent of your color
                addon.style.backgroundColor = ''; // Reset the background color
                addon.setAttribute('data-add-ons', ''); // Remove the text from data-add-ons
                currentPrice -= addonPrice; // Subtract the addon price if deselected
            } else { // If not selected, mark it as selected
                addon.style.backgroundColor = '#AC8F64'; // Change background color when selected
                addon.setAttribute('data-add-ons', `1x ${currentAddonText}`); // Save the addon text with "1x" to data-add-ons
                currentPrice += addonPrice; // Add the addon price if selected
            }

            // Update the price display with the new total
            priceElement.textContent = `₱${currentPrice.toFixed(2)}`;
        });
    });
}
// Call the function to enable addon selection and price update

function attachAddButton(product, quantityElement, priceElement) {
    const addButton = document.querySelector(".add_btn1");
    if (!addButton) {
        console.error("Add button not found in product details.");
        return;
    }

    addButton.replaceWith(addButton.cloneNode(true));
    const newButton = document.querySelector(".add_btn1");

    newButton.addEventListener("click", function () {
        const hotOption = document.querySelector("#hot-option");
        const coldOption = document.querySelector("#cold-option");

        let size = hotOption.src.includes("hot.png")
            ? hotOption.getAttribute("data-size")
            : coldOption.getAttribute("data-size");

        let price = hotOption.src.includes("hot.png")
            ? hotOption.getAttribute("data-price")
            : coldOption.getAttribute("data-price");

        size = size === null || size === "null" ? "" : size;
        price = price === null || price === "null" ? "0" : price;

        // Get the selected add-ons from data-add-ons attribute
        const selectedAddons = [];
        const addons = document.querySelectorAll('.addons');
        addons.forEach(addon => {
            const addonText = addon.getAttribute('data-add-ons');
            if (addonText) {
                selectedAddons.push(addonText); // Add the text of selected addon
            }
        });
        const productPriceText = priceElement.textContent; // Use the specific price element passed to the function
        console.log("Adding product:", {
            name: product.name,
            size: size,
            price: productPriceText,
            img: product.img,
            quantity: parseInt(quantityElement.textContent, 10),
            addons: selectedAddons // Add the selected add-ons data
        });

        // Add product to order with add-ons
        addProductToOrder(product.name, productPriceText, product.img, size, parseInt(quantityElement.textContent, 10), selectedAddons);
        closeDetails();
    });
}


// Close the product details view
function closeDetails() {
    const pdContainer = document.querySelector(".pd");
    pdContainer.style.display = "none";
     // Reset all selected add-ons
    const addons = document.querySelectorAll('.addons');
    addons.forEach(addon => {
        addon.style.backgroundColor = ''; // Reset background color
        addon.setAttribute('data-add-ons', ''); // Clear the selected add-on data
    });
}

// Attach event listeners to products
function attachProductButtons() {
    const products = document.querySelectorAll(".product");

    products.forEach(productElement => {
        productElement.addEventListener("click", function () {
            const product = {
                name: productElement.getAttribute("data-product-name"),
                description: productElement.getAttribute("data-product-description"),
                img: productElement.getAttribute("data-product-img"),
                sizes: JSON.parse(productElement.getAttribute("data-sizes")), // Parsing JSON data for sizes
                type_id: productElement.getAttribute("data-type-id")
            };
            showProductDetails(product);
        });
    });
}
attachProductButtons();
// Close the product details when the close button is clicked
document.querySelectorAll(".xx").forEach(closeButton => {
    closeButton.addEventListener("click", function () {
        closeDetails();
    });
});

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
       // Re-attach event listeners for add buttons
        attachSearchFunctionality();
        attachProductButtons();
      })
      .catch(error => console.error('Error fetching products:', error));
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
        arrowBack.addEventListener("click", toggleOrderContainer);
  
        function addProductToOrder(productName, price, imageSrc, size, quantity, addons) {
          const itemContainer = document.querySelector(".scroll");
          price = parseFloat(price.replace('₱', '').trim());
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
                      <h5 class="add_ons" style="margin-right: 40px; margin:0; color: gray;">${addons}</h5>
                      <div class="rows">
                          <img src="img/minus.png" alt="minus" class="minus" style="border-radius: 12px;" width="47px" height="47px"/>
                          <h1 class="quantity">${quantity}</h1>
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
              const addonsElement = item.querySelector(".add_ons");
              const addons = addonsElement ? addonsElement.innerText : '';
              const formattedAddons = addons.split(",").map(addon => `<li>${addon.trim()}</li>`).join("");

              totalCheckAmount += price; 

              const checkItem = document.createElement("div");
              checkItem.classList.add("check_d");
              checkItem.innerHTML = `
                  <h1 class="check_n4 quantity" id="q">${quantity}x</h1>
                  <h1 class="check_n4 product-name" id="pn">${productName}</h1>
                  <h1 class="check_n4 size" id="size">${size}</h1> 
                  <h1 class="check_n4 add_ons" id="add_ons">${formattedAddons}</h1> 
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
        const add_ons = item.querySelector(".add_ons");
        // Check if the item has the required elements
        if (nameElement && priceElement && quantityElement) {
            const quantity = parseInt(quantityElement.innerText.replace("x", "").trim()); // Extract quantity
            const price = parseFloat(priceElement.innerText.replace("₱", "").trim()); // Extract price

            orderData.push({
                productName: nameElement.innerText, // Use innerText for product name
                quantity: quantity,
                price: price,
                add_ons: add_ons.innerText,
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