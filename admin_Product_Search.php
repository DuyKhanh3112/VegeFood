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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    </head>
    <body class="goto-here">
        <!-- END nav -->

        <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <h1 class="mb-0 bread">ADMIN</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <br>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="admin_Customer.php">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin_Product.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_Order.php">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./process_customer/customer_logout.php">Log Out</a>
                </li>
            </ul>
        </div>
        <h1>Results: </h1>
        <br>

        <?php
        require_once './process/connectdb.php';
        require_once './process_product/product_data.php';
        $product = new Product("", "", "", "", "", "", "", "");
        $result = $product->ShowAllProduct($conn);
        ?>

        <br>
        <table  class="table table-hover">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category ID</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>&nbsp;</th>
                    <th><a href="./inser_product.php" class="btn btn-success">+</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    if ($row["product_ID"]==$_POST["search"]||$row["product_Name"]==$_POST["search"]||$row["category_ID"]==$_POST["search"]||$row["product_Unit"]==$_POST["search"]||$row["product_Price"]==$_POST["search"]) {
                    ?>        
                    <tr>
                        <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['productURL']) . '"  width="100px">'; ?></td>
                        <td><?php echo $row["product_ID"]; ?></td>
                        <td><?php echo $row["product_Name"]; ?></td>
                        <td><?php $cate=$product->ShowAllCategory($conn); 
                    while ($rowcate = $cate->fetch_assoc()) {
                        if ($row["category_ID"]==$rowcate["category_ID"]){
                            echo $row["category_ID"]." - ". $rowcate["category_Name"];
                        }
                    }
                ?></td>
                        <td><?php echo $row["product_Quantity"]; ?></td>
                        <td><?php echo $row["product_Unit"]; ?></td>
                        <td>$<?php echo $row["product_Price"]; ?></td>
                        <td><a class="btn btn-primary"  href="./update_product.php?id=<?php echo $row["product_ID"]; ?>">Update</a></td>
                        <td><a class="btn btn-primary"  href="./process_product/product_delete.php?action=remove&id=<?php echo $row["product_ID"]; ?>">Remove</a></td>
                    </tr>
                    <?php
                }
                }
                ?>
            </tbody>
        </table>
        <!-- loader -->
        <?php include_once './footer.php'; ?>
        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
        <script>
            $(document).ready(function () {
                $(".nav-tabs a").click(function () {
                    $(this).tab('show');
                });
            });
        </script>

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