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
                        <h1 class="mb-0 bread">Feedback</h1>
                    </div>
                </div>
            </div>
        </div>
        <br> 
        <?php
        include './process/connectdb.php';
        include './process_customer/customer_data.php';
        include './process_feedback/feedback_data.php';
        $customer = new customer("","","","","");
        $feedback = new feedback("","","","","");
        $customer->set_email($_SESSION["account"]);
        ?>
        <form method="POST" action="./process_feedback/feedback_insert.php">
            <table class="table">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" class="form-control" id="fullname"name="fullname" value="<?php echo $customer->ShowName($conn); ?>" readonly></td>
                    <td>Date</td>
                    <td><input type="text" class="form-control" id="date" name="date" value="<?php $today = date("d-m-Y, h:i:s", time());
        echo $today; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Content: </td>
                    <td rowspan="2"> <textarea class="form-control" id="content" name="content" required ></textarea></td>
                    <td><input type="submit" class="btn btn-primary" value="Send Feedback"></td>
                </tr> 
                
            </table>
          
        </form>
        <br> 
        <div class="container mt-3">    
            <?php
            $result= $feedback->showAllFeedback($conn);
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="media border p-3">
                    <div class="media-body">
                        <h4><?php echo $row["fullname"]; ?> <small style="color: lightgray"><i> <?php echo $row["feedback_Date"]; ?></i></small></h4>
                        <p><?php echo $row["content"]; ?></p>      
                    </div>
                </div>
                <?php
            }
            ?>
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