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
            ?>        
            <tr>
                <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['productURL']) . '"  width="100px">'; ?></td>
                <td><?php echo $row["product_ID"]; ?></td>
                <td><?php echo $row["product_Name"]; ?></td>
                <td><?php
                    $cate = $product->ShowAllCategory($conn);
                    while ($rowcate = $cate->fetch_assoc()) {
                        if ($row["category_ID"] == $rowcate["category_ID"]) {
                            echo $row["category_ID"] . " - " . $rowcate["category_Name"];
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
        ?>
    </tbody>
</table>