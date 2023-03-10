<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">UI-MONK</a>

  <!-- Links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item mt-2">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item mt-2">
      <a class="nav-link" href="#">Shop</a>
    </li>
	<li class="nav-item dropdown  mt-2">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Category
      </a>
      <div class="dropdown-menu">

	  <?php
                  
        
                  $sql2 = "SELECT * FROM Category";
                  $result2 = mysqli_query($conn, $sql2);
              
                
                      // output data of each row
                      while($row2 = mysqli_fetch_assoc($result2)) {
              
                          ?> 
						  <a class="dropdown-item" href="index.php?id=<?php echo $row2["cat_id"] ?>"><?php echo  $row2["cat_name"] ?></a>

			
			
                      <?php
                      }
                  
                  ?>
				 


        
      </div>
    </li>

    <li class="nav-item mt-2">
      <a class="nav-link" href="#">My Account</a>
    </li>
    <li class="nav-item mt-2">
      <a class="nav-link" href="#">Contact</a>
    </li>

    <!-- Dropdown -->

    <div class='text-right ml-5'>
    <li class="nav-item dropdown">
      
              <div class="dropdown">
				    <button type="button" class="btn btn-info" data-toggle="dropdown">
					<?php 
					 $cart = $_SESSION['cart'];
					 $count = count($cart);
					?>
				     <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">
					 <?php echo $count?>
					 </span>
				    </button>
				    <div class="dropdown-menu">

					<?php
       $total = 0;
       foreach($cart as $key => $value){
        // echo $key ." : ". $value['quantity'] . "<br>";
        
        $sql = "SELECT * FROM products where product_id = $key";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result)
        ?>
				    	
				    	<div class="row cart-detail">
		    				<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
		    					<img src="admin/<?php echo $row['thumb']?> " >
		    				</div>
		    				<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
		    					<p><a href="single.php?id=<?php echo $row['product_id']?>"><?php echo $row['product_name']?></a></p>
		    					<span class="price text-info"> INR <?php echo $row['price']?>.00</span> 
								<span class="count"> Quantity:<?php echo $value['quantity']?></span>
		    				</div>
				    	</div>

						<?php
						$total = $total +  ($row['price'] * $value['quantity']);
	   }
						?>



						<div class="row total-header-section">
			      			<div class="col-lg-6 col-sm-6 col-6">
			      				<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">
								  <?php echo $count?>
								  </span>
			      			</div>
			      			<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
			      				<p>Total: <span class="text-info">INR <?php echo $total ?>.00</span></p>
			      			</div>
				    	</div>
  
				    	<div class="row">
				    		<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
				    			<button class="btn btn-primary btn-block">Checkout</button>
								<a href='cart.php' class="btn btn-primary btn-block">Cart</a>
				    		</div>
				    	</div>
				    </div>
				</div> 
    </li>
    </div> 
  </ul>
</nav>
