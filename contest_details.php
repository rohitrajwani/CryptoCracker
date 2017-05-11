<!DOCYTPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CryptoCracker</title>
        <link rel="shortcut icon" href="images/tablogo.png"/> <!--shortcut icon on tab-->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->

        <!-- Materialize -->
        <link href="css/materialize.min.css" rel="stylesheet">
        
        <!-- Custom CSS file-->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/contest_details_style.css" rel="stylesheet">
    </head>
    
    <body>
       
            <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                  <a href="#!" class="brand-logo">CryptoCracker</a>
                  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                 
                  <a class="btn-flat waves-effect login-btn" href="logout.php">logout</a>
                </div>
            </nav>
        
        </div>
        
        <div class="contest_details row container">
             <div class="col s12">
                 <?php
                 
                session_start();
    		setcookie('prob',1,time()+10000);
				
                   if(!isset($_SESSION['username']))
                                {
                                    echo '<script>alert("You need to Log In first")</script>';
                                    header( "Refresh:0; url=index.php", true, 303);
                                    exit();
                                }
                            header('Cache-Control: no cache'); //no cache
                session_cache_limiter('private_no_expire'); // works
    
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
                            /*$str = "SELECT * from registers WHERE ContestID='".$contestid."' AND Username = '".$_COOKIE['username']."'";
                            $sq=$conn->query($str); 
                            if($sq->num_rows<1)
                            {
                                echo '<script>alert("You are not registered for this contest! Click on Participate to register and play")</script>';
                            }*/
                            $str = "SELECT * from contest WHERE ContestID='".$contestid."'";
                            $sq=$conn->query($str); 
                            $result=$sq->fetch_assoc();
                            $conn->close();

                            echo '<h4 class="col s12 l4 offset-l4">'.$result["ContestName"].'</h4>
                                <h5 class="col s2 offset-s1 " style="border:1px dashed lightgrey;line-height:1.75">Description</h5>
                                <pre class="col s10 offset-s1" style="padding-bottom: 50px;border-bottom: 1px solid lightgrey;">'.$result["Description"].'</pre>
                                <h5 class="col s2 offset-s1 " style="border:1px dashed lightgrey;line-height:1.75">Rules</h5>
                                 <pre class="col s10 offset-s1" style="padding-bottom: 50px;border-bottom: 1px solid lightgrey;">'.$result["Rules"].'</pre>
                                 <h5 class="col s3 offset-s1 " style="margin-right:50%;border:1px dashed lightgrey;line-height:1.75" >Date &amp; Time</h5>
                                 <p class="col s3 offset-s1" style="font-size:1.25em">'.$result["StartTime"].'</p>
                                 <h5 class="col s3 offset-s1 " style="margin-right:50%;border:1px dashed lightgrey;line-height:1.75" >No of Questions </h5>
                                 <p class="col s3 offset-s1" style="font-size:1.25em;">'.$result["ProblemCount"].' Questions</p>
                                 <form method="POST">
                                 <button type="submit" formaction="live_contest.php" name="submit" value="'.$result["ContestID"].'" class="btn col s2 offset-s5" style="margin-top:20px;height:50px;">Participate</button>
                                 </form>';
                                 
                 ?>
             </div>
            <h4 class="col s12 l4 offset-l4"></h4>
        </div>
        
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/materialize.min.js"></script>
        <script src="js/typed.js"></script>
        <script>
            $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
                //Tabs
                $('ul.tabs').tabs();
                $('select').material_select();
            });
          $(function(){
              $(".slogan").typed({
                strings: ["hi folks, Testing animation using CSS"],
                typeSpeed: 30
              });
              $(".sub-slogan").typed({
                strings: ["created with ♥ :)"],
                typeSpeed: 15
              });
          });
        </script>
    </body>
    
</html>
