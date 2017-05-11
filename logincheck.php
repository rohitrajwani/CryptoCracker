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
$str = "SELECT * from user WHERE Username='".$username."' AND Password='".$password."'";
$result = $conn->query($str);
$i = 0;
if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    if($username!=$row['Username'])
    {
        echo "<script type='text/javascript'>alert('Login ERROR');</script>";
        $conn->close();
        header( "Refresh:0; url=index.php", true, 303);
        exit();
    }
    setcookie('username',$username);
    $conn->close();
    session_start();
    
    if($row["IsAdmin"]==1)
    {
        $_SESSION['admin'] = $username;
    }
    $_SESSION['username'] = $username;
    header("Location: contest.php");
    exit();
} 
else {
    echo "<script type='text/javascript'>alert('Login ERROR');</script>";
    $conn->close();
    header( "Refresh:0; url=index.php", true, 303);
    exit();
}
?>
