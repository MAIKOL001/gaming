<?php



include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/' . $image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/' . $image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/' . $image_03;



   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products` (category, name, details, price, image_01, image_02, image_03) VALUES(?, ?, ?, ?, ?, ?, ?)");
      $insert_products->execute([$category, $name, $details, $price, $image_01, $image_02, $image_03]);
      

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'new product added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}

$records_per_page = 10; // Number of records to display per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number

// Calculate the offset for database query
$offset = ($current_page - 1) * $records_per_page;

// Fetch records from the database for the current page
$select_products = $conn->prepare("SELECT * FROM `products` LIMIT $offset, $records_per_page");
$select_products->execute();
$products = $select_products->fetchAll(PDO::FETCH_ASSOC);

// Count total number of records for pagination
$total_records = $conn->query("SELECT COUNT(*) FROM `products`")->fetchColumn();
$total_pages = ceil($total_records / $records_per_page); // Calculate total pages


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
<style>
 .show-products {
         padding: 20px; /* Add padding to the show-products section for spacing */
      }

      .table-container {
         overflow-x: auto;
         width: 100%; /* Enable horizontal scrolling for the table if needed */
      }

      table {
         width: 100%; /* Make the table take up 100% width of its container */
         border-collapse: collapse; /* Collapse table borders */
      }

      th, td {
         border: 1px solid #dddddd; /* Add borders to table cells */
         padding: 8px; /* Add padding to table cells */
         text-align: left;
         font-size: 2rem; /* Align text to the left */
      }

      /* Add this CSS to your existing admin_style.css or any other relevant CSS file */
.pagination {
  margin-top: 20px; /* Add some spacing above the pagination links */
}

.pagination a {
  display: inline-block;
  padding: 5px 10px; /* Add padding around the links */
  margin-right: 5px; /* Add some spacing between the links */
  border: 1px solid #ccc; /* Add border to the links */
  background-color: #f2f2f2; /* Add background color to the links */
  color: #333; /* Change text color of the links */
  text-decoration: none; /* Remove underline from the links */
  font-size: 14px; /* Increase font size of the links */
}

.pagination a:hover {
  background-color: #ddd; /* Change background color on hover */
}

.pagination .active {
  background-color: #007bff; /* Change background color of the active page */
  color: #fff; /* Change text color of the active page */
}


      th {
         background-color: #f2f2f2; /* Background color for table headers */
      }

</style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

  <a href="add_product.php">
      
      <input type="submit" value="add product" class="btn" name="add_product">
  </a>
</section>


<div class="table-container">
<h1 class="heading">Products Added.</h1>
   <div class="box-container">
      <table>
         <!-- Table headers -->
         <thead>
            <tr>
               <th>Image</th>
               <th>Name</th>
               <th>Price</th>
               <th>Details</th>
               <th>Actions</th>
            </tr>
         </thead>
         <!-- Table body -->
         <tbody>
            <?php foreach ($products as $product) { ?>
               <tr>
                  <td><img src="../uploaded_img/<?= $product['image_01']; ?>" alt=""></td>
                  <td><?= $product['name']; ?></td>
                  <td>Ksh. <span><?= $product['price']; ?></span>/-</td>
                  <td><?= $product['details']; ?></td>
                  <td>
                     <a href="update_product.php?update=<?= $product['id']; ?>" class="option-btn">update</a>
                     <a href="products.php?delete=<?= $product['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
                  </td>
               </tr>
            <?php } ?>
         </tbody>
      </table>

      <!-- Pagination links -->
      <div class="pagination">
         <?php if ($current_page > 1) { ?>
            <a href="?page=<?= $current_page - 1; ?>">Previous</a>
         <?php } ?>
         <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
         <?php } ?>
         <?php if ($current_page < $total_pages) { ?>
            <a href="?page=<?= $current_page + 1; ?>">Next</a>
         <?php } ?>
      
   </div>

</div>









<script src="../js/admin_script.js"></script>
   
</body>
</html>