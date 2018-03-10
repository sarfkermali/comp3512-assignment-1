<?php
  
    include("includes/functions.php");
    $pdo = connectDB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Browse Images</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once("includes/stylesheets.inc.php") ?> 

</head>

<body>
    <!--Page Header-->
    <?php include 'includes/header.inc.php'; ?>
    
    <!-- Page Content -->
    <main class="container">
      
        <!--Filter Panel-->
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            
            <!--Form-->
            <form action="browse-images.php" method="get" class="form-horizontal">
              <div class="form-inline">
                
              <!--Continent Selection-->
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php /* display list of continents */ 
                    
                    $sql ="SELECT ContinentName, ContinentCode FROM Continents ORDER BY ContinentName;";
                    $stmt = $pdo->query($sql);//get address
    
                    while($row = $stmt->fetch()){//parse data by row
                        echo '<option value="'.$row["ContinentCode"].'">'.$row["ContinentName"].'</option>';
                    }
                    
                ?>
              </select>
              
              <!--Countries Selection-->
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php /* display list of countries */
                    
                    $sql ="SELECT Countries.ISO, Countries.CountryName FROM Countries INNER JOIN ImageDetails ON Countries.ISO = ImageDetails.CountryCodeISO GROUP BY CountryName;";
                    $result = $pdo->query($sql);//get address
    
                    while($row = $result->fetch()){//parse data by row
                        echo '<option value="'.$row["ISO"].'">'.$row["CountryName"].'</option>';
                    }
                    
                ?>
                
              </select>    
              
              <!--City Selection-->
              <select name="city" class="form-control">
                <option value="0">Select City</option>
                <?php /* display list of cities */
                    $sql ="SELECT Cities.CityCode, Cities.AsciiName FROM Cities INNER JOIN ImageDetails ON Cities.CityCode = ImageDetails.CityCode GROUP BY AsciiName;";
                    $result = $pdo->query($sql);//get address

                    while($row = $result->fetch()){
                        echo '<option value="'.$row["CityCode"].'">'.$row["AsciiName"].'</option>';
                    }
                    
                ?>
                
              </select>
              
              <!--Title Search-->
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              
              <!--Filter and Clear Button-->
              <button type="submit" class="btn btn-primary">Filter</button>
              <?php
                if($_GET["continent"] || $_GET["country"] || $_GET["city"] || $_GET["title"])
                  echo '<button type="submit" class="btn btn-success">Clear</button>';
              ?>
              </div>
            </form>

          </div>
        </div>     
        
        <!--Images Panel-->
        <div class="panel panel-default">
        <div class="panel-heading">Images 
          <?php
              if( isset($_GET["continent"]) && $_GET["continent"] != "0" ){
                echo '[Continent='.$_GET["continent"].']'; //if continent is set
              }
              elseif(isset($_GET["country"]) && $_GET["country"] != "0" ){
                echo '[Country='.$_GET["country"].']'; //if country is set
              }
              elseif(isset($_GET["city"]) && $_GET["city"] != "0" ){
                getCityName($_GET["city"]); //if city is set
              }
              elseif( isset($_GET["title"]) && !empty($_GET["title"]) ){
                echo '[Title='.$_GET["title"].']'; //if title is set
              }
              else{
                echo '[All]';; //show all
              }
          ?>
        </div><!--End Panel Heading-->
        
        <div class="panel-body">
        <!--Image list-->
		    <ul class="caption-style-2">
            <?php
              if( isset($_GET["continent"]) && $_GET["continent"] != "0" ){
                DisplayImageList( filterby("continent",$_GET["continent"]) ); //if continent is set
              }
              elseif(isset($_GET["country"]) && $_GET["country"] != "0" ){
                DisplayImageList( filterby("country",$_GET["country"]) ); //if country is set
              }
              elseif(isset($_GET["city"]) && $_GET["city"] != "0" ){
                DisplayImageList( filterby("city",$_GET["city"]) ); //if city is set
              }
              elseif(isset($_GET["title"]) && !empty($_GET["title"]) ){
                DisplayImageList( filterby("title",$_GET["title"]) ); //if title is set
              }
              else{
                DisplayImageList( filterby("none",null) ); //show all
              }
           ?>
       </ul>
       </div><!--end panel body-->
       </div><!--end panel-->

    </main>
    
    <!--footer-->
    <?php include 'includes/footer.inc.php'; ?>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>