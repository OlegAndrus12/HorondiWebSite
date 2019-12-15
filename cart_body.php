<?php 

session_start();

$active='Cart';

include("includes/db.php");
include("functions/functions.php");

?>

<body>
   
   <div id="top">
       
       <div class="container">
           
           <div class="col-md-6 offer">
               
               <a href="#" class="btn btn-success btn-sm">
                   
                   <?php 
                   
                   if(!isset($_SESSION['customer_email'])){
                       
                       echo "Welcome: Guest";
                       
                   }else{
                       
                       echo "Welcome: " . $_SESSION['customer_email'] . "";
                       
                   }
                   
                   ?>
                   
               </a>
               <a href="checkout.php"><?php items(); ?> Items In Your Cart | Total Price: <?php total_price(); ?> </a>
               
           </div>
           
           <div class="col-md-6">
               
               <ul class="menu">
                   
                   <li>
                       <a href="customer_register.php">Register</a>
                   </li>
                   <li>
                       <a href="checkout.php">My Account</a>
                   </li>
                   <li>
                       <a href="cart.php">Go To Cart</a>
                   </li>
                   <li>
                       <a href="checkout.php">
                           
                           <?pp 
                           
                           if(!isset($_SESSION['customer_email'])){
                       
                                echo "<a href='checkout.php'> Login </a>";

                               }else{

                                echo " <a href='logout.php'> Log Out </a> ";

                               }
                           
                           ?>
                           
                       </a>
                   </li>
                   
               </ul>
               
           </div>
           
       </div>
       
   </div>
   
   <div id="navbar" class="navbar navbar-default">
       
       <div class="container">
           
           <div class="navbar-header">
               
               <a href="index.php" class="navbar-brand home">
                   
                   <img src="images/logo.png" alt="Horondi Logo" class="hidden-xs">
                   <img src="images/logo-mobile.png" alt="Horondi Logo Mobile" class="visible-xs">
                   
               </a>
               
               <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                   
                   <span class="sr-only">Toggle Navigation</span>
                   
                   <i class="fa fa-align-justify"></i>
                   
               </button>
               
               <button class="navbar-toggle" data-toggle="collapse" data-target="#search">
                   
                   <span class="sr-only">Toggle Search</span>
                   
                   <i class="fa fa-search"></i>
                   
               </button>
               
           </div>
           
           <div class="navbar-collapse collapse" id="navigation">
               
               <div class="padding-nav">
                   
                   <ul class="nav navbar-nav left">
                       
                       <li class="<?php if($active=='Home') echo"active"; ?>">
                           <a href="index.php">Home</a>
                       </li>
                       <li class="<?php if($active=='Shop') echo"active"; ?>">
                           <a href="shop.php">Shop</a>
                       </li>
                       <li class="<?php if($active=='Account') echo"active"; ?>">
                           
                           <?php 
                           
                           if(!isset($_SESSION['customer_email'])){
                               
                               echo"<a href='checkout.php'>My Account</a>";
                               
                           }else{
                               
                              echo"<a href='customer/my_account.php?my_orders'>My Account</a>"; 
                               
                           }
                           
                           ?>
                           
                       </li>
                       <li class="<?php if($active=='Cart') echo"active"; ?>">
                           <a href="cart.php">Shopping Cart</a>
                       </li>
                       <li class="<?php if($active=='Contact') echo"active"; ?>">
                           <a href="contact.php">Contact Us</a>
                       </li>
                       
                   </ul>
                   
               </div>
               
               <a href="cart.php" class="btn navbar-btn btn-primary right">
                   
                   <i class="fa fa-shopping-cart"></i>
                   
                   <span><?php items(); ?> Items In Your Cart</span>
                   
               </a>
               
               <div class="navbar-collapse collapse right">
                   
                   <button class="btn btn-primary navbar-btn" type="button" data-toggle="collapse" data-target="#search">
                       
                       <span class="sr-only">Toggle Search</span>
                       
                       <i class="fa fa-search"></i>
                       
                   </button>
                   
               </div>
               
               <div class="collapse clearfix" id="search">
                   
                   <form method="get" action="results.php" class="navbar-form">
                       
                       <div class="input-group">
                           
                           <input type="text" class="form-control" placeholder="Search" name="user_query" required>
                           
                           <span class="input-group-btn">
                           
                           <button type="submit" name="search" value="Search" class="btn btn-primary">
                               
                               <i class="fa fa-search"></i>
                               
                           </button>
                           
                           </span>
                           
                       </div>
                       
                   </form>
                   
               </div>
               
           </div>
           
       </div>
       
   </div>
   
   <div id="content">
       <div class="container">
           <div class="col-md-12">
               
               <ul class="breadcrumb">
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Cart
                   </li>
               </ul>
               
           </div>
           
           <div id="cart" class="col-md-9">
               
               <div class="box">
                   
                   <form action="cart.php" method="post" enctype="multipart/form-data">
                       
                       <h1>Shopping Cart</h1>
                       
                       <?php 
                       
                       $ip_add = getRealIpUser();
                       
                       $select_cart = "select * from cart where ip_add='$ip_add'";
                       
                       $run_cart = mysqli_query($con,$select_cart);
                       
                       $count = mysqli_num_rows($run_cart);
                       
                       ?>
                       
                       <p class="text-muted">You currently have <?php echo $count; ?> item(s) in your cart</p>
                       
                       <div class="table-responsive">
                           
                           <table class="table">
                               
                               <thead>
                                   
                                   <tr>
                                       
                                       <th colspan="2">Product</th>
                                       <th>Quantity</th>
                                       <th>Unit Price</th>
                                       <th>Size</th>
                                       <th colspan="1">Delete</th>
                                       <th colspan="2">Sub-Total</th>
                                       
                                   </tr>
                                   
                               </thead>
                               
                               <tbody>
                                  
                                  <?php 
                                   
                                   $total = 0;
                                   
                                   while($row_cart = mysqli_fetch_array($run_cart)){
                                       
                                     $pro_id = $row_cart['p_id'];
                                       
                                     $pro_size = $row_cart['size'];
                                       
                                     $pro_qty = $row_cart['qty'];

                                     $pro_sale = $row_cart['p_price'];
                                       
                                       $get_products = "select * from products where product_id='$pro_id'";
                                       
                                       $run_products = mysqli_query($con,$get_products);
                                       
                                       while($row_products = mysqli_fetch_array($run_products)){
                                           
                                           $product_title = $row_products['product_title'];
                                           
                                           $product_img1 = $row_products['product_img1'];
                                           
                                           $only_price = $row_products['product_price'];
                                           
                                           $sub_total = $pro_sale*$pro_qty;

                                           $_SESSION['pro_qty'] = $pro_qty;
                                           
                                           $total += $sub_total;
                                           
                                   ?>
                                   
                                   <tr>
                                       
                                       <td>
                                           
                                           <img class="img-responsive" src="admin_area/product_images/<?php echo $product_img1; ?>" alt="Product 3a">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <a href="details.php?pro_id=<?php echo $pro_id; ?>"> <?php echo $product_title; ?> </a>
                                           
                                       </td>
                                       
                                       <td>
                                          
                                           <input type="text" name="quantity" data-product_id="<?php echo $pro_id; ?>" value="<?php echo $_SESSION['pro_qty']; ?>" class="quantity form-control">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <?php echo $pro_sale; ?>
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <?php echo $pro_size; ?>
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           $<?php echo $sub_total; ?>
                                           
                                       </td>
                                       
                                   </tr>
                                   
                                   <?php } } ?>
                                   
                               </tbody>
                               
                               <tfoot>
                                   
                                   <tr>
                                       
                                       <th colspan="5">Total</th>
                                       <th colspan="2">$<?php echo $total; ?></th>
                                       
                                   </tr>
                                   
                               </tfoot>
                               
                           </table>
                           
                       </div>
                       
                       <div class="box-footer">
                           
                           <div class="pull-left">
                               
                               <a href="index.php" class="btn btn-default">
                                   
                                   <i class="fa fa-chevron-left"></i> Continue Shopping
                                   
                               </a>
                               
                           </div>
                           
                           <div class="pull-right">
                               
                               <button type="submit" name="update" value="Update Cart" class="btn btn-default">
                                   
                                   <i class="fa fa-refresh"></i> Update Cart
                                   
                               </button>
                               
                               <a href="checkout.php" class="btn btn-primary">
                                   
                                   Proceed Checkout <i class="fa fa-chevron-right"></i>
                                   
                               </a>
                               
                           </div>
                           
                       </div>
                       
                   </form>
                   
               </div>
               
               <?php 
               
                function update_cart(){
                    
                    global $con;
                    
                    if(isset($_POST['update'])){
                        
                        foreach($_POST['remove'] as $remove_id){
                            
                            $delete_product = "delete from cart where p_id='$remove_id'";
                            
                            $run_delete = mysqli_query($con,$delete_product);
                            
                            if($run_delete){
                                
                                echo "<script>window.open('cart.php','_self')</script>";
                                
                            }
                            
                        }
                        
                    }
                    
                }
               
               echo @$up_cart = update_cart();
               
               ?>
               
               <div id="row same-heigh-row">
                   <div class="col-md-3 col-sm-6">
                       <div class="box same-height headline">
                           <h3 class="text-center">Products You Maybe Like</h3>
                       </div>
                   </div>
                   
                   <?php 
                   
                   $get_products = "select * from products order by rand() LIMIT 0,3";
                   
                   $run_products = mysqli_query($con,$get_products);
                   
                   while($row_products=mysqli_fetch_array($run_products)){
                       
                    $pro_id = $row_products['product_id'];
        
                    $pro_title = $row_products['product_title'];
                    
                    $pro_price = $row_products['product_price'];
            
                    $pro_sale_price = $row_products['product_sale'];
                    
                    $pro_img1 = $row_products['product_img1'];
                    
                    $pro_label = $row_products['product_label'];
                    
                    $manufacturer_id = $row_products['manufacturer_id'];
            
                    $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";
            
                    $run_manufacturer = mysqli_query($db,$get_manufacturer);
            
                    $row_manufacturer = mysqli_fetch_array($run_manufacturer);
            
                    $manufacturer_title = $row_manufacturer['manufacturer_title'];
            
                    if($pro_label == "sale"){
            
                        $product_price = " <del> $ $pro_price </del> ";
            
                        $product_sale_price = "/ $ $pro_sale_price ";
            
                    }else{
            
                        $product_price = "  $ $pro_price  ";
            
                        $product_sale_price = "";
            
                    }
            
                    if($pro_label == ""){
            
                    }else{
            
                        $product_label = "
                        
                            <a href='#' class='label $pro_label'>
                            
                                <div class='theLabel'> $pro_label </div>
                                <div class='labelBackground'>  </div>
                            
                            </a>
                        
                        ";
            
                    }
                    
                    echo "
                    
                    <div class='col-md-3 col-sm-6 center-responsive'>
                    
                        <div class='product'>
                        
                            <a href='details.php?pro_id=$pro_id'>
                            
                                <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                            
                            </a>
                            
                            <div class='text'>
            
                            <center>
                            
                                <p class='btn btn-primary'> $manufacturer_title </p>
                            
                            </center>
                            
                                <h3>
                        
                                    <a href='details.php?pro_id=$pro_id'>
            
                                        $pro_title
            
                                    </a>
                                
                                </h3>
                                
                                <p class='price'>
                                
                                $product_price &nbsp;$product_sale_price
                                
                                </p>
                                
                                <p class='button'>
                                
                                    <a class='btn btn-default' href='details.php?pro_id=$pro_id'>
            
                                        View Details
            
                                    </a>
                                
                                    <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>
            
                                        <i class='fa fa-shopping-cart'></i> Add to Cart
            
                                    </a>
                                
                                </p>
                            
                            </div>
            
                            $product_label
                        
                        </div>
                    
                    </div>
                    
                    ";
                       
                   }
                   
                   ?>
                   
               </div>
               
           </div>
           
           <div class="col-md-3">
               
               <div id="order-summary" class="box">
                   
                   <div class="box-header">
                       
                       <h3>Order Summary</h3>
                       
                   </div>
                   
                   <p class="text-muted">
                       
                       Shipping and additional costs are calculated based on value you have entered
                       
                   </p>
                   
                   <div class="table-responsive">
                       
                       <table class="table">
                           
                           <tbody>
                               
                               <tr>
                                   
                                   <td> Order All Sub-Total </td>
                                   <th> $<?php echo $total; ?> </th>
                                   
                               </tr>
                               
                               <tr>
                                   
                                   <td> Shipping and Handling </td>
                                   <td> $0 </td>
                                   
                               </tr>
                               
                               <tr>
                                   
                                   <td> Tax </td>
                                   <th> $0 </th>
                                   
                               </tr>
                               
                               <tr class="total">
                                   
                                   <td> Total </td>
                                   <th> $<?php echo $total; ?> </th>
                                   
                               </tr>
                               
                           </tbody>
                           
                       </table>
                       
                   </div>
                   
               </div>
               
           </div>
           
       </div>
   </div>
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>

    <script>
    
       $(document).ready(function(data){

           $(document).on('keyup','.quantity',function(){

                var id = $ (this).data("product_id");
                var quantity = $(this).val();

                if(quantity !=''){

                    $.ajax({

                        url: "change.php",
                        method: "POST",
                        data:{id:id, quantity:quantity},

                        success:function(){
                            $("body").load("cart_body.php");
                        }

                    });

                }

           });

       });
    
    </script>
    
    
</body>