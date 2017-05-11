<?php

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
$contestid=$_COOKIE['contestid'];
$n = $_COOKIE['problemscount'];
/***************************************/
$FILE = fopen("temp2.txt",'r');
$problemcode = fgets($FILE);
//echo $contestid;
fclose($FILE);
if(!isset($_COOKIE['query']))
{
    echo '<script>alert("Sorry the contest exists or there is some problem")</script>';
    $conn->close();  
    echo 'window.close()';
    exit();
}
$conn->query($_COOKIE['query']);
mkdir('uploads/'.$contestid.'/');
setcookie('query',time()-100);

/***************************************/
for($i=1;$i<=$n;$i++)
    {
        $problemcode = $problemcode + 1;
        $target = 'uploads/'.$contestid.'/'.basename($_FILES["Q".$i]["name"]);
        $ext = pathinfo($target,PATHINFO_EXTENSION);
        if($ext!="jpg"&&$ext!="png"&&$ext!="gif")
            {
                echo "Sorry the file is an invalid image";
                die();  
            }
        
        $target_file = 'uploads/'.$contestid.'/'.$problemcode;
        move_uploaded_file($_FILES["Q".$i]["tmp_name"], $target_file);
        $index=$i-1;
        $answer[$index] = md5($answer[$index]);
        $query = "INSERT INTO problems(Problem_Code,Answer,Max_Score) VALUES ('$problemcode','$answer[$index]',$max_score);";
        $result=$conn->query($query);
        $query = "INSERT INTO contains(ContestID,Problem_Code) VALUES ('$contestid','$problemcode');";
        $result=$conn->query($query);
    }

$FILE = fopen("temp2.txt",'w');
fwrite($FILE,$problemcode);
fclose($FILE);
echo '<script>alert("Your Contest has been Succesfully Set Up")</script>';
$conn->close();    
echo '<script>window.close()</script>';
?>
