<?php
include('connection.php');
session_start();
// Create connection
$conn = new mysqli($servername, $username, $password,'2014159');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} /*
session_start();
// Create database
                        if(!isset($_POST['submit']))
                            {
                                $_POST['submit'] = $_SESSION['submit'];
                            }
                        else
                            {
                                $_SESSION['submit'] = $_POST['submit'];
                            }*/

    if(!isset($_POST['submit']))
                            {
                                $_POST['submit'] = $_SESSION['submit'];
                            }
                        else
                            {
                                $_SESSION['submit'] = $_POST['submit'];
                            }

$contestid = $_POST['submit'];
$q = "SELECT * from registers WHERE ContestID = '".$contestid."' ORDER BY Score DESC,Timer ASC ";
//echo $q;
$result = $conn->query($q);
$i = 0;
if ($result->num_rows > 0)
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
        $score[$i] = array($row["Username"],$row["Score"],$row['Timer']);
        $i++;
    }
} 
$length = $i - 1;
$conn->close();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        
        <title>CryptoCracker</title>
        <link rel="shortcut icon" href="images/tablogo.png"/> <!--shortcut icon on tab-->
        
        <link rel="stylesheet" href="font/font-awesome-4.2.0/css/font-awesome.min.css">

        <!-- Materialize -->
        <link href="css/materialize.min.css" rel="stylesheet">
        
        <!-- Custom CSS file-->
        <link href="css/style.css" rel="stylesheet">
        <style>
            .leaderboards{
                margin: auto;
                margin-top: 20px;
                width: 80%;
            }
            table{
                margin-top: 10px;
                width: 100%;
                border-collapse: collapse;
                font-family: sans-serif;
                text-align: center;
            }
            tr,td{
                padding: 10px;
                border-bottom: 1px solid lightgrey;
            }
            
            tr:nth-child(even){
                background-color: rgba(232, 237, 239, 0.65);
            }
            
            tr:nth-child(odd){
                background-color: whitesmoke;
            }
            
            table tr th{
                padding: 10px;
                border-bottom: 1px solid lightgrey;
                font-size: 1.2em;
                font-weight: 100;
                text-align: center;
                background-color: rgba(89, 92, 93, 0.83);
                color: whitesmoke;
                border-radius: 0px;
                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
            }
            td:nth-child(1),td:nth-child(2),td:nth-child(3),td:nth-child(4){
                text-align: center;       
            }
            
            .fa{
                font-size: 0.95em;
            }
            
        </style>
        
    </head>
 
         <body>
         <div class="navbar">
            <nav>
                <div class="nav-wrapper">
                  <a href="#!" class="brand-logo">CryptoCracker</a>
                </div>
            </nav>
        </div>
            <div class="leaderboards">
                <h4 class="slogan" ><i class="fa fa-trophy"></i>&nbsp;&nbsp; Leaderboard &nbsp;&nbsp;<i class="fa fa-trophy"></i></h4>
        <table>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Score</th>
                <th>Time</th>
            </tr>
       <?php
		if($length<0)
			{
				echo "<tr><td colspan=4>Oops! No Data</td></tr>";		
			}		
                for($i=0;$i<=$length;$i++)
                    {   
                        $rank = $i+1;
                        echo "<tr><td>".$rank;
                        echo "</td><td>".$score[$i][0];
                        echo "</td><td>".$score[$i][1];
                        echo "</td><td>".$score[$i][2];
                        echo "</td></tr>";
//                        echo '<tr><td>'.($i+1).'</td><td>'.$score[$i][0].'</td><td>'.$score[$i][1].'</td><td>'.$score[$i][2].'</td></tr>';
                    }
            ?>
        </table>
    </div>
    </body>

</html>
