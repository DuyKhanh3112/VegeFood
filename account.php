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
                        <h1 class="mb-0 bread">Information Account</h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include './process/connectdb.php';
        include './process_customer/customer_data.php';
        $customer = new customer("", "", "", "", "");
        $result = $customer->showAll($conn);
        while ($row = $result->fetch_assoc()) {
            if ($row["email"] == $_SESSION["account"]) {
                ?>
                <section class="ftco-section contact-section bg-light">
                    <div class="container">
                        <div class="media-body">
                            <form method="POST" action="./process_customer/customer_update.php">
                                <table border="0" class="table">
                                    <tbody>
                                        <tr>
                                            <td>Email: </td>
                                            <td><input type="text" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Name: </td>
                                            <td><input type="text" class="form-control" id="name" name="name" value="<?php echo $row["fullname"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Phone: </td>
                                            <td><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row["phone"]; ?>" </td>
                                        </tr>
                                        <tr>
                                            <td>Address: </td>
                                            <td><input type="text" class="form-control" id="address" name="address" value="<?php echo $row["address"]; ?>" </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" ><button type="submit" class="btn btn-primary">Update </button>
                                                <a href="./process_customer/customer_logout.php" class="btn btn-primary">Logout</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </form>
                        </div>
                    </div>
                </section>
                <?php
            }
        }
        ?>
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
<?php
require './process/connectdb.php';
require './process_customer/customer_data.php';

$customer->set_email($_POST["email"]);
$customer->set_fullname($_POST["name"]);
$customer->set_address($_POST["address"]);
$customer->set_phone($_POST["phone"]);
$customer->updateCustomer($conn);
?>
