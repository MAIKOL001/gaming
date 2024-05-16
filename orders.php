<?php
include 'components/connect.php';
session_start();

// Check if user is logged in
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

// Pagination variables
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1
$start = ($page - 1) * $limit; // Starting index for fetching records

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <?php include ('./layouts/head.php'); ?>
   <link rel="stylesheet" href="./assets/css/orders.css">
</head>

<body>


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
        <?php include ('./layouts/mobilenav.php' )?>





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

          <div class="product-featured">
  <h2 class="title">Placed Orders</h2>
  <div class="showcase-wrapper has-scrollbar">
<style>
    .pagination {
    margin-top: 20px;
    text-align: center;
}

.pagination a {
    display: inline-block;
    padding: 8px 16px;
    margin: 0 5px;
    background-color: #f5f5f5;
    color: #333;
    border-radius: 5px;
    text-decoration: none;
}

.pagination a:hover {
    background-color: #ddd;
}

.pagination .active {
    background-color: #007bff;
    color: white;
}

</style>
  <table class="responsive-table" style="border-radius: 0.5rem;">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Placed On</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Payment Method</th>
            <th>Total Products</th>
            <th>Total Price</th>
            <th>Payment Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch and display orders
        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
        $select_orders->execute([$user_id]);
        if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                ?>
        <tr>
            <td><?= $fetch_orders['id']; ?></td>
            <td><?= $fetch_orders['placed_on']; ?></td>
            <td><?= $fetch_orders['name']; ?></td>
            <td><?= $fetch_orders['email']; ?></td>
            <td><?= $fetch_orders['number']; ?></td>
            <td><?= $fetch_orders['address']; ?></td>
            <td><?= $fetch_orders['method']; ?></td>
            <td><?= $fetch_orders['total_products']; ?></td>
            <td>ksh.<?= $fetch_orders['total_price']; ?>/-</td>
            <td style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></td>
        </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="10">No orders placed yet!</td></tr>';
        }
        ?>
    </tbody>
</table>
    </div>
   <!-- Pagination links -->
   <?php
                        $pagination_query = "SELECT COUNT(*) as total FROM `orders` WHERE user_id = ?";
                        $pagination_stmt = $conn->prepare($pagination_query);
                        $pagination_stmt->execute([$user_id]);
                        $row = $pagination_stmt->fetch(PDO::FETCH_ASSOC);
                        $total_records = $row['total'];
                        $total_pages = ceil($total_records / $limit);
                        ?>
                        <div class="pagination">
                            <?php
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<a href="?page=' . $i . '">' . $i . '</a>';
                            }
                            ?>
                        </div>
</div>

                    <!--
            - PRODUCT GRID
          -->

                    <div class="product-main">

                        <h2 class="title">Related Products</h2>

                        <div class="product-grid">

                        <?php
                         
                            $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 4");
                            $select_products->execute();
                            if($select_products->rowCount() > 0){
                                while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
                                    ?>
    <div class="showcase">

        <div class="showcase-banner">
        
            <img src=" uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" width="300" class="product-img default">
            <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="" width="300" class="product-img hover">

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