<?php 
session_start();
include 'dbcon.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Varela+Round&display=swap" rel="stylesheet"/>
</head>
<style>
  body {
    font-family: Karla, Arial, sans-serif;
  }
  
  .container {
    display: flex;
    justify-content: flex-start;
  }
  
  .left {
    border-radius: 15px;
    padding-top: 20px;
    margin-top: 10px;
    margin-left: 10px;
    margin-right: 10px;
    width: 300px;
    height: 92.5vh;
    color: saddlebrown;
    text-align: center;
    box-shadow: 0 0 8px rgba(139, 69, 19, 0.7);
  }

  .left h2 {
    margin-bottom: 50px;
  }
  
  .img {
    border-radius: 25px;
    margin-top: 10px;
    margin-bottom: -20px;
    margin-left: 10px;
    margin-right: 10px;
    width: 190px;
    height: 130px;
    object-fit: cover;
  }

  .left h3 {
    font-size: 20px;
    font-weight: 700;
    cursor: pointer;
  }
 
  .mid {
    border-radius: 15px;
    padding-top: 10px;
    margin-top: 10px;
    margin-left: 10px;
    margin-right: 10px;
    width: 70%;
    height: 93.9vh;
    color: saddlebrown;
    text-align: center;
    box-shadow: 0 0 8px rgba(139, 69, 19, 0.7);
  }

  .mid::-webkit-scrollbar {
    display: none; 
  }

  .mid .header {
    margin-bottom: 50px;
  }

  .coffee-products, .bread-products {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    margin: 10px;
  }

  .coffee-products h2, .bread-products h2 {
    margin: 0;
    font-size: 30px;
  }

  .coffee-products .add, .bread-products .add {
    margin-bottom: 20px;
  }

  .img2 {
    border-radius: 25px;
    margin-top: 10px;
    width: 220px;
    height: 220px;
    object-fit: cover;
  }
  
  .right {
    border-radius: 15px;
    padding-top: 10px;
    margin-top: 10px;
    margin-left: 10px;
    margin-right: 10px;
    width: 300px;
    height: 93.9vh;
    color: saddlebrown;
    text-align: center;
    box-shadow: 0 0 8px rgba(139, 69, 19, 0.7);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  #order-list {
    flex-grow: 1; 
    overflow-y: auto; 
  }

  .left, .mid, .right {
    background-image: url('assets/dash_bg.jpg');
    background-size: contain; 
    background-position: center bottom; 
    background-repeat: no-repeat;
  }

  .add, .cncl-btn, .cnfrm-btn, .rmv-btn {
    border-style: none;
    background-color: transparent;
    color: saddlebrown;
    border-radius: 10px;
    box-shadow: 0 0 8px rgba(139, 69, 19, 0.7);
    cursor: pointer;
    transition: 0.3s;
    padding: 10px;
    text-align: center;
  }

  .cncl-btn, .cnfrm-btn {
    margin-top: 160px;
    padding: 12px;
    width: 150px;
    color: white;
  }

  .add:hover, .cncl-btn:hover, .cnfrm-btn:hover, .rmv-btn:hover {
    background-color: rgba(0, 0, 0, 0.3);
    color: white;
  }

  .rmv-btn {
    align-self: center;
    margin-bottom: 15px;
  }

  .order-item {
    background-color: rgba(139, 69, 19, 0.1);
    padding: 10px;
    margin: 10px;
    border-radius: 10px;
    box-shadow: 0 0 4px rgba(139, 69, 19, 0.5);
  }

  .order-item p {
    margin: 0;
    font-size: 16px;
  }
