<?php
require_once './process/connectdb.php';
require_once './process_order/order_data.php';
$order = new order("", "", "", "", "", "", "", "", "");
$result = $order->showAllOrder($conn);
?>

<br>
<table  class="table table-hover">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Address</th>
            <th>Total</th>
            <th>Fee</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>        
            <tr>
                <td><?php echo $row["order_ID"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phone"]; ?></td>
                <td><?php echo $row["order_Date"]; ?></td>
                <td><?php echo $row["address"]; ?></td>
                <td>$<?php echo $row["total"]; ?></td>
                <td>$<?php echo $row["fee"]; ?></td>
                <td><a href="?id=<?php echo $row["order_ID"]; ?>" class="btn btn-primary">Order Details</a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>