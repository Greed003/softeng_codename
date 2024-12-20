<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('auth_check.php'); ?>
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
      }
      .row {
        flex-direction: row;
        display: flex;
        
      }
      main, .tab{
        display: flex;
        flex-direction: column;
      }
      .search {
        margin:0;
        display: flex;
        height: 95px;
        width: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        justify-content: space-between;
      }
      .cat {
        flex-direction: column;
        display: flex;
        background-color: #ac8f64;
        width: auto;
        height: 100vh;
        align-items: left;
        justify-content: space-between;
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
        margin-left: 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: left;
        font-family: "Roboto";
        border-radius: 20px;
        border: none;
        outline: none;
        background-color: #dadada;
        width:auto;
        height: auto;
        font-size: 24px;
        padding: 10px;
      }
      .input1 {
        margin-left: 10px;
        width: calc(100vw - 300px);
        height: 25px;
        background-color: unset;
        border: unset;
        font-size: 20px;
        font-weight: bold;
      }
      .input1:focus {
        background-color: transparent;
        border: none;
        outline: none;
      }
      .bot{
        margin-bottom: 10px;
        justify-content: center;
      }
    .table-container {
        display: block;
        margin-left: 20px;
        padding: 20px;
        background-color: #FFFBEB; /* Light cream background */
        border-radius: 12px;
        border: 1px solid black;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
        height: 81%;
        width: 95%;
        overflow-y: auto;
        scrollbar-width: none;
    }
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        text-align: left;
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: #000000;
    }

    .custom-table th {
        padding: 10px;
        border-radius: 8px 8px 0 0;
        text-align: center;
        font-weight: bold;
    }

    .custom-table td {
        padding: 15px;
        vertical-align: middle;
        text-align: center;
    }
    
    .custom-table tbody tr td {
        border: 1px solid black;
        border-left: none;
        border-right: none;
        border-radius: 0; /* Reset any inherited radius */
        background-color: #ffffff; /* Ensure row color still applies */
    }

    /* First td: rounded left and no right border */
    .custom-table tbody tr td:first-child {
        border-left: 1px solid black;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        border-right: none;
    }

    /* Middle td: only top and bottom borders */
    .custom-table tbody tr td:not(:first-child):not(:last-child) {
        border-left: none;
        border-right: none;
        border-radius: 0; /* No rounded corners */
    }

    /* Last td: rounded right and no left border */
    .custom-table tbody tr td:last-child {
        border-right: 1px solid black;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        border-left: none;
    }

    .custom-table img.table-image {
        width: 50px;
        height: 50px;
        border-radius: 5px;
        object-fit: cover;
        border: 1px solid black;
    }

    .custom-table img.action-icon {
        width: 30px;
        height: 30px;
        margin: 0 5px;
        cursor: pointer;
    }

    .custom-table tr td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .custom-table tr td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }
/* Modal Background */
.modal {
  display: none; /* Hidden by default */
  position: fixed;
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  background-color: rgba(0, 0, 0, 0.4); /* Black background with opacity */
  padding-top: 60px; /* Padding from the top */
}

/* Modal Content */
.modal-content {
  background-color: #fff;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  max-width: 500px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  position: relative; /* Positioning for the close button */
}

/* Close Button */
.close {
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
  position: absolute;
  top: 15px;
  right: 25px;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* Heading */
h2 {
  font-size: 24px;
  color: #333;
  text-align: center;
  margin-bottom: 20px;
}

/* Form Elements */
form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

label {
  font-size: 16px;
  color: #555;
}

input[type="text"], input[type="number"], input[type="file"],#editSize {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button[type="submit"] {
  background-color: #4CAF50; /* Green */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

button[type="submit"]:hover {
  background-color: #45a049;
}

/* Confirmation Buttons */
.confirmation-buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

button#confirmDeleteBtn {
  background-color: #f44336; /* Red */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

button#confirmDeleteBtn:hover {
  background-color: #d32f2f;
}

button#cancelDeleteBtn {
  background-color: #f1f1f1; /* Light Grey */
  color: #333;
  padding: 10px 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

