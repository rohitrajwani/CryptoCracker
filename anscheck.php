<?php
include('connection.php');
    // Create connection
    $conn = new mysqli($servername, $username, $password,'2014159');
    // Check connection
    if ($conn->connect_error) {  
        die("Connection failed: " . $conn->connect_error);
    }
    setcookie('prob',$_POST['prob'],time()+10000);
    
    $code = $_POST['submit'];
    $answer = md5($_POST['answer']);
    //echo $code;
    $query = "SELECT * from contest where ContestID = '".$_COOKIE['contestid']."'";
	//echo $query;    
    $results = $conn->query($query);
    $row = $results->fetch_assoc();
    $start = $row["StartTime"];
    $end = $row["EndTime"];
    $query = 'SELECT TIMESTAMPDIFF(SECOND,NOW(),"'.$end.'") as diff from contest where ContestId = '.$_COOKIE["contestid"].'';
    //echo $query;
    
    $results = $conn->query($query);
    $row = $results->fetch_assoc();
    if($row["diff"]<0)
    {
         echo '<script>alert("Contest has Ended :P")</script>';
         header( "Refresh:0; url=logout.php", true, 303);
         exit();
    }
    $query = "SELECT Answer from problems WHERE Problem_Code='".$code."' AND Answer = '".$answer."'";
    //echo $query;
    //echo $_COOKIE['username'];
    //echo $start;
    $result = $conn->query($query);
    
    if($result->num_rows>0)
        {
            $query = "SELECT * from attempts where Username = '".$_COOKIE['username']."' AND Problem_Code = '".$code."'";
            $result = $conn->query($query);
            if($result->num_rows<1)
            {
                $query = "INSERT INTO attempts(Username,Problem_Code) VALUES ('".$_COOKIE['username']."','$code')";
                $result = $conn->query($query);
                $query = "Update registers set Timer = TIME_TO_SEC(TIMEDIFF(NOW(),'".$start."')),Score = Score + 100 where Username = '".$_COOKIE['username']."' and ContestID = '".$_COOKIE['contestid']."'";
                //echo $query;
                $result = $conn->query($query);
            }
	    //setcookie('prob',$_COOKIE['prob']+1,time()+100000);
            echo '<script>alert("Right Answer")</script>';
        }
    else
        {
            echo '<script>alert("Wrong Answer")</script>';
        }
    header( "Refresh:0; url=live_contest.php", true, 303);
    $conn->close();
?>
