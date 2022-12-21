<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">Vegefoods</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="product.php" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="<?php
                    if (isset($_SESSION["account"])) {
                        echo 'feedback.php';
                    } else {
                        echo 'login.php';
                    }
                    ?>" class="nav-link">Feedback</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="<?php
                    if (isset($_SESSION["account"])) {
                        echo 'cart.php';
                    } else {
                        echo 'login.php';
                    }
                    ?>" class="nav-link"><span class="icon-shopping_cart"><?php
                            if (isset($_SESSION["account"])) {
                                if (isset($_SESSION["quantity"])) {
                                    //echo '<sup class="badge badge-pill badge-danger">' . $_SESSION["quantity"] . '</sup>';
                                } else {
                                    //echo '<sup class="badge badge-pill badge-danger"></sup>';
                                }
                            } else {
                                //echo '<sup class="badge badge-pill badge-danger"></sup>';
                            }
                            ?></a></li>
            </ul>
        </div>
        <?php
        if (isset($_SESSION["account"])) {
            echo '<a href="./account.php"><span>' . $_SESSION["account"] . '</span></a>';
            $_SESSION["acount"] = null;
        } else {
            echo '<a href="login.php"><span class="icon-account_box"></span></a>';
        }
        ?>
    </div>
</nav>

