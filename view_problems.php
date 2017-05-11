<?php
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire'); // works
    session_start();
    if(!isset($_SESSION['username']))
                                {
                                    echo '<script>alert("You need to Log In first")</script>';
                                    header( "Refresh:0; url=index.php", true, 303);
                                    exit();
                                }
    include('connection.php');
    if(!isset($_POST['submit']))
                            {
                                $_POST['submit'] = $_SESSION['submit'];
                            }
                        else
                            {
                                $_SESSION['submit'] = $_POST['submit'];
                            }
    $contestid=$_POST['submit'];
    // Create connection
    $conn = new mysqli($servername, $username, $password,'2014159');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo '<html>';
    $query = "SELECT problems.Problem_Code,Answer from contains,problems WHERE ContestID='".$_POST['submit']."' AND problems.Problem_Code = contains.Problem_Code ORDER BY Problem_Code";
    //echo $query;
    echo '<script>var answer = [""];</script>';
    echo '<script>var question = [""];</script>';
    $result = $conn->query($query);
    //echo $query;
    $count = $result->num_rows;
    $conn->close();
    $i = 0;
    echo '<script>var index=0;</script>';
    while($row = $result->fetch_assoc())
        {
            echo '<script>question['.$i.']="'.$row["Problem_Code"].'";</script>';
            echo '<script>answer['.$i.']="'.$row["Answer"].'";</script>';
            $i++;
        }
echo '
        
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
            <title>CryptoCracker</title>
            <link rel="shortcut icon" href="images/tablogo.png"/> <!--shortcut icon on tab-->
            

            <!-- Materialize -->
            <link href="css/materialize.min.css" rel="stylesheet">

            <!-- Custom CSS file-->
            <link href="css/style.css" rel="stylesheet">
            <link href="css/view_problems_style.css" rel="stylesheet">
        </head>

        <body>

            <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                  <a href="contest.php" class="brand-logo">CryptoCracker</a>
                  <a href="contest.php" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                 
                  <a class="btn-flat waves-effect login-btn" href="logout.php">logout</a>
                </div>
            </nav>
        </div>

            <div class="problems row container">
                <h4 class="col s12 l4 offset-l2">Problems</h4>
                <div class="col s12 l9">';         
                    echo '<script>var index=0;var MAX = '.$count.'</script>';
                    echo '<h5 id="qno" class="col s1" style="border-right: 2px solid lightgrey;">.</h5>
                            <div class="problem-image col s11 l11">
                                <img id = "sources" src="">
                          </div>';
                        echo '<script language="javascript">
                        document.getElementById("qno").innerHTML=index+1;
                        str="uploads/'.$contestid.'/";
                                document.getElementById("sources").src = str+question[index];
                    function next() 
                            {
                                index=(index+1)%MAX;   
                                document.getElementById("qno").innerHTML=index+1;
                                str="uploads/'.$contestid.'/";
                                document.getElementById("sources").src = str+question[index];
                                document.getElementById("answer").innerHTML=answer[index];
                            }
                    function prev() 
                            {
                                index=(index-1+MAX)%MAX;
                                document.getElementById("qno").innerHTML=index+1;
                                document.getElementById("answer").innerHTML=answer[index];
                                
                                str="uploads/'.$contestid.'/";
                                document.getElementById("sources").src = str+question[index];
                            }
                        </script>';  

                    echo '<div class="button-bar col s12">
                        <button class="btn col s2 waves-effect" onclick = prev()>Previous</button>
                        <div class="answer col s4 l4 offset-l2">
                            <a class="dropdown-button" href="#!" data-activates="dropdown1">See Answer</a>
                            <ul id="dropdown1" class="dropdown-content">
                              <li id="answer">Answer here</li>
                              <script>document.getElementById("answer").innerHTML=answer[index];</script>
                            </ul>
                        </div>
                        <button class="btn col s2 offset-l2 waves-effect" onclick = next()>Next</button>
                    </div>


                </div>
                <div class="divider col s12"></div>
                <h4 class="col s12 l4 offset-l4"></h4>
            </div>

            <script src="js/jquery-2.1.4.min.js"></script>
            <script src="js/materialize.min.js"></script>
            <script>
                $(document).ready(function(){
                    $(".dropdown-button").dropdown();
                });
            </script>';
        echo '</body>

    </html>';
?>
