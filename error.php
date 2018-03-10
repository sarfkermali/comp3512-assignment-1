<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Query String Error</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <?php include_once("includes/stylesheets.inc.php") ?>
</head>


<body>
    <!-- Header -->
    <?php include 'includes/header.inc.php'; ?>
    
    <!-- Page Content -->
    <main class="container">
        <div class="jumbotron">
            <h1><i class="em-svg em-hushed"></i>  Ooops!</h1>
            <p></br>Missing or non-integer querystring!</br> What would you like to do?</p>
            <p></br>
                <a class="btn btn-info btn-lg" href="browse-countries.php" role="button">Browse Countries</a>
                <a class="btn btn-info btn-lg" href="browse-images.php" role="button">Browse Images</a>
                <a class="btn btn-info btn-lg" href="browse-users.php" role="button">Browse Users</a>
            </p>
        </div>
    </main>
    
    
    
    <!-- Footer -->
    <?php include 'includes/footer.inc.php'; ?>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>


</html>