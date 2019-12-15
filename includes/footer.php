<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">
               
               <h4>Pages</h4>
                
                <ul>
                    <li><a href="cart.php">Shopping Cart</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="customer/my_account.php">My Account</a></li>
                </ul>
                
                <hr>
                
                <h4>User Section</h4>
                
                <ul>
                           
                           <?php 
                           
                           if(!isset($_SESSION['customer_email'])){
                               
                               echo"<a href='checkout.php'>Login</a>";
                               
                           }else{
                               
                              echo"<a href='customer/my_account.php?my_orders'>My Account</a>"; 
                               
                           }
                           
                           ?>
                    
                    <li><a href="customer_register.php">Register</a></li>
                </ul>
                
                <hr class="hidden-md hidden-lg hidden-sm">
                
            </div>
            
            <div class="com-sm-6 col-md-3">
                
                <h4>Top Products Categories</h4>
                
                <ul>
                
                    <?php 
                    
                        $get_p_cats = "select * from product_categories";
                    
                        $run_p_cats = mysqli_query($con,$get_p_cats);
                    
                        while($row_p_cats=mysqli_fetch_array($run_p_cats)){
                            
                            $p_cat_id = $row_p_cats['p_cat_id'];
                            
                            $p_cat_title = $row_p_cats['p_cat_title'];
                            
                            echo "
                            
                                <li>
                                
                                    <a href='shop.php?p_cat=$p_cat_id'>
                                    
                                        $p_cat_title
                                    
                                    </a>
                                
                                </li>
                            
                            ";
                            
                        }
                    
                    ?>
                
                </ul>
                
                <hr class="hidden-md hidden-lg">
                
            </div>
            
            <div class="col-sm-6 col-md-3">
                
                <h4>Find Us</h4>
                
                <p>
                    
                    <strong>LNU inc.</strong>
                    <br/>Lviv
                    <br/>Ukraine
                    <br/>0818-0683-3157
                    <br/>andrusoleg123@gmail.com
                    
                </p>
                
                <a href="contact.php">Check Our Contact Page</a>
                
                <hr class="hidden-md hidden-lg">
                
            </div>
            
            <div class="col-sm-6 col-md-3">
                
                <h4>Keep In Touch</h4>
                
                <p class="social">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-google-plus"></a>
                    <a href="#" class="fa fa-envelope"></a>
                </p>
            
        <div id="map-container-section" class="z-depth-1-half map-container-section mb-4">
          <iframe src="https://maps.google.com/maps?q=%D0%B2%D0%B8%D0%BD%D0%BD%D0%B8%D0%BA%D0%B8%2C%20%D0%B2%D1%83%D0%BB.%20%D0%86%D0%92%D0%90%D0%9D%D0%90%20%D1%84%D0%A0%D0%90%D0%9D%D0%9A%D0%90%2069&t=&z=13&ie=UTF8&iwloc=&output=embed"frameborder="0"
          style="border:0" allowfullscreen></iframe>
        </div>    
            </div>
            
        </div>
    </div>
</div>


<div id="copyright">
    <div class="container">
        <div class="col-md-6">
            
            <p class="pull-left">&copy; 2019 Horondi Ecommerce Website All Rights Reserve</p>
            
        </div>
        <div class="col-md-6">
            
            <p class="pull-right">Theme by: <a href="#">Oleh Andrus</a></p>
            
        </div>
    </div>
</div>