<?php

session_start();

if(!isset($_SESSION['admin']))
                                {
                                    echo '<script>alert("You need to be admin to access this content")</script>';
                                    header( "Refresh:0; url=index.php", true, 303);
                                    exit();
                                }


if(!isset($_POST['contestname']))
{
    echo '<script>alert("You reached a wrong location")</script>';
                                    header( "Refresh:0; url=index.php", true, 303);
                                    exit();
}

$admin = $_COOKIE['username'];
$contestname = $_POST['contestname'];
$category = $_POST['category'];
$description = $_POST['description'];
$problemscount = $_POST['problemscount'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];
$rules = $_POST['rules'];
setcookie('problemscount',$problemscount);
include('connection.php');
if(strtotime($starttime)>time()&&strtotime($endtime)>strtotime($starttime))
{//Reading of File 
$FILE = fopen("temp.txt",'r');
$contestid = fgets($FILE);
//echo $contestid;
fclose($FILE);
//Writing in file
$FILE = fopen("temp.txt",'w');
$contestid=$contestid+1;

fwrite($FILE,$contestid);
fclose($FILE);

setcookie('contestid',$contestid);
//echo $contestid;
$conn=mysqli_connect($servername,$username,$password,'2014159');
$query="INSERT INTO contest(ContestID,ContestName, ContestType, Category, Description, ProblemCount, Admin, StartTime, EndTime, Rules) VALUES ($contestid,'$contestname', 0, '$category', '$description', $problemscount, '$admin', '$starttime', '$endtime', '$rules');";
setcookie('query',$query);
//$result=$conn->query($query);
//echo $query;
$conn->close();
    header('Location: upload.php');
}
else
{
     echo '<script>alert("Invalid time to host a contest")</script>';
                                    header( "Refresh:0; url=host.php", true, 303);
                                    exit();
}

?>
