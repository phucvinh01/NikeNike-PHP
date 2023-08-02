<?php session_start() ;
include_once '../class/Category.php';?>
<?php        
    $errors = "";
    if(isset($_POST['submit'])) {
                $name = $_POST['name'];
                $nameTemp = $name ;
                
                $cate = new Category();
                if(!isset($name)) {
                    $errors = "Field is require";
                }
                else if($cate->checkNameCategory($name)){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                } else {                   
                    $cate->insertOneCategory($name);                  
                    header('location: admin_dashboard.php');                    
                }
            }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'ic/libary.php';?>
    <title>Add - Category</title>
</head>
<body>

<?php include_once 'ic/admin_header.php'  ;?>
<div class="container-fluid"> 
    <div class="row">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <?php include_once 'ic/admin_sidebar.php'  ;?>
        </div>       
        <div class="col-auto col-md-9">
            <div class="container">
                <h3 class="text-dark">Add - Category Form</h3>
                <div class="w-50 m-auto shadow-lg p-3 mb-5 bg-body rounded mt-5">
                    <form  method="POST" action="">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name = "name" require>
                            <p class="text-danger"><?= $errors ?></p>
                            
                        </div>
                        <input type="submit" name ="submit" class="btn btn-primary" value="Insert">
                    </form>
                </div>
                
            </div>
            
        </div>     
    
    </div>
        
    </div>
        

<?php include_once 'ic/admin_footer.php' ;?>