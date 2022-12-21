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
                    <a class="nav-link" href="./process_customer/customer_logout.php">Log Out</a>
                </li>
            </ul>
        </div>
        <?php
        require_once './process/connectdb.php';
        require_once './process_product/product_data.php';
        $product = new Product("", "", "", "", "", "", "", "");
        $result = $product->ShowAllProduct($conn);
        while ($row = $result->fetch_assoc()) {
            if (isset($_GET["id"]) && $row["product_ID"] == $_GET["id"]) {
                ?>
                <div class="container">
                    <div class="media-body">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['productURL']) . '"  width="300px">'; ?>
                        <form method="POST" action="./process_product/product_update.php">
                            <table border="0" class="table">
                                <tbody>
                                    <tr>
                                        <td>Product ID: </td>
                                        <td><input type="text" class="form-control" id="product_ID" name="product_ID" value="<?php echo $row["product_ID"]; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Product Name: </td>
                                        <td><input type="text" class="form-control" id="product_Name" name="product_Name" value="<?php echo $row["product_Name"]; ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>Category: </td>
                                        <td><select  class="form-control" id="category_ID" name="category_ID"required>
                                                <?php
                                                $cate = $product->ShowAllCategory($conn);
                                                while ($option = $cate->fetch_assoc()) {
                                                    echo '<option value="' . $option["category_ID"] . '">' . $option["category_ID"] . ' - ' . $option["category_Name"] . '</option>';
                                                }
                                                ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>Quantity: </td>
                                        <td><input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $row["product_Quantity"]; ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>Unit: </td>
                                        <td><input type="text" class="form-control" id="product_unit" name="product_Unit" value="<?php echo $row["product_Unit"]; ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>Price: </td>
                                        <td><input type="number" class="form-control" id="product_Price" name="product_Price" value="<?php echo $row["product_Price"]; ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" ><button type="submit" class="btn btn-primary">Update </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
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