<?php

include('inc/header.php');  
include('config/db.php'); 

 

?>

<?php include('inc/nav.php'); 



?>
 
 


<div class="content mt-5">
            <ul class="rig columns-4">

<?php 


$sql = "SELECT * FROM products";
if(isset($_GET['id'])){
    $catID = $_GET['id'];
    $sql .= " WHERE cat_id = '$catID'";
}


$result = mysqli_query($conn, $sql);
 
  while($row = mysqli_fetch_assoc($result)) {
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";

    ?> 

                <li>
                    <a href="#"><img class="product-image" src="admin/<?php echo  $row["thumb"] ?>"></a>
                    <h4><?php echo  $row["product_name"] ?></h4>

                    <p><?php echo  $row["product_description"] ?></p>
                    <div class="price"> <b>INR <?php echo  $row["price"] ?>.00 </b></div>
                    
                    <hr>
                    <a href='addToCart.php?id=<?php echo  $row["product_id"] ?>'  class="btn btn-default btn-xs pull-right"  >
                        <i class="fa fa-cart-arrow-down"></i> Add To Cart
                    </a>
                    <a   href='single.php?id=<?php echo  $row["product_id"] ?>' class="btn btn-default btn-xs pull-left">
                        <i class="fa fa-eye"></i> Details
                    </a>
                </li>


                <?php
                  }  
                  ?>
               
          
             
            </ul>
        </div>










        <?php include('inc/footer.php');  ?>


