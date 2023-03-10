 
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">UI-MONK</a>

  <!-- Links -->
  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Categories
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="categories.php">view Categories </a>
          <a class="dropdown-item" href="addCategory.php">Add Categories</a> 
        </div>
      </li>


      <li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Products
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="products.php">view Products </a>
          <a class="dropdown-item" href="addProducts.php">Add Products</a> 
        </div>
      </li>

      <li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Orders
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="orders.php">view Orders </a>
          <a class="dropdown-item" href="addOrder.php">Add Orders</a> 
        </div>
      </li>

      
      <li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            My Account
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="editProfile.php">Edit Profile </a>
          <a class="dropdown-item" href="logout.php">Logout</a> 
        </div>
      </li>

  <li class="nav-item mt-2">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>  

      
      

    <!-- Dropdown -->

    <div class='text-right ml-5'>
    <li class="nav-item dropdown">
      
              <div class="dropdown">
				    <button type="button" class="btn btn-info" data-toggle="dropdown">
				     <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">3</span>
				    </button>
				    <div class="dropdown-menu">
				    	<div class="row total-header-section">
			      			<div class="col-lg-6 col-sm-6 col-6">
			      				<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">3</span>
			      			</div>
			      			<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
			      				<p>Total: <span class="text-info">$2,978.24</span></p>
			      			</div>
				    	</div>
				    	<div class="row cart-detail">
		    				<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
		    					<img src="images/1.jpeg">
		    				</div>
		    				<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
		    					<p>Sony DSC-RX100M..</p>
		    					<span class="price text-info"> $250.22</span> <span class="count"> Quantity:01</span>
		    				</div>
				    	</div>
				    	<div class="row cart-detail">
		    				<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                            <img src="images/2.jpeg">
		    				</div>
		    				<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
		    					<p>Vivo DSC-RX100M..</p>
		    					<span class="price text-info"> $500.40</span> <span class="count"> Quantity:01</span>
		    				</div>
				    	</div>
				    	<div class="row cart-detail">
		    				<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                            <img src="images/3.jpeg">
		    				</div>
		    				<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
		    					<p>Lenovo DSC-RX100M..</p>
		    					<span class="price text-info"> $445.78</span> <span class="count"> Quantity:01</span>
		    				</div>
				    	</div>
				    	<div class="row">
				    		<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
				    			<button class="btn btn-primary btn-block">Checkout</button>
				    		</div>
				    	</div>
				    </div>
				</div> 
    </li>
    </div> 
  </ul>
</nav>
