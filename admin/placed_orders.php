<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

// Pagination parameters
$orders_per_page = 10; // Number of orders to display per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number

// Calculate the offset for database query
$offset = ($current_page - 1) * $orders_per_page;

// Fetch orders from the database for the current page
$select_orders = $conn->prepare("SELECT * FROM `orders` LIMIT $offset, $orders_per_page");
$select_orders->execute();
$orders = $select_orders->fetchAll(PDO::FETCH_ASSOC);

// Count total number of orders for pagination
$total_orders = $conn->query("SELECT COUNT(*) FROM `orders`")->fetchColumn();
$total_pages = ceil($total_orders / $orders_per_page); // Calculate total pages

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Placed Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="orders">
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
   </style>
   <h1 class="heading">Placed Orders</h1>
   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>Placed On</th>
               <th>Name</th>
               <th>Number</th>
               <th>Address</th>
               <th>Total Products</th>
               <th>Total Price</th>
               <th>Payment Method</th>
               <th>Payment Status</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($orders as $order) { ?>
               <tr>
                  <td><?= $order['placed_on']; ?></td>
                  <td><?= $order['name']; ?></td>
                  <td><?= $order['number']; ?></td>
                  <td><?= $order['address']; ?></td>
                  <td><?= $order['total_products']; ?></td>
                  <td>Ksh.<?= $order['total_price']; ?>/-</td>
                  <td><?= $order['method']; ?></td>
                  <td>
                     <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                        <select name="payment_status" class="select">
                           <option selected disabled><?= $order['payment_status']; ?></option>
                           <option value="pending">Pending</option>
                           <option value="completed">Completed</option>
                        </select>
                     </td>
                     <td>
                        <input type="submit" value="Update" class="option-btn" name="update_payment">
                        <a href="placed_orders.php?delete=<?= $order['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
                     </td>
                  </form>
               </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>

   <!-- Pagination links -->
   <div class="pagination">
      <?php if ($current_page > 1) { ?>
         <a href="placed_orders.php?page=<?= $current_page - 1; ?>" class="page-link">Previous</a>
      <?php } ?>
      <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
         <a href="placed_orders.php?page=<?= $i; ?>" class="page-link <?= $i == $current_page ? 'active' : ''; ?>"><?= $i; ?></a>
      <?php } ?>
      <?php if ($current_page < $total_pages) { ?>
         <a href="placed_orders.php?page=<?= $current_page + 1; ?>" class="page-link">Next</a>
      <?php } ?>
   </div>
</section>

</body>
</html>
