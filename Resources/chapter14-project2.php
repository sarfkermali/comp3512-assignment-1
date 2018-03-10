<?php
  
require_once('config.php');

try {
   $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
   die( $e->getMessage() );
}



function filterby($filter, $val){
  
  if($filter=="title"){
    return 'SELECT Path, CountryCodeISO, ImageID, Title FROM ImageDetails WHERE Title LIKE "%'.$val.'%"';
  }
  elseif($filter=="country"){
    return 'SELECT Path, CountryCodeISO, ImageID, Title FROM ImageDetails WHERE CountryCodeISO ="'.$val.'"';
  }
  elseif($filter=="continent"){
    return 'SELECT Path, CountryCodeISO, ImageID, Title FROM ImageDetails WHERE ContinentCode ="'.$val.'"';
  }
  if($filter=="none"){
    return 'SELECT Path, CountryCodeISO, ImageID, Title FROM ImageDetails';
  }
  
}

function imgList($qry, $pdo){
              $sql = $qry;
              $result = $pdo->query($sql);//get address
    
              while($row = $result->fetch()){//parse data by row
                  echo '   
			                  <li>
                                  <a href="detail.php?id='.$row["ImageID"].'" class="img-responsive">
                                          <img src="images/square-medium/'.$row["Path"].'" alt="'.$row["Description"].'">
                                          <div class="caption">
                                              <div class="blur"></div>
                                              <div class="caption-text">
                                                  <p>'.$row["Title"].'</p>
                                              </div>
                                          </div>
                                  </a>
			                  </li> 
			                  ';
              }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chapter 14</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'includes/header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="chapter14-project2.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php /* display list of continents */ 
                    
                    $sql ="select * from Continents order by ContinentName;";
                    $result = $pdo->query($sql);//get address
    
                    while($row = $result->fetch()){//parse data by row
                        echo '<option value="'.$row["ContinentCode"].'">'.$row["ContinentName"].'</option>';
                    }
                    
                ?>
              </select>     
              

              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php /* display list of countries */
                    //////////////// country list dependent on continent
                    
                    $sql ="SELECT * FROM Countries INNER JOIN ImageDetails ON Countries.ISO = ImageDetails.CountryCodeISO GROUP BY CountryName;";
                    $result = $pdo->query($sql);//get address
    
                    while($row = $result->fetch()){//parse data by row
                        echo '<option value="'.$row["ISO"].'">'.$row["CountryName"].'</option>';
                    }
                    
                ?>
                
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    

		<ul class="caption-style-2">
		  
            <?php /* display list of images ... sample below ... replace ???? with field data*/
              
              if( isset($_GET["continent"]) && $_GET["continent"] != "0" ){
                imgList(filterby("continent",$_GET["continent"]), $pdo); //if continent is set
              }
              elseif(isset($_GET["country"]) && $_GET["country"] != "0" ){
                imgList(filterby("country",$_GET["country"]), $pdo); //if country is set
              }
              elseif(isset($_GET["title"]) ){
                imgList(filterby("title",$_GET["title"]), $pdo); //if title is set
              }
              else{
                imgList(filterby("none",null), $pdo); //show all
              }
              
           ?>
           
       </ul>       

      
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>