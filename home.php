<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

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

  <?php include ('./layouts/desktopnav.php'); ?>
 
  <?php include ('./layouts/mobilenav.php'); ?>








    <!--
    - MAIN
  -->
   

    <main>

        <!--
      - BANNER
    -->

        <div class="banner">

            <div class="container">

                <div class="slider-container has-scrollbar " style="width:100%;">

                    <div class="slider-item">

                        <img src="./assets/images/banner 2.jpeg" alt="women's latest fashion sale" class="banner-img">

                        <div class="banner-content">

                            <p class="banner-subtitle">Trending item</p>

                            <h2 class="banner-title">56 inch tv screens</h2>

                            <p class="banner-text">
                                starting at &dollar; <b>20</b>.00
                            </p>

                            <a href="#" class="banner-btn">Shop now</a>

                        </div>

                    </div>

                    <div class="slider-item">

                        <img src="./assets/images/banner 3.jpeg" alt="modern sunglasses" class="banner-img">

                        <div class="banner-content">

                            <p class="banner-subtitle">Sound Woofers</p>

                            <h2 class="banner-title">Modern speakers and headphones</h2>

                            <p class="banner-text">
                                starting at &dollar; <b>15</b>.00
                            </p>

                            <a href="#" class="banner-btn">Shop now</a>

                        </div>

                    </div>

                    <div class="slider-item">

                        <img src="./assets/images/banner 4.jpeg" alt="new fashion summer sale" class="banner-img">

                        <div class="banner-content">

                            <p class="banner-subtitle">Sale Offer</p>

                            <h2 class="banner-title">Get unlimited Discounts</h2>

                            <p class="banner-text">
                                starting at &dollar; <b>29</b>.99
                            </p>

                            <a href="#" class="banner-btn">Shop now</a>

                        </div>

                    </div>

                </div>

            </div>

        </div>





        <!--
      - CATEGORY
    -->

        <div class="category">

            <div class="container">
            <h2 class="title">Popular Categories</h2>
                <div class="category-item-container has-scrollbar">
               

                <a href="category.php?category=woofers">
                    <div class="category-item">

                        <div class="category-img-box">
                            <img src="./assets/images/icons/speakers.svg" alt="Woofers" width="30">
                        </div>

                        <div class="category-content-box">

                            <div class="category-content-flex">
                                <h3 class="category-item-title">Woofers</h3>

                            </div>

                            <a href="category.php?category=woofers" class="category-btn">Show all</a>

                        </div>

                    </div>
                </a>

                
   <a href="category.php?category=chairs">
                    <div class="category-item">

                        <div class="category-img-box">
                            <img src="./assets/images/icons/chairs.svg" alt="chairs" width="30">
                        </div>

                        <div class="category-content-box">

                            <div class="category-content-flex">
                                <h3 class="category-item-title">Gaming chairs</h3>

                            </div>

                            <a href="category.php?category=chairs" class="category-btn">Show all</a>

                        </div>

                    </div>
   </a>


   
   <a href="category.php?category=desktop">
                    <div class="category-item">

                        <div class="category-img-box">
                            <img src="./assets/images/icons/desktop.svg" alt="desktop" width="30">
                        </div>

                        <div class="category-content-box">

                            <div class="category-content-flex">
                                <h3 class="category-item-title">Desktops</h3>
                            </div>

                            <a href="category.php?category=desktop" class="category-btn">Show all</a>

                        </div>
                    </div>
   </a>


   
   <a href="category.php?category=laptop">
                    <div class="category-item">

                        <div class="category-img-box">
                            <img src="./assets/images/icons/laptops.svg" alt="laptop" width="30">
                        </div>

                        <div class="category-content-box">

                            <div class="category-content-flex">
                                <h3 class="category-item-title">Laptops</h3>

                            </div>

                            <a href="category.php?category=laptop" class="category-btn">Show all</a>

                        </div>
                    </div>
   </a>
                    

                    <a href="category.php?category=playstation">
                    <div class="category-item">

                        <div class="category-img-box">
                            <img src="./assets/images/icons/playstation.svg" alt="playstaion" width="30">
                        </div>

                        <div class="category-content-box">

                            <div class="category-content-flex">
                                <h3 class="category-item-title">Playstations</h3>

                               
                            </div>

                            <a href="category.php?category=playstation" class="category-btn">Show all</a>
                           
                        </div>

                    </div>
                    </a>
                   

                </div>

            </div>

        </div>





        <!--
      - PRODUCT
    -->

        <div class="product-container">

            <div class="container">


                <!--
          - SIDEBAR
        -->

               <?php include ('./layouts/sidebar.php'); ?>



                <div class="product-box">

                    <!--
            - PRODUCT MINIMAL
          -->

                    <div class="product-minimal">

                        <div class="product-showcase">

                            <h2 class="title">New Arrivals</h2>

                            <div class="showcase-wrapper has-scrollbar">

                                <div class="showcase-container">
                                <?php
     $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY id DESC LIMIT 3"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
                                    <div class="showcase">
                                    
     
                                        <a href="#" class="showcase-img-box">
                      <img src=" uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" width="70" class="showcase-img">
                    </a>

                                        <div class="showcase-content">

                                        <a href="exa.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye">
                                                <h4 class="showcase-title"><?= $fetch_product['name']; ?></h4>
                                            </a>

                                            <a href="#" class="showcase-category"><?= $fetch_product['category']; ?></a>

                                            <div class="price-box">
                                                <p class="price">Ksh.<?= $fetch_product['price']; ?></p>
                                                <del>Ksh.12.00</del>
                                            </div>

                                        </div>

                                    </div>
                                    <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
                                    

                                </div>

                                <div class="showcase-container">
                                <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 3"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
                                    <div class="showcase">
                                    
     
                                        <a href="#" class="showcase-img-box">
                      <img src=" uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" width="70" class="showcase-img">
                    </a>

                                        <div class="showcase-content">

                                        <a href="exa.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye">
                                                <h4 class="showcase-title"><?= $fetch_product['name']; ?></h4>
                                            </a>

                                            <a href="#" class="showcase-category"><?= $fetch_product['category']; ?></a>

                                            <div class="price-box">
                                                <p class="price">Ksh.<?= $fetch_product['price']; ?></p>
                                                <del>Ksh.12.00</del>
                                            </div>

                                        </div>

                                    </div>
                                    <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

                                    

                                </div>

                            </div>

                        </div>

                        <div class="product-showcase">

                            <h2 class="title">Trending</h2>

                            <div class="showcase-wrapper  has-scrollbar">

                                <div class="showcase-container">
                                <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 3"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
                                    <div class="showcase">
                                    
     
                                        <a href="#" class="showcase-img-box">
                      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" width="70" class="showcase-img">
                    </a>

                                        <div class="showcase-content">
                                        <a href="exa.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye">
                                                <h4 class="showcase-title"><?= $fetch_product['name']; ?></h4>
                                            </a>

                                            <a href="#" class="showcase-category"><?= $fetch_product['category']; ?></a>

                                            <div class="price-box">
                                                <p class="price">Ksh.<?= $fetch_product['price']; ?></p>
                                                <del>Ksh.12.00</del>
                                            </div>

                                        </div>

                                    </div>
                                    <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

                                </div>

                                <div class="showcase-container">

                                <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 3"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
                                    <div class="showcase">
                                    
     
                                        <a href="#" class="showcase-img-box">
                      <img src=" uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" width="70" class="showcase-img">
                    </a>

                                        <div class="showcase-content">

                                        <a href="exa.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye">
                                                <h4 class="showcase-title"><?= $fetch_product['name']; ?></h4>
                                            </a>

                                            <a href="#" class="showcase-category"><?= $fetch_product['category']; ?></a>

                                            <div class="price-box">
                                                <p class="price">Ksh.<?= $fetch_product['price']; ?></p>
                                                <del>Ksh.12.00</del>
                                            </div>

                                        </div>

                                    </div>
                                    <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

                                    


                                </div>

                            </div>

                        </div>

                        <div class="product-showcase">

                            <h2 class="title">Top Rated</h2>

                            <div class="showcase-wrapper  has-scrollbar">

                                <div class="showcase-container">

                                <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 3"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
                                    <div class="showcase">
                                    
     
                                        <a href="#" class="showcase-img-box">
                      <img src=" uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" width="70" class="showcase-img">
                    </a>

                                        <div class="showcase-content">

                                        <a href="exa.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye">
                                                <h4 class="showcase-title"><?= $fetch_product['name']; ?></h4>
                                            </a>

                                            <a href="#" class="showcase-category"><?= $fetch_product['category']; ?></a>
                                            <div class="price-box">
                                                <p class="price">Ksh.<?= $fetch_product['price']; ?></p>
                                                <del>Ksh.12.00</del>
                                            </div>

                                        </div>

                                    </div>
                                    <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

                                    


                                </div>

                                <div class="showcase-container">

                                <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 3"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
                                    <div class="showcase">
                                    
     
                                        <a href="#" class="showcase-img-box">
                      <img src=" uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" width="70" class="showcase-img">
                    </a>

                                        <div class="showcase-content">

                                        <a href="exa.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye">
                                                <h4 class="showcase-title"><?= $fetch_product['name']; ?></h4>
                                            </a>

                                            <a href="#" class="showcase-category"><?= $fetch_product['category']; ?></a>

                                            <div class="price-box">
                                                <p class="price">Ksh.<?= $fetch_product['price']; ?></p>
                                                <del>Ksh.12.00</del>
                                            </div>

                                        </div>

                                    </div>
                                    <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!--
            - PRODUCT FEATURED
          -->

                    <div class="product-featured">

                        <h2 class="title">Deal of the day</h2>

                        <div class="showcase-wrapper has-scrollbar">

                            <div class="showcase-container">
                            <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 1"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
                                <div class="showcase">

                                    <div class="showcase-banner">
                                        <img src=" uploaded_img/<?= $fetch_product['image_01']; ?>" alt="laptop" class="showcase-img">
                                    </div>

                                    <div class="showcase-content">

                                        <div class="showcase-rating">
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star-outline"></ion-icon>
                                            <ion-icon name="star-outline"></ion-icon>
                                        </div>

                                        <a href="#">
                                            <h3 class="showcase-title"><?= $fetch_product['name']; ?></h3>
                                        </a>

                                        <p class="showcase-desc">
                                        <?= $fetch_product['details']; ?>        
                                    </p>

                                        <div class="price-box">
                                            <p class="price">ksh<?= $fetch_product['price']; ?></p>

                                            <del>ksh200.00</del>
                                        </div>
                                        <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <div class="flex">
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1" style="margin-bottom:0.2rem;" hidden>
      </div>
      <input type="submit" value="add to cart" class="add-cart-btn" name="add_to_cart" style="margin-bottom:0.2rem;">
   </form>
                                        

                                        <div class="showcase-status">
                                            <div class="wrapper">
                                                <p>
                                                    already sold: <b>20</b>
                                                </p>

                                                <p>
                                                    available: <b>40</b>
                                                </p>
                                            </div>

                                            <div class="showcase-status-bar"></div>
                                        </div>

                                        <div class="countdown-box">

                                            <p class="countdown-desc">
                                                Hurry Up! Offer ends in:
                                            </p>

                                            <div class="countdown">

                                                <div class="countdown-content">

                                                    <p class="display-number">360</p>

                                                    <p class="display-text">Days</p>

                                                </div>

                                                <div class="countdown-content">
                                                    <p class="display-number">24</p>
                                                    <p class="display-text">Hours</p>
                                                </div>

                                                <div class="countdown-content">
                                                    <p class="display-number">59</p>
                                                    <p class="display-text">Min</p>
                                                </div>

                                                <div class="countdown-content">
                                                    <p class="display-number">00</p>
                                                    <p class="display-text">Sec</p>
                                                </div>

                                            </div>

                                        </div>
                                                               </div>

                                </div>
                                <?php
                                    }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
         
                            </div>

                            <div class="showcase-container">

                            <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 1"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
                                <div class="showcase">

                                    <div class="showcase-banner">
                                        <img src=" uploaded_img/<?= $fetch_product['image_01']; ?>" alt="laptop" class="showcase-img">
                                    </div>

                                    <div class="showcase-content">

                                        <div class="showcase-rating">
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star-outline"></ion-icon>
                                            <ion-icon name="star-outline"></ion-icon>
                                        </div>

                                        <a href="#">
                                            <h3 class="showcase-title"><?= $fetch_product['name']; ?></h3>
                                        </a>

                                        <p class="showcase-desc">
                                        <?= $fetch_product['details']; ?>        
                                    </p>

                                        <div class="price-box">
                                            <p class="price">ksh<?= $fetch_product['price']; ?></p>

                                            <del>ksh200.00</del>
                                        </div>
                                        <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <div class="flex">
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1" style="margin-bottom:0.2rem;" hidden>
      </div>
      <input type="submit" value="add to cart" class="add-cart-btn" name="add_to_cart" style="margin-bottom:0.2rem;">
   </form>
                                        

                                        <div class="showcase-status">
                                            <div class="wrapper">
                                                <p>
                                                    already sold: <b>20</b>
                                                </p>

                                                <p>
                                                    available: <b>40</b>
                                                </p>
                                            </div>

                                            <div class="showcase-status-bar"></div>
                                        </div>

                                        <div class="countdown-box">

                                            <p class="countdown-desc">
                                                Hurry Up! Offer ends in:
                                            </p>

                                            <div class="countdown">

                                                <div class="countdown-content">

                                                    <p class="display-number">360</p>

                                                    <p class="display-text">Days</p>

                                                </div>

                                                <div class="countdown-content">
                                                    <p class="display-number">24</p>
                                                    <p class="display-text">Hours</p>
                                                </div>

                                                <div class="countdown-content">
                                                    <p class="display-number">59</p>
                                                    <p class="display-text">Min</p>
                                                </div>

                                                <div class="countdown-content">
                                                    <p class="display-number">00</p>
                                                    <p class="display-text">Sec</p>
                                                </div>

                                            </div>

                                        </div>
                                                               </div>

                                </div>
                                <?php
                                    }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
         

                            </div>

                        </div>

                    </div>



                    <!--
            - PRODUCT GRID
          -->

                    <div class="product-main">

                        <h2 class="title">New Products</h2>

                        <div class="product-grid">
                        <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 12"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
                            <div class="showcase">

