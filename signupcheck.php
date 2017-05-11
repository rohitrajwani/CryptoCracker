<?php
include('connection.php');
// Create connection
$conn = new mysqli($servername, $username, $password,'2014159');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$username = strtolower($_POST['username']);
$password = md5($_POST['password']);
$mail = $_POST['mail'];
$phone = $_POST['phone'];
$fname = $_POST['fname'];
$lname = 0;
$lname = $_POST['lname'];
$str = "SELECT * from user WHERE Username='".$username."'";
$sq=$conn->query($str);
if($sq->num_rows>0)
    {
         echo "<script type='text/javascript'>alert('Username Already Exists');</script>";
         header( "Refresh:0; url=index.php", true, 303);
         exit();
    }
$str = "INSERT INTO user (Username, First_Name, Last_Name, Password, Email, Phone,IsAdmin) VALUES ('$username','$fname','$lname','$password','$mail','$phone','0')";
if ($conn->query($str)==TRUE)
    {
        echo "<script type='text/javascript'>alert('Signup Succesful');</script>";
        header( "Refresh:0; url=index.php", true, 303);
        exit();
    } 
else 
    {
        echo "<script type='text/javascript'>alert('SignUp ERROR');</script>";
        $conn->close();
        header( "Refresh:0; url=index.php", true, 303);
        exit();
    }
?>
