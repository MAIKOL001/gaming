<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
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
    
    <link rel="stylesheet" href="./assets/css/wishlist.css">
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
  <header>

<div class="header-top">

  <div class="container">

    <ul class="header-social-container">

        <li>
            <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
            </a>
        </li>

        <li>
            <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
            </a>
        </li>

        <li>
            <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
            </a>
        </li>

        <li>
            <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
            </a>
        </li>

    </ul>

    <div class="header-alert-news">
        <p>
            <b>Free Shipping</b> This Week Order Over - $55
        </p>
    </div>

  </div>

</div>

<div class="header-main">

  <div class="container">

    <a href="#" class="header-logo">
      <img src="./images/logo2.png" alt="Anon's logo" width="120" height="36">
    </a>
    
    <div class="header-search-container">
    <form action="" method="post">
        <input type="search" name="search_box" class="search-field"  maxlength="100" placeholder="Enter your product name...">

    </form>
    <button class="search-btn" type="submit" style="z-index: 100;">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </div>
   
    
     
    <div class="header-user-actions">

    

        <?php          
          $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
          $select_profile->execute([$user_id]);
          if($select_profile->rowCount() > 0){
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
       ?>
       <button class="action-btn">
           <ion-icon name="person-outline"><p><?= $fetch_profile["name"]; ?></p></ion-icon>
           
       </button>
       
       <?php
          }else{
       ?>

       
       <?php
          }
       ?>
       
<?php
          $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
          $count_wishlist_items->execute([$user_id]);
          $total_wishlist_counts = $count_wishlist_items->rowCount();

          $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
          $count_cart_items->execute([$user_id]);
          $total_cart_counts = $count_cart_items->rowCount();
       ?>
        <button class="action-btn">
            <a href="wishlist.php">
                <ion-icon name="heart-outline"></ion-icon>
            </a>
            <span class="count"><?= $total_wishlist_counts; ?></span>  </button>

        <button class="action-btn">
            <a href="cart.php">
                <ion-icon name="bag-handle-outline"></ion-icon>
            </a>
            <span class="count"><?= $total_cart_counts; ?></span>  </button>

    </div>

  </div>

</div>


      <nav class="desktop-navigation-menu">

          <div class="container">

              <ul class="desktop-menu-category-list">

                  <li class="menu-category">
                      <a href="home.php" class="menu-title">Home</a>
                  </li>

                 

                 

                  <li class="menu-category">
                      <a href="productss.php" class="menu-title">Products</a>

                      
                  </li>

                  <li class="menu-category">
                      <a href="orders.php" class="menu-title">Orders</a>

                      
                  </li>

                  

                  <li class="menu-category">
                      <a href="#" class="menu-title">Hot Offers</a>
                  </li>

                  <li class="menu-category">
                      <a href="#" class="menu-title">
                          
                           <?= $fetch_profile["name"]; ?>
                          </a>

                      <ul class="dropdown-list">

                          <li class="dropdown-item">
                          <a href="user_register.php" class="action-btn">Register</a>
       
                          </li>

                          <li class="dropdown-item">
                          <a href="user_login.php" class="action-btn">Login</a>
                          </li>

                          <li class="dropdown-item">
                          <a href="update_user.php" class="action-btn">Update Profile.</a>
       
                          </li>

                          <li class="dropdown-item">
                          <a href="components/user_logout.php" class="action-btn" onclick="return confirm('logout from the website?');">Logout</a> 
                          </li>

                      </ul>
                  </li>

              </ul>

          </div>

      </nav>
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

<!-- <link rel="stylesheet" href="css/style.css"> -->


