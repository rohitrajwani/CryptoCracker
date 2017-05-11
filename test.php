<?php
    session_start();
    include('connection.php');
    $contestid=1002;
    // Create connection
    $conn = new mysqli($servername, $username, $password,'2014159');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $query = "SELECT ProblemCode,Answer from contains,problems WHERE ContestID='".$contestid."' AND problems.Problem_Code = contains.ProblemCode ORDER BY ProblemCode";
    echo '<script>var question = ["rahul"];</script>';
    echo $query;
    $result = $conn->query($query);
    $i = 0;
    while($row = $result->fetch_assoc())
        {
            echo '<script>question['.$i.']="'.$row["ProblemCode"].'";</script>';
            $i++;
        }
    echo '<p id="demo"></p>

<script>
document.getElementById("demo").innerHTML = question;
</script>';
    $count = $result->num_rows;
    $conn->close();
?>