</style>
<body>
  <div class="container">
    <div class="left">
      <h2>Category</h2>
      <img class="img" src="assets/4.jpg" alt="Coffee">
      <h3>Coffee</h3>
      <img class="img" src="assets/5.jpg" alt="Bread">
      <h3>Bread</h3>
    </div>
    <div class="mid">      
  <h2 class="header">Selection</h2>

  <div class="coffee-products">
  
    <?php
      // Query for coffee products
      $coffeeQuery = "SELECT product_name, product_price FROM products";
      $coffeeResult = $conn->query($coffeeQuery);

      if ($coffeeResult && $coffeeResult->num_rows > 0) {
          while ($row = $coffeeResult->fetch_assoc()) {
              echo '
              <div class="product">
                  <img class="img2" src="assets/4.jpg" alt="Coffee">
                  <h2>' . htmlspecialchars($row['product_name']) . '</h2>
                  <div class="price">₱' . number_format($row['product_price'], 2) . '</div>
                  <button class="add">Add to Order</button>
              </div>';
          }
      } else {
          echo '<p>No products available.</p>';
      }
    ?>
  </div>

  <div class="bread-products">
    <?php
      // Query for bread products
      $breadQuery = "SELECT product_name, product_price FROM products";
      $breadResult = $conn->query($breadQuery);

      if ($breadResult && $breadResult->num_rows > 0) {
          while ($row = $breadResult->fetch_assoc()) {
              echo '
              <div class="product">
                  <h2>' . htmlspecialchars($row['name']) . '</h2>
                  <div class="price">₱' . number_format($row['price'], 2) . '</div>
                  <button class="add">Add to Order</button>
              </div>';
          }
      } else {
          echo '<p>No products available.</p>';
      }
    ?>
  </div>

  <a href="index.php"><button class="cncl-btn">Cancel Order</button></a>
  <a href="dashboard.php"><button class="cnfrm-btn">Confirm Order</button></a>
</div>

    <div class="right">
      <h2>Order List</h2>
      <h5><?php echo "$_SESSION[selection]"; ?></h5>
      <div id="order-list"></div>
      <button class="rmv-btn">Remove Order</button>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        const coffeeCategoryLink = document.querySelector('.left h3:nth-of-type(1)');
        const breadCategoryLink = document.querySelector('.left h3:nth-of-type(2)');
        const coffeeProducts = document.querySelector('.coffee-products');
        const breadProducts = document.querySelector('.bread-products');

        coffeeProducts.style.display = 'grid';
        breadProducts.style.display = 'none';

        coffeeCategoryLink.addEventListener('click', () => {
            coffeeProducts.style.display = 'grid';
            breadProducts.style.display = 'none';
        });

        breadCategoryLink.addEventListener('click', () => {
            coffeeProducts.style.display = 'none';
            breadProducts.style.display = 'grid';
        });

        const addButtons = document.querySelectorAll('.add');
        const orderListDiv = document.getElementById('order-list');

        function addToOrder(event) {
            const productContainer = event.target.closest('.product');
            const productName = productContainer.querySelector('h2').innerText;
            const productPrice = productContainer.querySelector('.price').innerText;

            const cleanedPrice = parseFloat(productPrice.replace('₱', '').trim()).toFixed(2);
            const priceInPesos = `₱${cleanedPrice}`;

            const orderItem = document.createElement('div');
            orderItem.classList.add('order-item');
            orderItem.innerHTML = `<p>${productName} - ${priceInPesos}</p>`;
            orderListDiv.appendChild(orderItem);
        }

        addButtons.forEach(button => {
            button.addEventListener('click', addToOrder);
        });

        const cancelButton = document.querySelector('.cncl-btn');
        cancelButton.addEventListener('click', function() {
            orderListDiv.innerHTML = '';
        });

        const confirmButton = document.querySelector('.cnfrm-btn');
        confirmButton.addEventListener('click', function() {
            if (orderListDiv.innerHTML === '') {
                alert("Your order is empty. Please add items to your order.");
            } else {
                alert("Your order has been confirmed!");
                orderListDiv.innerHTML = '';
            }
        });

        const removeButton = document.querySelector('.rmv-btn');
        removeButton.addEventListener('click', function() {
            const lastOrderItem = orderListDiv.lastElementChild;
            if (lastOrderItem) {
                orderListDiv.removeChild(lastOrderItem);
            }
        });
    });
  </script>
</body>
</html>
