<div class="mobile-bottom-navigation">

            <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>


      <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
          

          <button class="action-btn">
              <a href="cart.php">
                  <ion-icon name="bag-handle-outline"></ion-icon>
              </a>
              <span class="count"><?= $total_cart_counts; ?></span>  </button>
      

            <button class="action-btn">
        <ion-icon name="home-outline"></ion-icon>
      </button>

      <button class="action-btn">
              <a href="wishlist.php">
                  <ion-icon name="heart-outline"></ion-icon>
              </a>
              <span class="count"><?= $total_wishlist_counts; ?></span>  </button>

          

            

            <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>

        </div>

        <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

            <div class="menu-top">
                <h2  class="menu-title">Menu</h2>

                <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
            </div>

            <ul class="mobile-menu-category-list">

                <li class="menu-category">
                    <a href="home.php" class="menu-title">Home</a>
                </li>

               

              
          <li class="menu-category">
            <a href="orders.php" class="menu-title">orders</a>
        </li>
                

                <li class="menu-category">
                    <a href="productss.php" class="menu-title">Products</a>
                </li>


                
            </ul>

            <div class="menu-bottom">

                <ul class="menu-category-list">

                    <li class="menu-category">
                    
                        <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title"><?= $fetch_profile["name"]; ?></p>

              <ion-icon name="person-outline" class="caret-back"></ion-icon>
            </button>

                        <ul class="submenu-category-list" data-accordion>

                            <li class="submenu-category">
                                <a href="update_user.php" class="submenu-title">Update Profile</a>
                            </li>

                            <li class="submenu-category">
                                <a href="user_login.php" class="submenu-title">login</a>
                            </li>

                            <li class="submenu-category">
                                <a href="user_register.php" class="submenu-title">register</a>
                            </li>

                        </ul>
                  
                    </li>

                    <li class="menu-category">
                        <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Currency</p>
              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

                        <ul class="submenu-category-list" data-accordion>
                            <li class="submenu-category">
                                <a href="#" class="submenu-title">USD &dollar;</a>
                            </li>

                          
                        </ul>
                    </li>

                </ul>

                <ul class="menu-social-container">

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

            </div>

        </nav>

    </header>