<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

include 'components/wishlist_cart.php';

if(isset($_POST['delete'])){
   $wishlist_id = $_POST['wishlist_id'];
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
   $delete_wishlist_item->execute([$wishlist_id]);
}

if(isset($_GET['delete_all'])){
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist_item->execute([$user_id]);
   header('location:wishlist.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('./layouts/head.php'); ?>
</head>
<body>
    <div class="overlay" data-overlay></div>
    <!--
    - MODAL
  -->
  <div class="overlay" data-overlay></div>
  <div class="modal" data-modal>
      <div class="modal-close-overlay" data-modal-overlay></div>
          <button data-modal-close>      
    </button>
</div>
  </div>
      <button data-toast-close>
  </button>
      <!--
    - HEADER
  -->
  <?php include './layouts/desktopnav.php'; ?>
        <?php include ('./layouts/mobilenav.php'); ?>
    <!--
    - MAIN
  -->
    <main>
        <!--
      - PRODUCT
    -->
        <div class="product-container">
            <div class="container">
                <!--
          - SIDEBAR
        -->
                
                <div class="product-box">
                    <!--
            - PRODUCT MINIMAL
          -->

<div class="product-minimal">
    <div class="product-showcase">
        
        <div class="showcase-wrapper has-scrollbar">
        
        </div>
    </div>
</div>
<style>
  /* Increased specificity by adding parent class */
  .quick-view .box-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center align boxes */
    margin-top: 20px; /* Add space above boxes */
  }

  .quick-view .box {
    width: 85%; /* Set width for boxes */
    margin: 10px;  /* Add some margin for spacing */
    box-sizing: border-box; /* Ensure padding/border doesn't affect width */ /* Add border to boxes */
    border-radius: 5px; /* Add border radius for better appearance */
    overflow: hidden; /* Prevent content overflow */
    display: flex; /* Align items horizontally */
  }

  /* Media query for smaller screens (adjust breakpoint as needed) */
  @media (max-width: 768px) {
    .quick-view .box {
      width: 100%; /* Set width for full screen on small screens */
    }
  }

  .quick-view {
    background-color: #f5f5f5; /* Light gray background for quick view section */
    padding: 10px;
border-radius: 1rem;
    margin: 0 auto; /* Center the quick view section horizontally */
    max-width: 1200px; /* Set a maximum width for responsiveness */
  }

  .quick-view .heading {
    color: #4CAF50; /* Green color for heading */
    text-align: center; /* Center align heading text */
    margin-bottom: 20px; /* Add some space below the heading */
  }

  .quick-view .row {
    display: flex;
    flex-wrap: wrap; /* Allow items to wrap onto new lines if needed */
  }

  .quick-view .image-container {
    width: 50%; /* Set width for image container */
    padding: 10px;  /* Add some padding for image spacing */
  }

  .quick-view .main-image {
    position: relative; /* Enable layering for hover effect */
  }

  .quick-view .main-image img {
    width: 100%; /* Ensure image fills the container */
    height: auto; /* Maintain image aspect ratio */
  }

  .quick-view .sub-image {
    margin-top: 10px; /* Add margin between main and sub images */
    display: flex;
    justify-content: space-between; /* Space out sub-images */
  }

  .quick-view .sub-image img {
    width: 30%; /* Set width for sub-images */
    height: auto; /* Maintain aspect ratio */
  }

  .quick-view .content {
    width: 50%; /* Set width for content container */
    padding: 10px;  /* Add some padding for content spacing */
    box-sizing: border-box; /* Ensure padding/border doesn't affect width */
    display: flex; /* Align items horizontally */
    flex-direction: column; /* Stack items vertically */
    justify-content: space-between; /* Space out content vertically */
  }

  .quick-view .name {
    font-weight: bold; /* Bold text for product name */
    margin-bottom: 10px; /* Add some space between name and price */
  }

  .quick-view .price {
    color: #4CAF50; /* Green color for price */
    font-size: 18px; /* Increase price font size for emphasis */
    margin-right: 10px; /* Add some space between price and quantity */
  }

  .quick-view .qty {
    border: 1px solid #ccc; /* Add a thin border for quantity input */
    padding: 5px 10px; /* Increase padding for better user experience */
    width: 50px; /* Set width for quantity input */
    text-align: center; /* Center align quantity text */
  }

  .quick-view .details {
    margin-top: 15px; /* Add some space above product details */
  }

  .quick-view .flex-btn {
    display: flex;
    justify-content: space-between; /* Distribute buttons evenly */
    margin-top: 15px; /* Add some space above buttons */
  }

  .quick-view .btn,
  .quick-view .option-btn {
    background-color: transparent; /* Remove default button background */
    border: 1px solid #ddd; /* Add a thin border for buttons */
    padding: 10px 20px; /* Add padding for buttons */
    cursor: pointer; /* Add pointer cursor for better UX */
    transition: background-color 0.3s ease; /* Smooth transition on hover */
  }

  .quick-view .btn:hover,
  .quick-view .option-btn:hover {
    background-color: #ddd; /* Change background color on hover */
  }
</style>

<script>
  function displayImage(imageUrl) {
    document.getElementById('main-image').src = imageUrl;
  }
</script>

<section class="quick-view">

  <h1 class="heading">Quick view</h1>

  <div class="box-container">
    <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
    <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <div class="row">
        <div class="image-container">
          <div class="main-image">
            <img id="main-image" src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
          </div>
          <div class="sub-image">
            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" onclick="displayImage('uploaded_img/<?= $fetch_product['image_01']; ?>')">
            <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="" onclick="displayImage('uploaded_img/<?= $fetch_product['image_02']; ?>')">
            <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="" onclick="displayImage('uploaded_img/<?= $fetch_product['image_03']; ?>')">
          </div>
        </div>
        <div class="content">
          <div class="name">
            <h3>Name:</h3>
            <?= $fetch_product['name']; ?></div>
          <div class="flex">
          <h3>Price:</h3>
            <div class="price"><span>Ksh.</span><?= $fetch_product['price']; ?><span>/-</span></div>
            
            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
          </div>
          <div class="details">
          <h3>Details:</h3>  
          <?= $fetch_product['details']; ?></div>
          <div class="flex-btn">
            <input type="submit" value="add to cart" class="btn" name="add_to_cart" style="color: #4CAF50;">
            
          </div>
          <input class="option-btn" type="submit" name="add_to_wishlist" value="add to wishlist" style="color: red;">
        </div>
      </div>
    </form>
    <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
  </div>

</section>


           
    <!--
    - FOOTER
  -->
   <?php include ('./layouts/footer.php'); ?>

    <!--
    - custom js link
  -->
    <script src="./assets/js/script.js"></script>
    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>