<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
     if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
     $search_box = $_POST['search_box'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye">View</a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>Nrs.</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   }
   ?>

   </div>

</section>
           
    <!--
    - FOOTER
  -->
    <footer style="padding-top: 2rem;">

        <div class="footer-category">

            <div class="container">

                <h2 class="footer-category-title">Brand directory</h2>

                <div class="footer-category-box">

                    <h3 class="category-box-title">Fashion :</h3>

                    <a href="#" class="footer-category-link">T-shirt</a>
                    <a href="#" class="footer-category-link">Shirts</a>
                    <a href="#" class="footer-category-link">shorts & jeans</a>
                    <a href="#" class="footer-category-link">jacket</a>
                    <a href="#" class="footer-category-link">dress & frock</a>
                    <a href="#" class="footer-category-link">innerwear</a>
                    <a href="#" class="footer-category-link">hosiery</a>

                </div>

                <div class="footer-category-box">
                    <h3 class="category-box-title">footwear :</h3>

                    <a href="#" class="footer-category-link">sport</a>
                    <a href="#" class="footer-category-link">formal</a>
                    <a href="#" class="footer-category-link">Boots</a>
                    <a href="#" class="footer-category-link">casual</a>
                    <a href="#" class="footer-category-link">cowboy shoes</a>
                    <a href="#" class="footer-category-link">safety shoes</a>
                    <a href="#" class="footer-category-link">Party wear shoes</a>
                    <a href="#" class="footer-category-link">Branded</a>
                    <a href="#" class="footer-category-link">Firstcopy</a>
                    <a href="#" class="footer-category-link">Long shoes</a>
                </div>

                <div class="footer-category-box">
                    <h3 class="category-box-title">jewellery :</h3>

                    <a href="#" class="footer-category-link">Necklace</a>
                    <a href="#" class="footer-category-link">Earrings</a>
                    <a href="#" class="footer-category-link">Couple rings</a>
                    <a href="#" class="footer-category-link">Pendants</a>
                    <a href="#" class="footer-category-link">Crystal</a>
                    <a href="#" class="footer-category-link">Bangles</a>
                    <a href="#" class="footer-category-link">bracelets</a>
                    <a href="#" class="footer-category-link">nosepin</a>
                    <a href="#" class="footer-category-link">chain</a>
                    <a href="#" class="footer-category-link">Earrings</a>
                    <a href="#" class="footer-category-link">Couple rings</a>
                </div>

                <div class="footer-category-box">
                    <h3 class="category-box-title">cosmetics :</h3>

                    <a href="#" class="footer-category-link">Shampoo</a>
                    <a href="#" class="footer-category-link">Bodywash</a>
                    <a href="#" class="footer-category-link">Facewash</a>
                    <a href="#" class="footer-category-link">makeup kit</a>
                    <a href="#" class="footer-category-link">liner</a>
                    <a href="#" class="footer-category-link">lipstick</a>
                    <a href="#" class="footer-category-link">prefume</a>
                    <a href="#" class="footer-category-link">Body soap</a>
                    <a href="#" class="footer-category-link">scrub</a>
                    <a href="#" class="footer-category-link">hair gel</a>
                    <a href="#" class="footer-category-link">hair colors</a>
                    <a href="#" class="footer-category-link">hair dye</a>
                    <a href="#" class="footer-category-link">sunscreen</a>
                    <a href="#" class="footer-category-link">skin loson</a>
                    <a href="#" class="footer-category-link">liner</a>
                    <a href="#" class="footer-category-link">lipstick</a>
                </div>

            </div>

        </div>

        <div class="footer-nav">

            <div class="container">

                <ul class="footer-nav-list">

                    <li class="footer-nav-item">
                        <h2 class="nav-title">Popular Categories</h2>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Fashion</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Electronic</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Cosmetic</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Health</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Watches</a>
                    </li>

                </ul>

                <ul class="footer-nav-list">

                    <li class="footer-nav-item">
                        <h2 class="nav-title">Products</h2>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Prices drop</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">New products</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Best sales</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Contact us</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Sitemap</a>
                    </li>

                </ul>

                <ul class="footer-nav-list">

                    <li class="footer-nav-item">
                        <h2 class="nav-title">Our Company</h2>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Delivery</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Legal Notice</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Terms and conditions</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">About us</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Secure payment</a>
                    </li>

                </ul>

                <ul class="footer-nav-list">

                    <li class="footer-nav-item">
                        <h2 class="nav-title">Services</h2>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Prices drop</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">New products</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Best sales</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Contact us</a>
                    </li>

                    <li class="footer-nav-item">
                        <a href="#" class="footer-nav-link">Sitemap</a>
                    </li>

                </ul>

                <ul class="footer-nav-list">

                    <li class="footer-nav-item">
                        <h2 class="nav-title">Contact</h2>
                    </li>

                    <li class="footer-nav-item flex">
                        <div class="icon-box">
                            <ion-icon name="location-outline"></ion-icon>
                        </div>

                        <address class="content">
              419 State 414 Rte
              Beaver Dams, New York(NY), 14812, USA
            </address>
                    </li>

                    <li class="footer-nav-item flex">
                        <div class="icon-box">
                            <ion-icon name="call-outline"></ion-icon>
                        </div>

                        <a href="tel:+607936-8058" class="footer-nav-link">(607) 936-8058</a>
                    </li>

                    <li class="footer-nav-item flex">
                        <div class="icon-box">
                            <ion-icon name="mail-outline"></ion-icon>
                        </div>

                        <a href="mailto:example@gmail.com" class="footer-nav-link">example@gmail.com</a>
                    </li>

                </ul>

                <ul class="footer-nav-list">

                    <li class="footer-nav-item">
                        <h2 class="nav-title">Follow Us</h2>
                    </li>

                    <li>
                        <ul class="social-link">

                            <li class="footer-nav-item">
                                <a href="#" class="footer-nav-link">
                                    <ion-icon name="logo-facebook"></ion-icon>
                                </a>
                            </li>

                            <li class="footer-nav-item">
                                <a href="#" class="footer-nav-link">
                                    <ion-icon name="logo-twitter"></ion-icon>
                                </a>
                            </li>

                            <li class="footer-nav-item">
                                <a href="#" class="footer-nav-link">
                                    <ion-icon name="logo-linkedin"></ion-icon>
                                </a>
                            </li>

                            <li class="footer-nav-item">
                                <a href="#" class="footer-nav-link">
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <img src="./assets/images/payment.png" alt="payment method" class="payment-img">
                <p class="copyright">
                    Copyright &copy; <a href="#">Chipuka</a> all rights reserved.
                </p>
            </div>
        </div>
    </footer>

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