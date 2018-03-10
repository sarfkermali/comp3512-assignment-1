<?php
    include ("includes/functions.php");
    
    //redirect to error page if "ISO" not in query string
    if(!isset($_GET["ISO"]) || empty($_GET["ISO"]) || !exist("iso",$_GET["ISO"])){
        header("location: /error.php");
    }
    

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Country</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once("includes/stylesheets.inc.php") ?>
</head>


<body>
    <!-- Header -->
    <?php include 'includes/header.inc.php';?>
    
    
    <!-- Page Content -->
    <main class="container">
        
        <?php
            printCountryDetails($_GET["ISO"]);
        ?>
        
        <!--Country Images-->
        <div class="panel-body">
        <?php
            printCountryImages($_GET["ISO"]);
        ?>
        </div><!--End Panel Body-->
        </div><!--End Panel-->
        
        
    </main>
    
    
    <!-- Footer -->
    <?php include 'includes/footer.inc.php'; ?>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>


</html>