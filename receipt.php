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
        align-items: center;
        height: 100vh;
        margin: 0;
        text-align: center;
        font-family: 'Trebuchet MS', sans-serif;
      }
      h1{
        font-weight: bolder;
        margin: 0;
      }
      h2, h5{
        font-weight: lighter;
        margin: 0;
      }
      .cont{
        width: auto;
        padding: 20px;
      }
      tr{
        display: flex;
        justify-content: space-between;
        width: 360px;
        font-size: 16px;
      }
      .fo20{
        font-size: 20px;
      }
      .name{
        text-align: left;
      }
      #name,#service{
        text-align: left;
        font-size: 16px;
      }
      .addons{
        display: block;
        
      }
    </style>
  </head>

  <body>
    <div class="cont">
        <h1>KASKADA CAFE</h1>
        <h5>Address: Laoeng St, Poblacion, San Gabriel, 2513 La Union</h5>
        <h5>Phone: 0954 382 1589</h5>
        <h5 style="margin-bottom:20px;">Date: <span id="date"></span></h5>
        <h5 id="name"></h5>
        <h5 id="service"></h5>
        <h2>* * * * * * * * * * * * * * * * * * * * * * *</h2>
        <h2>CASH RECEIPT</h2>
        <h2>* * * * * * * * * * * * * * * * * * * * * * *</h2>
        <table id="orderTable" style="width: 100%;">
            <tr>
                <th style="text-align: left;">Description</th>
                <th style="text-align: right;">Amount</th>
            </tr>
        </table>
        <h2>* * * * * * * * * * * * * * * * * * * * * * *</h2>
        <table style="width: 100%;">
            <tr class="fo20">
                <th style="text-align: left;">Total</th>
                <th style="text-align: right;" id="total">₱0.00</th>
            </tr>
            <tr>
                <td style="text-align: left;">Cash</td>
                <td style="text-align: right;" id="cash">₱0.00</td>
            </tr>
            <tr>
                <td style="text-align: left;">Change</td>
                <td style="text-align: right;" id="change">₱0.00</td>
            </tr>
        </table>
        <h2>* * * * * * * * * * * * * * * * * * * * * * *</h2>
        <h3>THANK YOU!</h3>
    </div>
    <script>
    const customerName = localStorage.getItem("customerName");
    // Get the stored order details
    const orderDetails = JSON.parse(localStorage.getItem('orderDetails'));

    if (orderDetails) {
        // Set the date
        const date = new Date();
        document.getElementById('date').textContent = date.toLocaleString();

        // Fill the product details
        const orderTable = document.getElementById('orderTable');
        orderDetails.products.forEach((product, index) => {
            // Create a row for the product name and price
            const productRow = document.createElement('tr');
            productRow.innerHTML = `
                <td class="name" style="text-align: left;">${product.name}</td>
                <td style="text-align: right;">${product.price}</td>
            `;
            orderTable.appendChild(productRow);

            // If the product has add-ons and they are not "No Addons", display them below the product
            if (product.addons && product.addons.trim() !== "No Addons" && product.addons.trim() !== "") {
                const addonsRow = document.createElement('tr');
                addonsRow.innerHTML = `
                    <td class="addons" style="text-align: left; padding-left: 20px; font-size: 0.9em;">
                        ${product.addons.split(' ').map(addon => ` ${addon}`).join('<br>')}
                    </td>
                `;
                orderTable.appendChild(addonsRow);
            }
        });

        // Set total, cash, and change
        document.getElementById('name').textContent = `Name: ${orderDetails.customerName}`;
        document.getElementById('service').textContent = `Service: ${orderDetails.service}`;
        document.getElementById('total').textContent = `₱${orderDetails.total.toFixed(2)}`;
        document.getElementById('cash').textContent = `₱${orderDetails.cash.toFixed(2)}`;
        document.getElementById('change').textContent = `₱${orderDetails.change.toFixed(2)}`;
    }

    window.print();
</script>

</body>

</html>
