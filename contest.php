<!DOCYTPE html>
<html>
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
        <link href="css/contest_style.css" rel="stylesheet">
    </head>
    
    <body>
       <script>
           function myfunc()
           {
               window.open("host.php","Host","status=1,toolbar=0,location=0")
           }
        </script>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                  <a href="#!" class="brand-logo" style="float:left">CryptoCracker</a>
                  
                    <a class="btn-flat waves-effect login-btn" href="logout.php">logout</a>
                </div>
            </nav>
        </div>
        
        <div class="contests row container">
            <h4 class="col s12 l4 offset-l4" style="margin-right:0;"></h4>
            
             <?php
                   
                    session_start();
                if(isset($_SESSION['admin']))  
                echo '<a class="btn-flat waves-effect login-btn" onclick="myfunc()">Host a Contest</a>
                  ';
                  $info = getdate();
				   $dstr = date("h:i:sa");
				   
				   $ll = strlen($dstr);
				   if($dstr[$ll-2]=='p')
				   	{
				   		$info["hours"]+=12;
				   	}
                  
			
                  ?>
                               <div class="row">
                <div class="col s12">
                  <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#current">Current Contests</a></li>
                    <li class="tab col s3"><a href="#upcoming">Upcoming Contests</a></li>
                    <li class="tab col s3"><a href="#past">Past Contests</a></li>
                  </ul>
                </div>
                <div id="current" class="col s12">
                <?php
                 
                ?>
                    <div class="row" style="padding:20px;">
                       <?php
                        /*header('Cache-Control: no cache'); //no cache
                            session_cache_limiter('private_no_expire'); // works
                          */  
                        echo '<h4 class="s12"id="timer">Server Time</h4>
			<script>
				var x = Date.UTC('.$info["year"].','.$info["mon"].','.$info["mday"].','.$info["hours"].','.$info["minutes"].','.$info["seconds"].');
				var d = new Date(x);
				console.log(d.getHours());
				setInterval(function() {
				        d = new Date(x-19800000);
				        x = x + 1000;
				        var hhh = d.getHours()+12;
				        var mmm = d.getMinutes();
				        var sss = d.getSeconds();
				        if(hhh<=9)
				        	hhh = "0" + hhh;
				        if(mmm<=9)
				        	mmm = "0" + mmm;
				        if(sss<=9)
				        	sss = "0" + sss;
				        document.getElementById("timer").innerHTML=(((hhh) +":" + (mmm) + ":" + sss ));
				}, 1000);			
			</script>';
                            if(!isset($_SESSION['username']))
                                {
                                    echo '<script>alert("You need to Log In first")</script>';
                                    header( "Refresh:0; url=index.php", true, 303);
                                    exit();
                                }
                           include('connection.php');
                              
                            // Create connection
                            $conn = new mysqli($servername, $username, $password,'2014159');
                            // Check connection
                             if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            $str = "SELECT * from contest WHERE StartTime<NOW() AND EndTime>NOW() ORDER BY StartTime";
                            $sq=$conn->query($str); 
                            if($sq->num_rows>0)
                            {
                                 while($result=$sq->fetch_assoc())
                                {
                                    $date=date($result['StartTime']);
                                 echo '<div class="col s12 l4">
                                      <div class="card small" style="height:500px">
                                        <div class="card-image">
                                          <img src="images/bg.jpg">
                                        </div>
                                        <div class="card-title" style="text-align:center">
                                          '.$result["ContestName"].'<br><small style="text-align:center">'.$date.'</small>
                                        </div>
                                        <div class="card-action">
                                        <form method="POST">';
                                        
                                            if($result['Admin']==$_SESSION['username'])
                                            {
                                                echo '<center><button type="submit" formaction="test2.php" class="btn waves-effect" name="submit" value="'.$result["ContestID"].'">Edit</button></center>';
                                            }
                                        else
                                        {
                                            echo '<center><button type="submit" formaction="contest_details.php" class="btn waves-effect" name="submit" value="'.$result["ContestID"].'">Participate</button></center>';
                                        }
                                     echo '
                                        </form></div>
                                      </div>
                                    </div>';
                                 }        
                                    
                                }
                            else
                            {
                               echo 'No Contest'; 
                            }
                                $conn->close();
                            ?>
                      </div> 
                </div>
                <div id="upcoming" class="col s12">
                    <div class="row" style="padding:20px;">
                        <?php
                           include('connection.php');
                              
                            // Create connection
                            $conn = new mysqli($servername, $username, $password,'2014159');
                            // Check connection
                             if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            $str = "SELECT * from contest WHERE StartTime>NOW() ORDER BY StartTime";
                            $sq=$conn->query($str); 
                            if($sq->num_rows>0)
                            {
                                 while($result=$sq->fetch_assoc())
                                {
                                    $date=date($result['StartTime']);
                                 echo '<div class="col s12 l4">
                                      <div class="card small"  style="height:500px">
                                        <div class="card-image">
                                          <img src="images/bg.jpg">
                                        </div>
                                        <div class="card-title" style="text-align:center">
                                          '.$result["ContestName"].'<br><small style="text-align:center">'.$date.'</small>
                                        </div>
                                        <div class="card-action">
                                        <form method="POST" target="_blank">';
                                            
                                        if($result['Admin']==$_SESSION['username'])
                                            {
                                                echo '<center><button type="submit" formaction = "test2.php" class="btn waves-effect" name="submit" value="'.$result["ContestID"].'">Edit</button></center>';
                                            }
                                        else
                                        {
                                            echo '<center><button type="submit" formaction="contest_details2.php" class="btn waves-effect" name="submit" value="'.$result["ContestID"].'">View Details</button></center>';
                                        }
                                                echo '
                                        </form>
                                        </div>
                                      </div>
                                    </div>';
                                 }        
                                    
                                }
                            else
                            {
                               echo 'No Contest'; 
                            }
                                $conn->close();
                            ?>
                      </div>  
                </div>
                <div id="past" class="col s12">
                    <div class="row" style="padding:20px;">
                        <?php
                           include('connection.php');
                              
                            // Create connection
                            $conn = new mysqli($servername, $username, $password,'2014159');
                            // Check connection
                             if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            $str = "SELECT * from contest WHERE EndTime<NOW() ORDER BY Endtime";
                            $sq=$conn->query($str); 
                            if($sq->num_rows>0)
                            {
                                 while($result=$sq->fetch_assoc())
                                {
                                    $date=date($result['StartTime']);
                                 echo ' <div class="col s12 l4">
                                           <div class="card small" style="height:500px;">
                                             <div class="card-image">
                                               <img src="images/bg.jpg">
                                             </div>
                                           <div class="card-title" style="text-align:center">
                                          '.$result["ContestName"].'<br><small style="text-align:center">'.$date.'</small>
                                        </div>
                                    <div class="card-action">
                                    <form method="POST">
                                        <center><button type="submit" formaction="view_problems.php" class="btn waves-effect" name="submit" value="'.$result["ContestID"].'">View Problems</button><button type="submit" formaction="view_leaderboards.php" class="btn waves-effect" name="submit" value="'.$result["ContestID"].'">View Leaderboard</button></center>
                                    </form>
                                    </div>
                                  </div>
                                  </div>';
                                 }        
                                    
                                }
                            else
                            {
                               echo 'No Contest'; 
                            }
                                $conn->close();
                            ?>
                      </div>   
                </div>
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
