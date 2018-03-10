<?php

/* Connection to Databse */
    function connectDB(){
        //Get DB connection details
        require_once("includes/config.php");
        
        //Attempt DB Connection
        try{
            $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }
        catch(PDOException $e){
            die("ERROR: Could not connect: " . $e->getMessage());
        }
        return $pdo;
    }



/* Checks to see if ISO Exists (Helps redirection) */    
    function exist($qs, $val){
        if($qs=="iso"){
            //$sql ="SELECT ISO FROM Countries WHERE ISO ='".$val."'";
            $sql ="SELECT ISO FROM Countries WHERE ISO =:val";
        }
        elseif($qs=="userid"){
            //$sql="SELECT UserID FROM Users WHERE UserID ='".$val."'";
            $sql="SELECT UserID FROM Users WHERE UserID =:val";
        }
        elseif($qs=="imageid"){
            //$sql="SELECT ImageID FROM ImageDetails WHERE ImageID ='".$val."'";
            $sql="SELECT ImageID FROM ImageDetails WHERE ImageID =:val";
        }
        else{ return false;}
        $pdo = connectDB();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":val", $val);
        $stmt->execute();
        if ($stmt->rowCount()>0) return true;
        else {return false;}
    }


    
/* Prints Country Details */
    function printCountryDetails($isoCode)
    {
       $pdo = connectDB();
                          
       $sql = 'SELECT CountryName, Capital, Area, Population, CurrencyName, CountryDescription          
       FROM Countries         
       WHERE Countries.ISO = :iso';          
       $stmt = $pdo->prepare($sql);
       $stmt->bindValue(":iso", $isoCode);
       $stmt ->execute();
       $row = $stmt->fetch();
      
        //print jumbotron 
        echo '<div class="jumbotron">';
        echo '<h2>'.$row["CountryName"]."</h2>";
        echo '<p>Captial : <strong>'.$row["Capital"].'</strong><p>';
        echo '<p>Area : <strong>'.number_format($row["Area"]).' </strong> sq km.<p>';
        echo '<p>Population : <strong>'.number_format($row["Population"]).' </strong><p>';
        echo '<p>Currency Name: <strong>'.$row["CurrencyName"].'</strong><p>';
        echo '<p>'.$row["CountryDescription"].'<p>';
        echo '</div>';
        //End Jumbotron
       
        //print panel for images
        echo'
            <div class="panel panel-info">
            <div class="panel-heading">Images from '.$row["CountryName"].'</div>
        ';

        
        $pdo = null;
    }
    
/* Prints Images that are linked to a country */
    function printCountryImages($isoCode){
        $pdo = connectDB();
                          
        $sql = 'SELECT ImageID, Path, Title 
        FROM ImageDetails WHERE ImageDetails.CountryCodeISO = :iso';          
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":iso", $isoCode);
        $stmt->execute();
        
        while($row = $stmt->fetch()){
            echo '<div class="col-md-1">';
            echo '<a href="/single-image.php?imageid='.$row["ImageID"].'"><img src="/images/square-small/'.$row["Path"].'" class="img-responsive"/></a>';
            echo '</div>';//end col-md-1
            
        }

        $pdo = null;
    
    }
    
/* Supports the DisplayImageList function as a filter  */
    function filterby($filter, $val){
  
        if($filter=="title"){
            return 'SELECT Path, CountryCodeISO, ImageID, Title FROM ImageDetails WHERE Title LIKE "%'.$val.'%"';
        }
        elseif($filter=="continent"){
            return 'SELECT Path, ContinentCode, ImageID, Title FROM ImageDetails WHERE ContinentCode ="'.$val.'"';
        }
       elseif($filter=="country"){
            return 'SELECT Path, CountryCodeISO, ImageID, Title FROM ImageDetails WHERE CountryCodeISO ="'.$val.'"';
        }
         elseif($filter=="city"){
            return 'SELECT Path, CityCode, ImageID, Title FROM ImageDetails WHERE CityCode ="'.$val.'"';
       }
        if($filter=="none"){
            return 'SELECT Path, ImageID, Title FROM ImageDetails';
        }
  
    }

/* Displays Image List */
    function DisplayImageList($qry){
        $pdo = connectDB();
        $stmt = $pdo->prepare($qry);
        $stmt->execute();
    
        while($row = $stmt->fetch()){
            echo '   
			    <li>
                    <a href="single-image.php?imageid='.$row["ImageID"].'" class="img-responsive">
                        <img src="images/square-medium/'.$row["Path"].'" alt="'.$row["Description"].'">
                        <div class="caption">
                            <div class="blur"></div>
                            <div class="caption-text">
                                <p>'.$row["Title"].'</p>
                            </div><!--end caption text-->
                        </div><!--end caption-->
                    </a><!--end link-->
			     </li> 
		    ';//end echo
        }
        $pdo = null;
    }
    
/* Get Country List */
    function getCountryList(){
        //connect to db
        $pdo = connectDB();
    
        //Get Country name and ISO
        $sql="SELECT CountryName, ISO 
        FROM Countries INNER JOIN ImageDetails 
        WHERE Countries.ISO = ImageDetails.CountryCodeISO GROUP BY CountryName ORDER BY CountryName";
        $stmt = $pdo->prepare($sql);
        $stmt -> execute();
        
        while($row = $stmt->fetch()){
            echo '<div class="col-md-3">';
            echo '<a href="single-country.php?ISO='.$row["ISO"].'">'.$row["CountryName"].'</a>';
            echo '</div>';

        }
        $pdo=null;
    }
    