<div class="showcase-banner">

    <img src=" uploaded_img/<?= $fetch_product['image_01']; ?>" alt="photo" width="300" class="product-img default">
    <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="photo" width="300" class="product-img hover">

    <p class="showcase-badge">15%</p>

    <div class="showcase-actions">

        <form action="" method="post">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
<input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
<input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
            <button type="submit" name="add_to_wishlist" class="btn-action">
                <ion-icon name="heart-outline"></ion-icon>
            </button>
        </form>

        <a href="exa.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye">
            <button class="btn-action">
                <ion-icon name="eye-outline"></ion-icon>
            </button>
        </a>

    </div>

</div>

<div class="showcase-content">

    <a href="#" class="showcase-category"><?= $fetch_product['name'];?></a>

    <div class="showcase-rating">
        <ion-icon name="star"></ion-icon>
        <ion-icon name="star"></ion-icon>
        <ion-icon name="star"></ion-icon>
        <ion-icon name="star-outline"></ion-icon>
        <ion-icon name="star-outline"></ion-icon>
    </div>
    <div class="price-box">
        <p class="price">ksh <?= $fetch_product['price'];?></p>
        <del>ksh 7500</del>
    </div>
    <form action="" method="post" class="swiper-slide slide">
<input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
<input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
<input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
<input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
<button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
<div class="flex">
 <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1" style="margin-bottom:0.2rem;">
</div>
<input type="submit" value="add to cart" class="add_to_cart" name="add_to_cart" style="margin-bottom:0.2rem;">
</form>

    

</div>

</div>
<?php
}
}else{
echo '<p class="empty">no products added yet!</p>';
}
?>


                           
                           

                            
                           
                            

                        </div>

                    </div>

                </div>

            </div>

        </div>





       <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

    <div>

<div class="container">

    <div class="testimonials-box">

        <!--
- TESTIMONIALS
-->

<?php include ('./layouts/testserv.php'); ?>



<!--
- BLOG
-->

<?php include ('./layouts/blog.php'); ?>

               





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