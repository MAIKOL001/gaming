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
<?php include('./layouts/head.php') ?>
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
      - PRODUCT
    -->

        <div class="product-container">

            <div class="container">



                
            <?php include ('./layouts/sidebar.php'); ?>

             



                    <!--
            - PRODUCT FEATURED
          -->

                    

                            



                    <!--
            - PRODUCT GRID
          -->

                    <div class="product-main">

                        <h2 class="title"> Products </h2>

                        <div class="product-grid">

                            


                        
                        <?php
     $category = $_GET['category'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?"); // Corrected query
     $select_products->execute([$category]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
    <div class="showcase">

<div class="showcase-banner">
    
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
    - FOOTER
  -->
<?php include('./layouts/footer.php'); ?>






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