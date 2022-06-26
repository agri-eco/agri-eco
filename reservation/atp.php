
<?php
require_once('config.php');
$con = mysqli_connect("localhost","root","","agri_eco_db");

?>
                        <form action="" method="POST">    
        <?php 
            $i = 1;
            $package_inclusion = $conn->query("SELECT * FROM `package_inclusion` where status = '1' ");
            while($row = $package_inclusion->fetch_assoc()):                            
        ?>
    
    
    <input  type="checkbox" name="item[]" value="<?= $row['item'] ?>" /><small><B>Item:</b><?=  $row['item'] ?> <b>|</b> <?=  $row['item_details'] ?><B> | </b> <?=  $row['cost'] ?>/pax</small><br><br>
    <?php endwhile;$i++; ?>
    
          <div class="form-group ml-4">
              <button name="add" class="btn btn-flat btn-warning">Add to Package</button>
          </div>  
            </form>
<script>
<?php

    extract($_POST);
    $items1 = $_POST['item'];
    $add_ons = implode(",", $items1);
    $query = "UPDATE book_list set description = ( '$add_ons') order by Id DESC limit 1";
    $query_run = mysqli_query($con, $query);
        
    
    if($query_run)
    {
        $_SESSION['status'] = "Inserted Successfully";
        header("Location: atp.php");
    }
    else
    {
        $_SESSION['status'] = "Not Inserted";
        header("Location: index.php");
    }

?>
</script>