<?php
require_once './process/connectdb.php';
require_once './process_product/product_data.php';
if (isset($_GET["action"]) && $_GET["action"] == "add") {
    $id = intval($_GET["id"]);
    if (isset($_SESSION[$_SESSION["account"]][$id])) {
        $_SESSION[$_SESSION["account"]][$id]['quantity']++;
    } else {
        $stmt = $conn->prepare("select product_ID,product_Price  from product where product_ID= ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if (isset($result['product_ID']) && $result['product_ID']) {
            $_SESSION[$_SESSION["account"]][$result['product_ID']] = array("quantity" => 1, "price" => $result['product_Price']);
        } else {
            $message = "This product id is invalid!";
        }
    }
    $_GET["id"] = "all";
    header("location:http://localhost:1000/PhpAssignment/product.php");
}
?>
<?php
$product = new Product("", "", "", "", "", "", "", "");
$result = $product->ShowAllProduct($conn);
if (isset($_GET["id"]) && $_GET["id"] != "all") {
    while ($row = $result->fetch_assoc()) {
        if ($row["category_ID"] == $_GET["id"]) {
            ?> 
            <div class="col-md-6 col-lg-3 ftco-animate" id="<?php echo $row["category_ID"]; ?>">
                <div class="product" style="text-align: center;height: 350px">
                    <a href="<?php
                    if (isset($_SESSION["account"])) {
                        echo '?action=add&id=' . $row["product_ID"];
                    } else {
                        echo './login.php';
                    }
                    ?>" class="img-prod"> <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['productURL']) . '"  width="200px">'; ?>
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="<?php
                            if (isset($_SESSION["account"])) {
                                echo '?action=add&id=' . $row["product_ID"];
                            } else {
                                echo './login.php';
                            }
                            ?>"><?php echo $row["product_Name"]; ?></a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span>$<?php echo $row["product_Price"]; ?></span></p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="caption"><span><?php echo $row["product_Description"]; ?></span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="<?php
                                if (isset($_SESSION["account"])) {
                                    echo '?action=add&id=' . $row["product_ID"];
                                } else {
                                    echo './login.php';
                                }
                                ?>" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
$count = 0;
while ($row = $result->fetch_assoc()) {
    $count++;
    ?> 
    <div class="col-md-6 col-lg-3 ftco-animate" id="<?php echo $row["category_ID"]; ?>">
        <div class="product"style="text-align: center;height: 350px">
            <a href="#<?php echo $count; ?>"  class="img-prod"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['productURL']) . '" width="200px"/>'; ?>
                <div class="overlay"></div>
            </a>
            <div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="#<?php echo $count; ?>"><?php echo $row["product_Name"]; ?></a></h3>
                <div class="d-flex">
                    <div class="pricing">
                        <p class="price"><span>$<?php echo $row["product_Price"]; ?></span></p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="pricing">
                        <p class="caption"><span><?php echo $row["product_Description"]; ?></span></p>
                    </div>
                </div>
                <div class="bottom-area d-flex px-3">
                    <div class="m-auto d-flex">
                        <a href="<?php
                        if (isset($_SESSION["account"])) {
                            echo '?action=add&id=' . $row["product_ID"];
                        } else {
                            echo './login.php';
                        }
                        ?>" class="buy-now d-flex justify-content-center align-items-center mx-1">
                            <span><i class="ion-ios-cart"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>