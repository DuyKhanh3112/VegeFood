<?php
require_once './process/connectdb.php';
require_once './process_customer/customer_data.php';
$customer = new customer("", "", "", "", "");
$result = $customer->showAll($conn);
?>

<br> 
<br>
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

<table  class="table table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>FullName</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        while ($row = $result->fetch_assoc()) {
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
        ?>
    </tbody>
</table>
<?php
if (isset($_GET["action"]) && $_GET["action"] == "remove") {
    $customer->set_email($_GET["id"]);
    $customer->deleteCustomer($conn);
    header("location:http://localhost:1000/PhpAssignment/admin_Customer.php");
}
?>


