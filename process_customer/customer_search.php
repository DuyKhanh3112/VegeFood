<?php
require_once '../process/connectdb.php';
require_once './customer_data.php';

$customer = new customer("", "", "", "", "");
$result =$customer->showAll($conn);
?>
<table class = "table table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>FullName</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>&nbsp;
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            if ($row["fullname"]==$_POST["search"]||$row["email"]==$_POST["search"]||$row["phone"]==$_POST["search"]){
            $count++;
            ?>     
            <tr>      
                <td><?php echo $count; ?></td>
                <td><?php echo $row["fullname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["address"]; ?></td>
                <td><?php echo $row["phone"]; ?></td>
                <td><a class="btn btn-primary" href="?action=remove&id=<?php echo $row["email"]; ?>">Remove</a></td>
            </tr>
            <?php
            }
        }
        ?>
    </tbody>
</table>

