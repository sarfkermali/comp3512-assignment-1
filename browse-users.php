<?php
    include("includes/functions.php");
    $pdo = connectDB();
    
    $sql = "SELECT UserID, FirstName, LastName FROM Users ORDER BY LastName";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Browse Users</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once("includes/stylesheets.inc.php") ?>  
</head>


<body>
    <!-- Header -->
    <?php include 'includes/header.inc.php'; ?>
    
    <!-- Page Content -->
    <main class="container">
        <div class='panel panel-info'>
            <div class='panel-heading'>Users</div>
            <div class='panel-body'>
                <div class="row">
                    <?php while($row = $stmt->fetch()){?>
                    <div class="col-md-3">
                        <a href='single-user.php?userid=<?php echo($row["UserID"])?>'>
                            <?php echo($row["FirstName"]." ".$row["LastName"]); ?>
                        </a>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </main>
    
    
    
    <!-- Footer -->
    <?php include 'includes/footer.inc.php'; ?>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>


</html>