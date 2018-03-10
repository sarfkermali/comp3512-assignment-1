<?php
    include("includes/functions.php");
    
    //redirect to error page if "imageid" not in query string
    if(!isset($_GET["imageid"]) || empty($_GET["imageid"]) || !exist("imageid",$_GET["imageid"])){
        header("location: /error.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Image</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once("includes/stylesheets.inc.php") ?>
</head>


<body>
    <!-- Header -->
    <?php include 'includes/header.inc.php'; ?>
    
    <!-- Page Content -->
    <main class="container">
        <div class="row">
            
            <!--Left Navigation-->
            <?php
                include("includes/aside.inc.php");
            ?>
            <!--End of Left Navigation-->
            
            
            <div class="col-md-10">
                <div class="row">
                    <?php singleImageDetails(); ?>
                </div>  <!--end row-->
                
                
                
            
            </div>
        </div>
    </main>
    
    
    
    <!-- Footer -->
    <?php include 'includes/footer.inc.php'; ?>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>


</html>