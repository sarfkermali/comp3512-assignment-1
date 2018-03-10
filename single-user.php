<?php
    include("includes/functions.php");
    
    //redirect to error page if "userid" not in query string
    if(!isset($_GET["userid"]) || empty($_GET["userid"]) || !exist("userid",$_GET["userid"]) ){
        header("location: /error.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>User</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once("includes/stylesheets.inc.php") ?>   
</head>


<body>
    <!-- Header -->
    <?php include 'includes/header.inc.php'; ?>
    
    <!-- Page Content -->
    <main class="container">
        <div class="jumbotron">
        <?php
            $name = userDetails($_GET["userid"]);
        ?></div><!--end of jumbotron-->
        
        <div class="panel panel-info">
            <div class="panel-heading">Images by <?php echo $name; ?></div><!--panel heading-->
            <div class="panel-body">
                <!--print images by the user-->
                <?php
                    imagesByUser($_GET["userid"]);
                ?>
            </div><!--end panel body-->
        </div><!--end of panel-->
    </main>
    
    
    
    
    <!-- Footer -->
    <?php include 'includes/footer.inc.php'; ?>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>


</html>