<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

include 'components/wishlist_cart.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include ('./layouts/head.php'); ?>
   <link rel="stylesheet" href="./assets/css/cart.css">
</head>

<body>

<div class="overlay" data-overlay></div>

<div class="modal" data-modal>
   <div class="modal-close-overlay" data-modal-overlay></div>
      <button data-modal-close></button>
</div>

<button data-toast-close></button>

<?php include ('./layouts/desktopnav.php'); ?>
<?php include ('./layouts/mobilenav.php' )?>

<main>
    <div class="product-container">
        <div class="container">
            <?php include ('./layouts/sidebar.php'); ?>

            <div class="product-box">
                <div class="product-featured">
                    <h2 class="title">Shopping Cart</h2>
                    <div class="showcase-wrapper has-scrollbar">
                        <table class="responsive-table" style="border-radius: 0.5rem;">
                            <thead>
                                <tr>
                                    <th hidden>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_price = 0;
                                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                                $select_cart->execute([$user_id]);
                                if ($select_cart->rowCount() > 0) {
                                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                        // Fetch product details
                                        $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                                        $select_product->execute([$fetch_cart['pid']]);
                                        
                                        $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);

                                        // Calculate subtotal for each item
                                        $subtotal = $fetch_cart['quantity'] * $fetch_cart['price'];
                                        // Add subtotal to total price
                                        $total_price += $subtotal;
                                        ?>
                                        <tr>
                                            <td hidden><?= $fetch_cart['id']; ?></td>
                                            <td><img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="Product Image" class="product-image"></td>
                                            <td><?= $fetch_cart['name']; ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                                                    <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                                                    <button type="submit" class="update-button" name="update_qty">Update</button>
                                                </form>
                                            </td>
                                            <td>ksh.<?= $subtotal; ?>/-</td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                                                    <button type="submit" class="delete-button" name="delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3"><strong>Total Price:</strong></td>
                                        <td><strong>ksh.<?= $total_price; ?>/-</strong></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                } else {
                                    echo '<tr><td colspan="5">No items found in cart</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="total-price-container">
                        <p style="color:#d7409d;">Total Price: Ksh.<?= $total_price; ?>/-</p>
                        <div class="action-buttons">
                            <a href="checkout.php" class="proceed-checkout-button">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>

                <div class="product-main">
                    <h2 class="title">Related Products</h2>

                    <div class="product-grid">
                        <?php
                        $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
                        $select_products->execute();
                        if($select_products->rowCount() > 0){
                            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="showcase">
                            <div class="showcase-banner">
                                <img src="./assets/images/products/pro 4.jpeg" alt="" width="300" class="product-img default">
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
                        } else {
                            echo '<p class="empty">no products added yet!</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- FOOTER -->
<?php include ('./layouts/footer'); ?>

<!-- custom js link -->
<script src="./assets/js/script.js"></script>

<!-- ionicon link -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
