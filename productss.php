<?php
session_start();
include 'components/connect.php';



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
<?php include('./layouts/head.php') ?>
</head>

<body>


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
      - PRODUCT
    -->

        <div class="product-container">

            <div class="container">



                
            <?php include ('./layouts/sidebar.php'); ?>


                    <!--
            - PRODUCT GRID
          -->

                    <div class="product-main">

                        <h2 class="title"> Products </h2>

                        <div class="product-grid">

                            


                        
                        <?php
$select_products = $conn->prepare("SELECT * FROM `products` "); 
$select_products->execute();
if($select_products->rowCount() > 0){
    while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
?>
    <div class="showcase">

        <div class="showcase-banner">
        
            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" width="300" class="product-img default">
            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" width="300" class="product-img hover">

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
      <input type="submit" value="add to cart" class="btn" name="add_to_cart" style="margin-bottom:0.2rem;">
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
            - SERVICE
          -->

                    <div class="service">

                        <h2 class="title">Our Services</h2>

                        <div class="service-container">

                            <a href="#" class="service-item">

                                <div class="service-icon">
                                    <ion-icon name="boat-outline"></ion-icon>
                                </div>

                                <div class="service-content">

                                    <h3 class="service-title">Worldwide Delivery</h3>
                                    <p class="service-desc">For Order Over $100</p>

                                </div>

                            </a>

                            <a href="#" class="service-item">

                                <div class="service-icon">
                                    <ion-icon name="rocket-outline"></ion-icon>
                                </div>

                                <div class="service-content">

                                    <h3 class="service-title">Next Day delivery</h3>
                                    <p class="service-desc">UK Orders Only</p>

                                </div>

                            </a>

                            <a href="#" class="service-item">

                                <div class="service-icon">
                                    <ion-icon name="call-outline"></ion-icon>
                                </div>

                                <div class="service-content">

                                    <h3 class="service-title">Best Online Support</h3>
                                    <p class="service-desc">Hours: 8AM - 11PM</p>

                                </div>

                            </a>

                            <a href="#" class="service-item">

                                <div class="service-icon">
                                    <ion-icon name="arrow-undo-outline"></ion-icon>
                                </div>

                                <div class="service-content">

                                    <h3 class="service-title">Return Policy</h3>
                                    <p class="service-desc">Easy & Free Return</p>

                                </div>

                            </a>

                            <a href="#" class="service-item">

                                <div class="service-icon">
                                    <ion-icon name="ticket-outline"></ion-icon>
                                </div>

                                <div class="service-content">

                                    <h3 class="service-title">30% money back</h3>
                                    <p class="service-desc">For Order Over $100</p>

                                </div>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>





        <!--
      - BLOG
    -->

        <div class="blog">

            <div class="container">

                <div class="blog-container has-scrollbar">

                    <div class="blog-card">

                        <a href="#">
              <img src="./assets/images/blog-1.jpg" alt="Clothes Retail KPIs 2021 Guide for Clothes Executives" width="300" class="blog-banner">
            </a>

                        <div class="blog-content">

                            <a href="#" class="blog-category">Fashion</a>

                            <a href="#">
                                <h3 class="blog-title">Clothes Retail KPIs 2021 Guide for Clothes Executives.</h3>
                            </a>

                            <p class="blog-meta">
                                By <cite>Mr Admin</cite> / <time datetime="2022-04-06">Apr 06, 2022</time>
                            </p>

                        </div>

                    </div>

                    <div class="blog-card">

                        <a href="#">
              <img src="./assets/images/blog-2.jpg" alt="Curbside fashion Trends: How to Win the Pickup Battle."
                class="blog-banner" width="300">
            </a>

                        <div class="blog-content">

                            <a href="#" class="blog-category">Clothes</a>

                            <h3>
                                <a href="#" class="blog-title">Curbside fashion Trends: How to Win the Pickup Battle.</a>
                            </h3>

                            <p class="blog-meta">
                                By <cite>Mr Robin</cite> / <time datetime="2022-01-18">Jan 18, 2022</time>
                            </p>

                        </div>

                    </div>

                    <div class="blog-card">

                        <a href="#">
              <img src="./assets/images/blog-3.jpg" alt="EBT vendors: Claim Your Share of SNAP Online Revenue."
                class="blog-banner" width="300">
            </a>

                        <div class="blog-content">

                            <a href="#" class="blog-category">Shoes</a>

                            <h3>
                                <a href="#" class="blog-title">EBT vendors: Claim Your Share of SNAP Online Revenue.</a>
                            </h3>

                            <p class="blog-meta">
                                By <cite>Mr Selsa</cite> / <time datetime="2022-02-10">Feb 10, 2022</time>
                            </p>

                        </div>

                    </div>

                    <div class="blog-card">

                        <a href="#">
              <img src="./assets/images/blog-4.jpg" alt="Curbside fashion Trends: How to Win the Pickup Battle."
                class="blog-banner" width="300">
            </a>

                        <div class="blog-content">

                            <a href="#" class="blog-category">Electronics</a>

                            <h3>
                                <a href="#" class="blog-title">Curbside fashion Trends: How to Win the Pickup Battle.</a>
                            </h3>

                            <p class="blog-meta">
                                By <cite>Mr Pawar</cite> / <time datetime="2022-03-15">Mar 15, 2022</time>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>





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