button#cancelDeleteBtn:hover {
  background-color: #ddd;
}

/* Responsive Design for smaller screens */
@media (max-width: 768px) {
  .modal-content {
    width: 90%;
  }
}
/* Add Product Button */
.add-product {
  text-align: center; /* Center the button */
  margin-bottom: 20px; 
  margin-left: 20px;  
}

.add-product button {
  background-color: #ac8f64; /* Green */
  color: white;
  padding: 12px 25px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

.add-product button:hover {
  background-color: #FFFBEB;
  color: black;
  border: 1px solid black;
}
/* Add Product Form Container */
.add-product-form {
    margin-left: 20px;
    padding: 20px;
    background-color: #FFFBEB; /* Light cream background */
    border-radius: 12px;
    border: 1px solid black;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
}

/* Form Elements */
.add-product-form form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.add-product-form label {
    font-size: 16px;
    color: #555;
}

.add-product-form input[type="text"], 
.add-product-form input[type="file"],
.add-product-form input[type="number"],
#productCategory,
.pSize  {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.add-product-form button[type="submit"] {
    background-color: #4CAF50; /* Green */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}
.add-product-form .cancel {
    background-color: darkred; /* Green */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
.add-product-form button[type="submit"]:hover {
    background-color: #45a049;
}
#showTableBtn{
    margin-right:20px;
}
#imagePreview {
    display: none;  
    width: 100px;   
    height: 100px;  
}
.psTable{
    border: none;
    font-size: 14px;
    color: #000000;
    font-weight: bold;
}
    </style>
</head>

<body>
    <div class="row">
        <div class="tab">
            <img src="img/logo2.png" width="200px" height="100px" />
            <div class="cat">
                <div>
                    <div class="cat2">
                        Products
                        <img src="img/arrow_down.png" id="dropdown" width="30px" height="30px" style="margin-left: 20px; cursor: pointer;" />
                    </div>
                    <div class="cat3" data-filter="All">All</div>
                    <div class="cat3" data-filter="Coffee">Coffee</div>
                    <div class="cat3" data-filter="Non-Coffee">Non-Coffee</div>
                    <div class="cat3" data-filter="Soda Drinks">Soda Drinks</div>
                    <div class="cat3" data-filter="Pizza">Pizza</div>
                    <div class="cat3" data-filter="Bread">Bread</div>
                </div>
                <div class="cat2 bot" onclick="window.location.href='logout.php';">
                    Log Out
                </div>
            </div>
        </div>
        <div class="main">
            <div class="row search">
                <div id="search">
                    <object data="img/search.svg" width="25px" height="25px"></object>
                    <input class="input1" type="search" name="search" placeholder="Search..." id="searchInput" />
                </div>
            </div>
            <div class="row add-product">
                <button id="showTableBtn">Product Table</button>
                <button id="addProductBtn">Add Product</button>
            </div>
            <!-- Add Product Form -->
            <div id="addProductForm" class="add-product-form" style="display: none;">
                <h2>Add New Product</h2>
                <form id="addProductFormFields">
                    <label for="productName">Name:</label>
                    <input type="text" id="productName" name="name" required />
                
                    <label for="productDescription">Description:</label>
                    <input type="text" id="productDescription" name="description" required />
                
                    <label for="productCategory">Category:</label>
                    <select id="productCategory" name="category" required>
                        <option value="Bread">Bread</option>
                        <option value="Coffee">Coffee</option>
                        <option value="Non-Coffee">Non-Coffee</option>
                        <option value="Soda Drinks">Soda Drinks</option>
                        <option value="Pizza">Pizza</option>
                    </select>
                
                    <label for="productSize">Size:</label>
                    <select id="productSize" class="pSize" name="size" style="display: none;">
                        <option value="" disabled selected>Select Size</option>
                        <option value="Hot 12oz" data-price="65.00">Hot 12oz</option>
                        <option value="Cold 16oz" data-price="85.00">Cold 16oz</option>
                        <option value="10''" data-price="300.00">10''</option>
                        <option value="12''" data-price="450.00">12''</option>
                    </select>
                
                    <label for="productPrice">Price:</label>
                    <input type="number" id="productPrice" name="price" required />
                
                    <label for="productImage">Upload Image:</label>
                    <input type="file" id="productImage" accept="image/*">
                    <img id="imagePreview" src="" alt="Image Preview"/>
                
                    <button type="submit">Add Product</button>
                    <button type="button" class="cancel" id="cancelAddProductBtn">Cancel</button>
                </form>                
            </div>
            <div id="productTableContainer" class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include('show_products.php'); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal" style="display: none;">
        <div class="modal-content">
            <!-- Move the close button inside modal-content -->
            <span class="close" id="closeModal">&times;</span>
            <h2 id="modalTitle">Edit Product</h2> <!-- Dynamic Product Name -->
            <form id="editForm">
                <label for="editDescription">Description:</label>
                <input type="text" id="editDescription" name="description" required />

                <label for="editImage">Image URL:</label>
                <input type="text" id="editImage" name="image" readonly />
        
                <label for="imageUpload">Upload Image:</label>
                <input type="file" id="imageUpload" name="imageUpload" accept="image/*" />
                <label for="editSize">Size:</label>
                <select id="editSize" name="size" style="display: none;" required>
                    <!-- Size options will be populated dynamically -->
                </select>
                <label for="editPrice">Price:</label>
                <input type="number" id="editPrice" name="price" required />

                <button type="submit" id="saveChanges">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- Modal (optional for confirmation) -->
    <div id="confirmDeleteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <!-- Move the close button inside modal-content -->
            <span class="close" id="closeConfirmModal">&times;</span>
            <p>Are you sure you want to delete this product?</p>
            <!-- Confirmation buttons -->
            <div class="confirmation-buttons">
                <button id="confirmDeleteBtn">Yes, Delete</button>
                <button id="cancelDeleteBtn">Cancel</button>
            </div>
        </div>
    </div>
  
    <script>
        document.addEventListener("DOMContentLoaded", () => {
             // Handle size change to update price
            document.querySelectorAll('#productSize').forEach(select => {
                select.addEventListener('change', function() {
                    const priceCell = this.closest('tr').querySelector('.price');
                    const selectedOption = this.options[this.selectedIndex];
                    const selectedPrice = selectedOption.getAttribute('data-price'); // Get the price from data attribute
                    priceCell.textContent = `₱${selectedPrice}`; // Update price in table cell
                });
            });
            // Open modal when edit icon is clicked
            const editIcons = document.querySelectorAll(".action-icon.edit-icon");
            const modal = document.getElementById("editModal");
            const closeModalButton = document.getElementById("closeModal");
            const saveChangesButton = document.getElementById("saveChanges");
            const editForm = document.getElementById("editForm");
            const modalTitle = document.getElementById("modalTitle"); // Modal title element

            let currentRow = null;

            // Open the modal and populate it with data
            editIcons.forEach((icon) => {
                icon.addEventListener("click", (e) => {
                    currentRow = e.target.closest("tr");
                    const name = currentRow.cells[1].textContent;
                    const description = currentRow.cells[2].textContent;
                    const category = currentRow.cells[3].textContent;
                    const image = currentRow.cells[4].querySelector("img").src;
                    const price = currentRow.cells[6].textContent.replace('₱', ''); // Get the price value (remove "₱")
                    const sizeSelect = currentRow.cells[5].querySelector("select"); // Get the size dropdown

                    const selectedSize = sizeSelect ? sizeSelect.value : null; // Get the currently selected size
                    const selectedPrice = sizeSelect ? sizeSelect.options[sizeSelect.selectedIndex].getAttribute('data-price') : price; // Get the price for the selected size

                    // Set the modal title to show the product name
                    modalTitle.textContent = `Edit Product - ${name}`;

                    // Populate modal fields
                    document.getElementById("editDescription").value = description;
                    document.getElementById("editImage").value = image;
                    document.getElementById("editPrice").value = selectedPrice; // Populate the price with selected size's price

                    // Check if the category has size options
                    if (["Coffee", "Non-Coffee", "Soda Drinks", "Pizza"].includes(category)) {
                        // Populate size dropdown in the modal if available
                        const sizeDropdown = document.getElementById("editSize");
                        sizeDropdown.innerHTML = ''; // Clear existing options
                        const options = sizeSelect.querySelectorAll('option'); // Get size options from the table row
                        options.forEach(option => {
                            const newOption = document.createElement("option");
                            newOption.value = option.value;
                            newOption.textContent = option.textContent;
                            newOption.setAttribute("data-price", option.getAttribute("data-price"));
                            sizeDropdown.appendChild(newOption);
                        });
                        sizeDropdown.value = selectedSize; // Set the currently selected size
                        sizeDropdown.style.display = "block"; // Show size dropdown
                    } else {
                        document.getElementById("editSize").style.display = "none"; // Hide size dropdown if no size options
                    }

                    modal.style.display = "block";
                });
            });

            // Close the modal when the close button is clicked
            closeModalButton.addEventListener("click", () => {
                modal.style.display = "none";
            });

            // Handle image file upload
            const imageUpload = document.getElementById("imageUpload");
            imageUpload.addEventListener("change", (e) => {
                const file = e.target.files[0];
                if (file) {
                    // Create a URL for the selected file
                    const fileURL = URL.createObjectURL(file);

                    // Set the image URL in the input field
                    document.getElementById("editImage").value = fileURL;
                }
            });

            // Update price when size is changed
            const sizeDropdown = document.getElementById("editSize");
            sizeDropdown.addEventListener("change", (e) => {
                const selectedOption = e.target.selectedOptions[0];
                const price = selectedOption.getAttribute("data-price");
                document.getElementById("editPrice").value = price; // Update the price field when size is changed
            });

            // Save the changes
            saveChangesButton.addEventListener("click", (e) => {
                e.preventDefault(); // Prevent form from submitting

                const updatedDescription = document.getElementById("editDescription").value;
                const updatedImage = document.getElementById("editImage").value;
                const updatedPrice = document.getElementById("editPrice").value; // Get the updated price
                const updatedSize = document.getElementById("editSize").value; // Get the updated size
                const productId = currentRow.getAttribute("data-product-id"); // Get the product ID

                // Send the updated data to the server
                fetch('edit_product.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        product_id: productId,
                        description: updatedDescription,
                        image: updatedImage,
                        price: updatedPrice,
                        size: updatedSize
                    }),
                    headers: { 'Content-Type': 'application/json' }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the row in the table with the new data
                        currentRow.cells[2].textContent = updatedDescription;
                        currentRow.cells[4].querySelector("img").src = updatedImage;
                        currentRow.cells[6].textContent = `₱${updatedPrice}`; // Update the price cell
                        if (updatedSize) {
                            currentRow.cells[5].querySelector("select").value = updatedSize; // Update the size if available
                        }

                        // Close the modal
                        modal.style.display = "none";
                    } else {
                        alert('Error: ' + data.message); // Show error if updating fails
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while saving changes.');
                });
            });            
            // Close the modal if the user clicks anywhere outside of it
            window.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.style.display = "none";
                }
            });
            
            // Function to filter table rows based on search input
            document.getElementById("searchInput").addEventListener("input", function () {
                const searchValue = this.value.toLowerCase().trim();
                const tableRows = document.querySelectorAll(".custom-table tbody tr");
        
                tableRows.forEach((row) => {
                    const name = row.cells[1].textContent.toLowerCase();        // Name column
                    const description = row.cells[2].textContent.toLowerCase(); // Description column
                    const category = row.cells[3].textContent.toLowerCase();    // Category column
        
                    if (
                        name.includes(searchValue) || 
                        description.includes(searchValue) || 
                        category.includes(searchValue)
                    ) {
                        row.style.display = ""; // Show the row if it matches
                    } else {
                        row.style.display = "none"; // Hide the row if it doesn't match
                    }
                });
        
                // Update row numbers after filtering
                updateRowNumbers();
            });
        
            // Function to update the "No." column dynamically
            function updateRowNumbers() {
                const tableRows = document.querySelectorAll(".custom-table tbody tr");
                let rowNumber = 1;
        
                tableRows.forEach((row) => {
                    if (row.style.display !== "none") { // Only update visible rows
                        row.cells[0].textContent = rowNumber++;
                    }
                });
            }
        
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
        
            // Filter table rows based on category selection
            const categories = document.querySelectorAll(".cat3");
            categories.forEach((category) => {
                category.addEventListener("click", function () {
                    const filterValue = this.getAttribute("data-filter");
                    const tableRows = document.querySelectorAll(".custom-table tbody tr");
        
                    tableRows.forEach((row) => {
                        const categoryCell = row.cells[3]; // Assuming the category is in the 4th column (index 3)
                        const categoryText = categoryCell.textContent.trim();
        
                        if (filterValue === "All" || categoryText === filterValue) {
                            row.style.display = ""; // Show the row
                        } else {
                            row.style.display = "none"; // Hide the row
                        }
                    });
        
                    // Update row numbers after filtering
                    updateRowNumbers();
        
                    // Clear the search input when changing categories
                    document.getElementById("searchInput").value = "";
                });
            });
        
            // Update row numbers initially (optional, to ensure numbering on load)
            updateRowNumbers();
        
            // Handle delete icon click
            const deleteIcons = document.querySelectorAll(".action-icon.delete-icon");
            const confirmDeleteModal = document.getElementById("confirmDeleteModal");
            const closeConfirmModalButton = document.getElementById("closeConfirmModal");
            const confirmDeleteButton = document.getElementById("confirmDeleteBtn");
            const cancelDeleteButton = document.getElementById("cancelDeleteBtn");

            let rowToDelete = null;
            let productIdToDelete = null;

            deleteIcons.forEach((icon) => {
                icon.addEventListener("click", (e) => {
                    rowToDelete = e.target.closest("tr");
                    productIdToDelete = rowToDelete.getAttribute("data-product-id"); // Get the product ID from the row
                    confirmDeleteModal.style.display = "block"; // Show the confirmation modal
                });
            });

            // Close the confirmation modal
            closeConfirmModalButton.addEventListener("click", () => {
                confirmDeleteModal.style.display = "none";
            });

            // Confirm deletion
            confirmDeleteButton.addEventListener("click", () => {
                // Send an AJAX request to delete the product
                fetch('delete_product.php', {
                    method: 'POST',
                    body: JSON.stringify({ product_id: productIdToDelete }), // Sending product ID to delete
                    headers: { 'Content-Type': 'application/json' }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        rowToDelete.remove(); // Remove the row from the table
                    } else {
                        alert('Error: Could not delete product.');
                    }
                    confirmDeleteModal.style.display = "none"; // Close the modal
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
            });

            // Cancel deletion
            cancelDeleteButton.addEventListener("click", () => {
                confirmDeleteModal.style.display = "none"; // Close the modal
            });
        
            // Show the add product form and hide the table
            // DOM Elements
            const addProductBtn = document.getElementById("addProductBtn");
            const addProductForm = document.getElementById("addProductForm");
            const productTableContainer = document.getElementById("productTableContainer");
            const cancelAddProductBtn = document.getElementById("cancelAddProductBtn");
            const showTableBtn = document.getElementById("showTableBtn");
            const productImageInput = document.getElementById("productImage");
            const imagePreview = document.getElementById("imagePreview");
            const addProductFormFields = document.getElementById("addProductFormFields");
            const productSizeDropdown = document.getElementById("productSize");
            const productCategoryDropdown = document.getElementById("productCategory");

            // Show the add product form and hide the table
            addProductBtn.addEventListener("click", () => {
                addProductForm.style.display = "block";
                productTableContainer.style.display = "none";
            });

            // Show the product table and hide the add product form
            showTableBtn.addEventListener("click", () => {
                addProductForm.style.display = "none";
                productTableContainer.style.display = "block";
            });

            // Cancel button: Hide the add product form and return to the table
            cancelAddProductBtn.addEventListener("click", () => {
                addProductForm.style.display = "none";
                productTableContainer.style.display = "block";
            });

            // Image preview functionality
            imagePreview.style.display = "none"; // Hide the image preview initially
            productImageInput.addEventListener("change", (e) => {
                const file = e.target.files[0];
                if (file) {
                    const fileURL = URL.createObjectURL(file);
                    imagePreview.src = fileURL;
                    imagePreview.style.display = "block"; // Show the image preview
                } else {
                    imagePreview.style.display = "none"; // Hide the image preview
                }
            });

            // Handle category change to show or hide size options
            productCategoryDropdown.addEventListener("change", () => {
                const category = productCategoryDropdown.value;
                
                if (["Coffee", "Non-Coffee", "Soda Drinks"].includes(category)) {
                    productSizeDropdown.style.display = "block";
                    productSizeDropdown.required = true; // Make the size required when the category requires it
                    updateSizeOptions(["Hot 12oz", "Cold 16oz"]);
                } else if (category === "Pizza") {
                    productSizeDropdown.style.display = "block";
                    productSizeDropdown.required = true; // Make the size required for pizza
                    updateSizeOptions(["10''", "12''"]);
                } else {
                    productSizeDropdown.style.display = "none"; // Hide the size dropdown for other categories
                    productSizeDropdown.required = false; // Remove the 'required' attribute if size is not needed
                }
            });

            // Update size options dynamically
            function updateSizeOptions(options) {
                productSizeDropdown.innerHTML = `<option value="" disabled selected>Select Size</option>`;
                options.forEach(size => {
                    const option = document.createElement("option");
                    option.value = size;
                    option.textContent = size;
                    productSizeDropdown.appendChild(option);
                });
            }

           // Handle form submission to add a new product
addProductFormFields.addEventListener("submit", (e) => {
    e.preventDefault(); // Prevent the form from submitting

    // Validate and log form data before sending
    const productName = document.getElementById("productName").value;
    const productDescription = document.getElementById("productDescription").value;
    const productCategory = productCategoryDropdown.value;
    const productSize = productSizeDropdown.value; // Optional size
    const productPrice = document.getElementById("productPrice").value;
    const productImage = imagePreview.src; // Image preview URL

    // Log the data for debugging
    console.log({
        productName,
        productDescription,
        productCategory,
        productSize,
        productPrice,
        productImage
    });

    // If any required field is missing, show an alert and prevent submission
    if (!productName || !productDescription || !productCategory || !productPrice || !productImage) {
        alert('Please fill in all required fields!');
        return;  // Prevent form submission
    }

    // Send the data to the server via fetch (POST request)
    fetch('add_product.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            product_name: productName,
            product_description: productDescription,
            product_category: productCategory,
            product_size: productSize,  // Optional size
            product_price: productPrice,
            product_image: productImage
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);

            // Add the new product to the table
            const tableBody = document.querySelector(".custom-table tbody");
            const newRow = document.createElement("tr");
            const newRowNumber = tableBody.rows.length + 1;

            let sizeColumn = '';  // Initialize sizeColumn to avoid issues if no size is required

            if (productSize && productSizeDropdown.style.display !== "none") {
                sizeColumn = `<option value="${productSize}" data-price="${parseFloat(productPrice).toFixed(2)}">${productSize}</option>`;
            }

            newRow.innerHTML = `
                <td>${newRowNumber}</td>
                <td>${productName}</td>
                <td>${productDescription}</td>
                <td>${productCategory}</td>
                <td><img src="${productImage}" class="table-image" alt="Product Image" /></td>
                <td><select id="productSize" name="size" class="psTable">${sizeColumn}</select></td>
                <td class="price">₱${parseFloat(productPrice).toFixed(2)}</td>
                <td>
                    <img src="img/delete1.png" class="action-icon delete-icon" />
                    <img src="img/edit.png" class="action-icon edit-icon" />
                </td>
            `;

            // Append the new row to the table
            tableBody.appendChild(newRow);

            // Hide the add product form and show the table
            addProductForm.style.display = "none";
            productTableContainer.style.display = "block";

            // Clear the form fields
            addProductFormFields.reset();
            imagePreview.style.display = "none"; // Hide the image preview
            window.location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

        });
    </script>
    
</body>

</html>
