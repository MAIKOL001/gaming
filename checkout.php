<?php
include 'components/connect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
   header('location:user_login.php');
   exit(); // Terminate script after redirection
}

$user_id = $_SESSION['user_id'];

$message = []; // Initialize an empty array for messages

if (isset($_POST['order'])) {
   // Sanitize and validate input
   $name = trim($_POST['name']);
   $number = filter_var($_POST['number'], FILTER_VALIDATE_INT);
   $email = trim($_POST['email']);
   $method = trim($_POST['method']);
   $address = trim($_POST['flat']) . ', ' . trim($_POST['street']) . ', ' . trim($_POST['city']) . ', ' . trim($_POST['state']) . ', ' . trim($_POST['country']) . ' - ' . $_POST['pin_code'];
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   // Validate phone number
   if ($number === false) {
      $message[] = 'Invalid phone number';
   }

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if ($check_cart->rowCount() > 0) {
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'Order placed successfully!';
   } else {
      $message[] = 'Your cart is empty';
   }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
  background-color: #22222e;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}
h2{
    color: whitesmoke;
}
 p{
    color:whitesmoke;
 }
.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

select {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type=text], input[type=tel], input[type=email], input[type=number], select {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}

</style>

</head>
<body>

<h2>Checkout Form</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing & Shipping info</h3>
            <label for="name"><i class="fa fa-user"></i> Name :</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" class="box" maxlength="20" required>

            <label for="number"><i class="fa fa-phone"></i> Your Number :</label>
            <input type="tel" id="number" name="number" placeholder="Enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>

            <label for="email"><i class="fa fa-envelope"></i> Your Email :</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" class="box" maxlength="50" required>

            <label for="method"><i class="fa fa-credit-card"></i> Payment method :</label>
            <select name="method" id="method" class="box" required>
                <option value="cash on delivery">Cash On Delivery</option>
                <option value="credit card">Credit Card</option>
                <option value="mpesa">Mpesa</option>
                <option value="paypal">Paypal</option>
            </select>

            <label for="flat"><i class="fa fa-map-marker"></i> Address line 01 :</label>
            <input type="text" id="flat" name="flat" placeholder="e.g. Flat number" class="box" maxlength="50" required>

            <label for="street"><i class="fa fa-map-marker"></i> Address line 02 :</label>
            <input type="text" id="street" name="street" placeholder="Street name" class="box" maxlength="50" required>

            <label for="city"><i class="fa fa-map-marker"></i> City :</label>
            <input type="text" id="city" name="city" placeholder="City" class="box" maxlength="50" required>

            <label for="state"><i class="fa fa-map-marker"></i> County :</label>
            <input type="text" id="state" name="state" placeholder="County" class="box" maxlength="50" required>

            <label for="country"><i class="fa fa-map-marker"></i> Country :</label>
            <input type="text" id="country" name="country" placeholder="Country" class="box" maxlength="50" required>

            
          </div>

          <div class="col-50">
            <h3>Your Orders</h3>
            <div class="container">
                <?php
                $grand_total = 0;
                $cart_items = []; // Initialize an empty array
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                        $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ')';
                        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                        ?>
                        <p style="color: black;"><?= $fetch_cart['name']; ?> <span>(<?= '$' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
                        <?php
                    }
                } else {
                    echo '<p>Your cart is empty!</p>';
                }
                ?>
                <hr>
                <p> <span class="price" style="color:black;" >Total: <b>$<?= $grand_total; ?></b></span></p>
                <input type="hidden" name="total_products" value="<?= implode(', ', $cart_items); ?>">
                <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" name="order" value="Place Order" class="btn">
      </form>
      <form action="cart.php" method="POST">
      <input type="submit" value="Back" class="btn">
      </form>
    </div>
  </div>
  
</div>

</body>
</html>
