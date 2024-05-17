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
        <img src="./images/logo3.png" alt="Anon's logo" width="120" height="50">
      </a>
      <a href="search_page.php">
      <div class="header-search-container">
      <form action="" method="post">
          <input type="search" name="search_box" class="search-field"  maxlength="100" placeholder="Enter your product name...">

      </form>
      <button class="search-btn" type="submit" style="z-index: 100;">
              <ion-icon name="search-outline"></ion-icon>
          </button>
      </div>
     
      
      </a> 
      <div class="header-user-actions">

      

          <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         
         
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

                    <?php if (isset($_SESSION['user_id'])): ?>
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
                    <?php endif; ?>


                </ul>

            </div>

        </nav>