<?php
//Fill this place

//****** Hint ******
//connect database and fetch data here
$server="127.0.0.1";
$sqlname="root";
$sqlpassword="969723hjj";
$dbname="travel";

$conn = mysqli_connect($server,$sqlname,$sqlpassword,$dbname);

if($conn->connect_error) {
    die("Connection failed:".$conn->connect_error);
}
else{
    echo "database connected successfully!";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="Lab11.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0" >Select Continent</option>
                <?php
                //Fill this place
                $sql_select = "SELECT * FROM continents";
                $result = mysqli_query($conn,$sql_select);
                //****** Hint ******
                //display the list of continents


                while($row = $result->fetch_assoc()) {
                  echo '<option value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                }

                ?>
              </select>     
              
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php 
                //Fill this place
                $sql_select = "SELECT * FROM countries";
                $result = mysqli_query($conn,$sql_select);

                while($row = $result->fetch_assoc()) {
                    echo '<option value=' . $row['ISO'] . '>' . $row['CountryName'] . '</option>';
                }

                //****** Hint ******
                /* display list of countries */ 
                ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary" id="filter">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    

        <script>
            var continent = $('input[name = continent]').val();
            var country = $('input[name = country]').val();

            $('#filter').click(function() {
                $.ajax({
                        type:"GET",
                        async:false,   //同步   默认是true（异步）
                        url:"Lab11.php",
                        data:{
                            continent:continent,
                            country:country
                        },
                        dataType:"TEXT",
                        success:function(){
                            alert('您已登出！');
                        }
                    });

            })



        </script>


		<ul class="caption-style-2">
  <?php
            //Fill this place
        $continent = $_GET['continent'];
        $country = $_GET['country'];

        if($continent && $country) {
            $sql_select = "SELECT * FROM imagedetails WHERE ContinentCode='$continent' OR CountryCodeISO = '$country'";
            $result = mysqli_query($conn, $sql_select);
        }
         else{
            $sql_select = "SELECT * FROM imagedetails";
            $result = mysqli_query($conn, $sql_select);
         }

            //****** Hint ******
            /* use while loop to display images that meet requirements ... sample below ... replace ???? with field data
            */
          while ($row = $result->fetch_assoc()) {
              $ImageID = $row['ImageID'];
              $Title = $row['Title'];
              $Description = $row['Description'];
              $Path = $row['Path'];
              echo '<li>
              <a href="detail.php?id=' . $ImageID . '" class="img-responsive">
                <img src="images/square-medium/' . $Path . '" alt="' . $Title . '">
                <div class="caption">
                  <div class="blur"></div>
                  <div class="caption-text">
                    <p>' . $Description . '</p>
                  </div></div></a></li>';
            }
          mysqli_free_result($result);





                function findByCoutry(){

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