<?php
    session_start();
    $database_name = "plants_nursery";
    $con = mysqli_connect("localhost","root","","plants_nursery");
    
    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'item_description' => $_POST["hidden_description"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="IndoorP1.php"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="IndoorP1.phpp"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_description' => $_POST["hidden_description"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been Removed from the Cart!")</script>';
                    echo '<script>window.location="add2cart.php"</script>';
                }
            }
        }
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Plants Nursery</title>
    <link rel="stylesheet" type="text/css" href="AddToCart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
       
        table, th, tr, td{
            margin: 10px;
            padding: 10px;
            text-align: center;
        }
        .title2{
            margin-top: 100px;
            margin-right: 10px;
            margin-left: 10px;
            text-align: center;
            font-size: 25px;
            color: green;
            background-color: lightgreen;
            padding: 2%;
        }
        table th{  
            background: lightgreen;
            font-size: 20px;
            margin-bottom: 10px;
        }
        table tr{  
            margin:10px;
            padding: 10px;
            font-size: 20px;
        }
        table td{
            border: solid;
            border-style: outset;
        }
        .remove{
            color: red;
        }
        .remove:hover{
            color: green;
        }
        .btn {
            background-color: lightgreen;
            padding: 15px;
            margin: 10px;
            border: none;
            width: 98.5%;
            font-size: 20px;
        }
        .btn:hover {
            color: white;
            background-color: #0CBABA;
        }
    </style>
</head>
<body>
        <header>
            <div class="navbar">
                <div class="title">
                    <a href="Plants/Homepage.html">Plants Nursery</a>
                </div>
                <nav>
                    <ul>
                        <li><a href="Plants/Homepage.html">Home</a></li>
                        <li><a href="Plants/Shop.html">Shop</a></li>
                        <li><a href="Plants/Handover.html">Handover</a></li>
                        <li><a href="add2cart.php"><i class="fa fa-shopping-cart fa-lg"></i></a></li>
                        <li><a href="Plants/logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        </br>
        <div style="clear: both"></div>
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="1000px">Product Name</th>
                <th width="200px">Quantity</th>
                <th width="200px">Price Details</th>
                <th width="250px">Total Price</th>
                <th width="300px">Remove Item</th>
            </tr>

            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td>&#8377; <?php echo $value["product_price"]; ?></td>
                            <td>
                                &#8377; <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            <td><a href="IndoorP1.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        class="remove">Remove Item</span></a></td>

                        </tr>
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                        ?>
                        <tr>
                            <td colspan="3" align="right"><b>TOTAL</b></td>
                            <th align="right">&#8377; <?php echo number_format($total, 2); ?></th>
                            <td></td>
                        </tr>

                        <?php
                    }
                ?>
            </table>
        </div>
        <a href="Checkout.php"><input type="submit" value="Checkout" class="btn"></a>
    </div>
    <br>
    <footer>
				<div class="BackToTop">
					<center><a href="Homepage.html">BACK TO TOP</a></center>
				</div>
				<div class="main-content">
					<div class="left box">
						<h2>About Us</h2>
						<div class="content">
							<p>We are <strong>Team Vanaspati</strong>, passionate about promoting green living through indoor and outdoor plants.</p>
							<p>This website is designed to help you purchase quality plants and learn more about how greenery can enhance your life and the environment.</p>
							<p><strong>More Green Plants → Better Living.</strong></p>
						</div>
					</div>
			
					<div class="center box">
						<h2>Address</h2>
						<div class="content">
							<div class="place">
								<span class="fa fa-map-marker">&nbsp;</span>
								<span class="text">Worli, Mumbai, Maharashtra, India</span>
							</div>
							<br>
							<div class="phone">
								<span class="fa fa-phone">&nbsp;</span>
								<span class="text">+91 9004565911</span>
							</div>
							<br>
							<div class="email">
								<span class="fa fa-envelope">&nbsp;</span>
								<span class="text">contact@vanaspati.com</span>
							</div>
							<div class="downtitle">Plants Nursery</div>
						</div>
					</div>
			
					<div class="right box">
						<h2>Contact Us</h2>
						<div class="content">
							<form action="ContactUs.php" method="POST">
								<div class="email">
									<div class="text">Email:</div>
									<input type="email" name="email" required>
								</div>
								<br>
								<div class="msg">
									<div class="text">Message:</div>
									<textarea rows="3" cols="25" name="msg" required></textarea>
								</div>
								<br>
								<div class="btn">
									<button type="submit">Send</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			
				<div class="bottom">
					<center>
						<span class="credit">Created by <strong>Team Vanaspati</strong></span>
						<span class="fa fa-copyright"></span>
						<span>2025 All rights reserved.</span>
					</center>
				</div>
			</footer>
</body>
</html>
