// Get the elements
const orderButton = document.querySelector(".order");
const orderContainer = document.querySelector(".order_container");
const overlay = document.querySelector(".overlay");

// Function to toggle the order container and overlay
orderButton.addEventListener("click", () => {
  orderContainer.classList.toggle("active"); // Toggle the active class
  overlay.classList.toggle("active"); // Show the overlay
});

// Hide the order container if overlay is clicked
overlay.addEventListener("click", () => {
  orderContainer.classList.remove("active"); // Slide out the container
  overlay.classList.remove("active"); // Hide the overlay
});