/* Prints Left Navigation Country List */
    function asideCountryList(){
        //connect to db
        $pdo = connectDB();
    
        //Get Country name and ISO
        $sql="SELECT CountryName, ISO FROM Countries INNER JOIN ImageDetails WHERE Countries.ISO = ImageDetails.CountryCodeISO GROUP BY CountryName ORDER BY CountryName";
        $stmt = $pdo->prepare($sql);
        $stmt -> execute();
        
        while($row = $stmt->fetch()){
            echo '<li class="list-group-item"><a href="browse-images.php?continent=0&country='.$row["ISO"].'&city=0&title=">'.$row["CountryName"].'</a></li>';
        }
        $pdo=null;
    }
    
/* Prints Left Navigation Continent List */
    function asideContinentList(){
        //connect to db
        $pdo = connectDB();
    
        //Get Continent name and code
        $sql = "SELECT ContinentName, ContinentCode FROM Continents";
        $stmt = $pdo->prepare($sql);
        $stmt -> execute();
        
        while($row = $stmt->fetch()){
            echo '<li class="list-group-item">';
            echo '<a href ="browse-images.php?continent='.$row["ContinentCode"].'&country=0&city=0&title=">';
            echo $row["ContinentName"];
            echo '</a></li>';
        }
        $pdo=null;
        
    }
    
/* Prints the details of a single image */
    function singleImageDetails(){
        $pdo = connectDB();
    
        $sql="SELECT ImageDetails.ImageID, ImageDetails.UserID, ImageDetails.Title, ImageDetails.Description, ImageDetails.Path, Users.FirstName, Users.LastName, Countries.CountryName, Countries.ISO, Cities.AsciiName, Cities.CityCode 
            FROM ImageDetails
            INNER JOIN Users ON ImageDetails.UserID = Users.UserID
            INNER JOIN Countries ON ImageDetails.CountryCodeISO = Countries.ISO
            INNER JOIN Cities ON Cities.CityCode = ImageDetails.CityCode
            WHERE ImageID =:imageID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":imageID", $_GET["imageid"]);
        $stmt ->execute();
        $result = $stmt->fetch();
        
        echo '<div class="col-md-8">
                        <img  src="images/medium/'.$result["Path"].'" class="img-responsive" alt="'.$result["Description"].'">
                        <h5>'.$result["Description"].'</h5>
                    </div><!--end col-md-8 (Image display)-->

                    <div class="col-md-4">
                        <h2>'.$result["Title"].'</h2>

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul >
                                    <li>By: <a href="single-user.php?userid='.$result["UserID"].'">'.$result["FirstName"].' '.$result["LastName"].'</a></li>
                                    <li>Country: <a href="single-country.php?ISO='.$result["ISO"].'">'.$result["CountryName"].'</a></li>
                                    <li>City: '.$result["AsciiName"].'</li>
                                </ul>
                            </div>
                        </div><!--end image details panel-->
                        
                        <div class="btn-toolbar" role="toolbar"">
                        <div class="btn-group btn-group-lg " role="group">
                            
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button>
                            
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-save" aria-hidden="true"></span></button>
                            
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                            
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button>
                                                                                           
                        </div><!--end button group-->
                        </div>

                    </div> <!--end col-md-4-->
            ';
        $pdo=null;
    }
    
/* Prints panel heading */
    function getCityName($id){
        $pdo = connectDB();
        $sql = "SELECT AsciiName FROM Cities WHERE CityCode=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue("id", $id);
        $stmt->execute();
        $row = $stmt->fetch();
        echo '[City='.$row["AsciiName"].']';
    }
    
/* Get User Details */
    function userDetails($id){
        $pdo = connectDB();
        $sql="SELECT FirstName, LastName, Address, City, Country, Postal, Phone, Email FROM Users WHERE Users.UserID = :userID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":userID", $id);
        $stmt ->execute();
        $row = $stmt->fetch();
        
        echo '<h2>'.$row["FirstName"].' '.$row["LastName"].'</h2>';
        echo '<p>'.$row["Address"].'</p>';
        echo '<p>'.$row["City"].', '.$row["Postal"].', '.$row["Country"].'<p>';
        echo '<p>'.$row["Phone"].'<p>';
        echo '<p>'.$row["Email"].'<p>';
        
        return $row["FirstName"].' '.$row["LastName"];
        
        $pdo=null;
    }
    
/* Display Images by the User */
    function imagesByUser($id){
        $pdo = connectDB();
        $sql="SELECT Path, ImageID FROM ImageDetails WHERE ImageDetails.UserID = :userID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":userID", $id);
        $stmt ->execute();
        
        while ($row = $stmt->fetch()) {
            echo '<div class="col-md-1">';
            echo '<a href="/single-image.php?imageid='.$row["ImageID"].'"><img src="/images/square-small/'.$row["Path"].'"/></a>';
            echo '</div>';
        }
        
        $pdo=null;
    }

?>