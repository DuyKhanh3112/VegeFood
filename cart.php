<!DOCTYPE html>
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
                        <h1 class="mb-0 bread">My Cart</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="ftco-section ftco-cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <table class="table table-hover">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>Product name</th>
                                        <th>Price</th>
                                        <th>&nbsp;</th>
                                        <th>Quantity</th>
                                        <th>&nbsp;</th>
                                        <th>Total</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <?php
                                        $total = 0;
                                        $_SESSION["quantity"] = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr class="text-center">
                                                <td class="image-prod"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['productURL']) . '" width="200px"/>'; ?></td>
                                                <td class="product-name">
                                                    <h3><?php echo $row["product_Name"]; ?></h3>
                                                    <p>Far far away, behind the word mountains, far from the countries</p>
                                                </td>

                                                <td class="price">$<?php echo $row["product_Price"]; ?></td>
                                                <td class="price"><a  class="btn btn-primary" href="./process_order/cart_update.php?action=minus&id=<?php echo $row['product_ID'];?>">-</a></td>                                              
                                                <td class="quantity" >
                                                    <?php
                                                    echo $_SESSION[$_SESSION["account"]][$row['product_ID']]['quantity'];
                                                    ?>
                                                </td>
                                                <td class="price"><a  class="btn btn-primary" href="./process_order/cart_update.php?action=add&id=<?php echo $row['product_ID']; ?>">+</a></td>
                                                <td class="total">$<?php echo $row["product_Price"] * $_SESSION[$_SESSION["account"]][$row['product_ID']]['quantity']; ?></td>
                                                <td><a href="./process_order/cart_update.php?action=remove&id=<?php echo $row['product_ID']; ?>" class="btn btn-primary">X</a></td>
                                            </tr><!-- END TR-->
                                            <?php
                                            $total += $row["product_Price"] * $_SESSION[$_SESSION["account"]][$row['product_ID']]['quantity'];
                                        }
                                        ?>
                                        <tr class="text-center">
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="total">Total:</td>
                                            <td>&nbsp;</td>
                                            <td class="total">$<?php echo $total; ?></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>                                 
                                            <td colspan="2"><a href="./checkout.php" class="btn btn-primary">Check Out</a></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include_once './footer.php';
            ?>
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