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

include('connection.php');
$contestid = $_POST['submit'];

$conn=mysqli_connect($servername,$username,$password,'2014159');
$query="INSERT INTO contest(ContestID,ContestName, ContestType, Category, Description, ProblemCount, Admin, StartTime, EndTime, Rules) VALUES ($contestid,'$contestname', $contesttype, '$category', '$description', $problemscount, '$admin', '$starttime', '$endtime', '$rules');";
$result=$conn->query($query);
//echo $query;
$conn->close();
header('Location: upload.php');
?>
