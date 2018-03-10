<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Home</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once("includes/stylesheets.inc.php") ?>  
</head>


<body>
    <!-- Header -->
    <?php include 'includes/header.inc.php'; ?>
    
    <!-- Page Content -->
    <main class="container">
        <div class="row">

            <div class="col-sm-6 col-md-4">
                <div class="custCard">
                    <img src="images/misc/home_countries.jpg" alt="See all countries for which we have images.">
                    <div class="caption">
                        <h3 class="captionTxt">Countries</h3>
                        <p class="captionTxt">See all countries for which we have images.</p>
                        <hr>
                        <p class="captionTxt"><a href="browse-countries.php">View Countries</a></p>
                    </div> <!--end caption-->
                </div><!--end thumbnail-->
            </div><!--end Countries card-->
            
            <div class="col-sm-6 col-md-4">
                <div class="custCard">
                    <img src="images/misc/home_images.jpg" alt="See all of our travel images.">
                    <div class="caption">
                        <h3 class="captionTxt">Images</h3>
                        <p class="captionTxt">See all of our travel images.</p>
                        <hr>
                        <p class="captionTxt"><a href="browse-images.php">View Images</a></p>
                    </div> <!--end caption-->
                </div><!--end thumbnail-->
            </div><!--end Images card-->
            
            <div class="col-sm-6 col-md-4">
                <div class="custCard">
                    <img src="images/misc/home_users.jpg" alt="See images about our contributing users.">
                    <div class="caption">
                        <h3 class="captionTxt">Users</h3>
                        <p class="captionTxt">See images about our contributing users.</p>
                        <hr>
                        <p class="captionTxt"><a href="browse-users.php">view Users</a></p>
                    </div> <!--end caption-->
                </div><!--end thumbnail-->
            </div><!--end Users card-->
            
        </div>
        <!--end of row-->
    </main>
    
    
    
    <!-- Footer -->
    <?php include 'includes/footer.inc.php'; ?>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>


</html>