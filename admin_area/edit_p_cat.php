<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['edit_p_cat'])){
        
        $edit_p_cat_id = $_GET['edit_p_cat'];
        
        $edit_p_cat_query = "select * from product_categories where p_cat_id='$edit_p_cat_id'";
        
        $run_edit = mysqli_query($con,$edit_p_cat_query);
        
        $row_edit = mysqli_fetch_array($run_edit);
        
        $p_cat_id = $row_edit['p_cat_id'];
        
        $p_cat_title = $row_edit['p_cat_title'];
        
        $p_cat_image = $row_edit['p_cat_image'];
        
    }

?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                
                <i class="fa fa-dashboard"></i> Dashboard / Edit Product Category
                
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                
                    <i class="fa fa-pencil fa-fw"></i> Edit Product Category
                
                </h3>
            </div>
            
            <div class="panel-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                    
                        <label for="" class="control-label col-md-3"> 
                        
                            Product Category Title 
                        
                        </label> 
                        
                        <div class="col-md-6">
                        
                            <input value=" <?php echo $p_cat_title; ?> " name="p_cat_title" type="text" class="form-control">
                        
                        </div>
                    
                    </div>
                    
                    <div class="form-group">
                    
                        <label for="" class="control-label col-md-3"> 
                        
                        Category Image
                        
                        </label> 
                        
                        <div class="col-md-6">
                        
                            <input type="file" name="p_cat_image" class="form-control">
                          
                          <br>
                          
                          <img width="70" height="70" src="other_images/<?php echo $p_cat_image; ?>" alt="<?php echo $p_cat_image; ?>">
                        
                        </div>
                    
                    </div>
                    
                    <div class="form-group">
                    
                        <label for="" class="control-label col-md-3"> 
                        
                        </label> 
                        
                        <div class="col-md-6">
                        
                            <input value="Update Product Category" name="update" type="submit" class="form-control btn btn-primary">
                        
                        </div>
                    
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<?php  

          if(isset($_POST['update'])){
              
              $p_cat_title = $_POST['p_cat_title'];

              if(is_uploaded_file($_FILES['p_cat_image']['tmp_name'])){
              
                $p_cat_image = $_FILES['p_cat_image']['name'];
                
                $temp_name = $_FILES['p_cat_image']['tmp_name'];
                
                $update_p_cat = "update product_categories set p_cat_title='$p_cat_title',p_cat_image='$p_cat_image' where p_cat_id='$p_cat_id'";
                
                $run_p_cat = mysqli_query($con,$update_p_cat);
                
                if($run_p_cat){
                    
                    echo "<script>alert('Your Product Category Has Been Updated')</script>";
                    
                    echo "<script>window.open('index.php?view_p_cats','_self')</script>";
                   
                }

              }else{
                
                $update_p_cat = "update product_categories set p_cat_title='$p_cat_title', where p_cat_id='$p_cat_id'";
                
                $run_p_cat = mysqli_query($con,$update_p_cat);
                
                if($run_p_cat){
                    
                    echo "<script>alert('Your Product Category Has Been Updated')</script>";
                    
                    echo "<script>window.open('index.php?view_p_cats','_self')</script>";
                    
                }

              }
              
          }

?>

<?php } ?> 