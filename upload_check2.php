<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if(!isset($_COOKIE['username']))
    {
        header('index.php');
    }
session_start();
include('connection.php');
$answer=$_POST['answer'];
$max_score=100;
$conn = new mysqli($servername, $username, $password,'2014159');

if ($conn->connect_error) 
    {
        die("Sorry our Servers are currently under maintenance: " . $conn->connect_error);
    }
//echo "HELLO";
$i = 1;
$contestid=$_COOKIE['contid'];
$problemcode = $_COOKIE['CI'];
//echo $contestid;
/***************************************/
        $target = 'uploads/'.$contestid.'/'.basename($_FILES["Q".$i]["name"]);
        $ext = pathinfo($target,PATHINFO_EXTENSION);
        if($ext!="jpg"&&$ext!="png"&&$ext!="gif")
            {
                echo "Sorry the file is an invalid image";
                die();  
            }
        
        $target_file = 'uploads/'.$contestid.'/'.$problemcode;
        unlink($target_file);
        move_uploaded_file($_FILES["Q".$i]["tmp_name"], $target_file);
        $index=$i-1;
        $query = "INSERT INTO problems(Problem_Code,Answer,Max_Score) VALUES ('$problemcode','$answer[$index]',$max_score);";
        $result=$conn->query($query);
$FILE = fopen("temp2.txt",'w');
fwrite($FILE,$problemcode);
fclose($FILE);
echo '<script>alert("Your Problem has been Succesfully Edited")</script>';
$conn->close();    
header( "Refresh:0; url=contest.php", true, 303);
exit();
?>
