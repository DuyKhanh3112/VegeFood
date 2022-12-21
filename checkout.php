<html lang="en">
    <head>
        <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">

        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">

        <link rel="stylesheet" href="css/aos.css">

        <link rel="stylesheet" href="css/ionicons.min.css">

        <link rel="stylesheet" href="css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="css/jquery.timepicker.css">


        <link rel="stylesheet" href="css/flaticon.css">
        <link rel="stylesheet" href="css/icomoon.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="goto-here">
        <?php
        include_once './menu.php';
        ?>
        <!-- END nav -->
        <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <h1 class="mb-0 bread">Check Out</h1>
                    </div>
                </div>
            </div>
        </div>
        <br> 
        <?php
        include './process/connectdb.php';
        include './process_customer/customer_data.php';
        include './process_feedback/feedback_data.php';
        $customer = new customer("", "", "", "", "");
        $feedback = new feedback("", "", "", "", "");
        $customer->set_email($_SESSION["account"]);
        ?>
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <form method="POST" action="./process_order/order.php">
                        <?php
                        $result = $customer->showAll($conn);
                        while ($row = $result->fetch_assoc()) {
                            if ($row["email"] == $_SESSION["account"]) {
                                ?>
                                <table class="table">
                                    <h2>Information</h2>
                                    <tr>
                                        <td>Name: </td>
                                        <td><input type="text" class="form-control" name="fullname" value="<?php echo $row["fullname"]; ?>" readonly></td>
                                        <td>Email:</td>
                                        <td><input type="text" class="form-control" name="email" value="<?php echo $row["email"]; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Phone: </td>
                                        <td><input type="text"  class="form-control" name="phone" value="<?php echo $row["phone"]; ?>"></td>
                                        <td>Address: </td>
                                        <td><input type="text"  class="form-control" name="address" value="<?php echo $row["address"]; ?>"></td>
                                    </tr>               
                                </table>  
                                <?php
                            }
                        }
                        ?>
                        <!-- cart -->
                        <?php
                        require_once './process/connectdb.php';
                        require_once './process_product/product_data.php';
                        $arrProductID = array();
                        if (isset($_SESSION[$_SESSION["account"]]) && $_SESSION[$_SESSION["account"]]) {
                            foreach ($_SESSION[$_SESSION["account"]] as $id => $value) {
                                $arrProductID[] = $id;
                            }
                            $strIDs = implode(",", $arrProductID);
                            $stmt = $conn->prepare("select product_ID,product_Name,product_Price, productURL from product where product_ID in ($strIDs)");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            ?>
                            <br> 
                            <table class="table">
                                <h2>Billing Details</h2>
                                <?php
                                $total = 0;
                                $_SESSION["quantity"] = 0;
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr class="text-center">
                                        <td class="image-prod"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['productURL']) . '" width="200px"/>'; ?></td>
                                        <td class="product-name"><?php echo $row["product_Name"]; ?></td>
                                        <td class="price">$<?php echo $row["product_Price"]; ?></td>
                                        <td class="quantity" ><?php echo $_SESSION[$_SESSION["account"]][$row['product_ID']]['quantity']; ?></td>
                                        <td class="total">$<?php echo $row["product_Price"] * $_SESSION[$_SESSION["account"]][$row['product_ID']]['quantity']; ?></td>
                                    </tr><!-- END TR-->
                                    <?php
                                    $total += $row["product_Price"] * $_SESSION[$_SESSION["account"]][$row['product_ID']]['quantity'];
                                }
                                ?>
                                <tr>
                                    <td>Total:</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>$<?php echo $total;?></td>
                                </tr>
                                <tr>
                                    <td>Fee shipping:</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>$<?php $fee= $total>200?0:$total*0.05; echo $fee;?></td>
                                </tr>
                                <tr>
                                    <td>Pay:</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>$<?php echo $total+$fee;?></td>
                                </tr>
                                <?php
                            }
                            $_SESSION['total']=$total;
                            $_SESSION['fee']=$fee;
                            ?>
                        </table>
                            <table class="table">
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td> <input type="submit" class="btn btn-primary" value="Order" style="text-align: left"></td>
                                </tr>
                            </table>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include_once './footer.php';
        ?>



        <!-- loader -->
        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-migrate-3.0.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/jquery.stellar.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/jquery.animateNumber.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/scrollax.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="js/google-map.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>