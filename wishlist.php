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
        
        <div class="showcase-wrapper has-scrollbar">
        
        </div>
    </div>
</div>

<section class="products">
   <h3 class="heading" style="color: whitesmoke;">Your Wishlist.</h3>
   <div class="box-container flex">
   <?php
      $grand_total = 0;
      $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
      $select_wishlist->execute([$user_id]);
      if($select_wishlist->rowCount() > 0){
         while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
            $grand_total += $fetch_wishlist['price'];  
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
      <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_wishlist['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">
      <a href="exa.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye">view</a>
      <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="">
      <div class="name"><?= $fetch_wishlist['name']; ?></div>
      <div class="flex">
         <div class="price">KSH <?= $fetch_wishlist['price']; ?>/-</div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
      <input type="submit" value="delete item" onclick="return confirm('delete this from wishlist?');" class="delete-btn" name="delete">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">your wishlist is empty</p>';
   }
   ?>
   </div>
   <div class="wishlist-total">
      <p>Grand Total : <span>Ksh.<?= $grand_total; ?>/-</span></p>
      <a href="productss.php" class="option-btn">Continue Shopping.</a>
      <a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from wishlist?');">delete all item</a>
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