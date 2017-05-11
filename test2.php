
<!DOCYTPE html>
<html>
    <head>
        <meta Http-Equiv="Cache-Control" Content="no-cache">
<meta Http-Equiv="Pragma" Content="no-cache">
<meta Http-Equiv="Expires" Content="0">
<meta Http-Equiv="Pragma-directive: no-cache">
<meta Http-Equiv="Cache-directive: no-cache">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CryptoCracker</title>
        <link rel="shortcut icon" href="images/tablogo.png"/> <!--shortcut icon on tab-->
        <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Materialize -->
        <link href="css/materialize.min.css" rel="stylesheet">
        
        <!-- Custom CSS file-->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/contest_style.css" rel="stylesheet">
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
        <div class="contests row container">
            <h4 class="col s12 l4 offset-l4"></h4>
             <div class="row">
                <div id="current" class="col s12">
                    <div class="row" style="padding:20px;">
                       <?php
                       
                            
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
                            $CI=$_POST['submit'];
                            setcookie('contid',$CI);
                            // Create connection
                            $conn = new mysqli($servername, $username, $password,'2014159');
                            // Check connection
                             if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            $str = "SELECT * from contains where ContestID='".$CI."'ORDER BY Problem_Code";
                            $sq=$conn->query($str); 
                            if($sq->num_rows>0)
                            {
                                 while($result=$sq->fetch_assoc())
                                {
                                    
                                 echo '<div class="col s12 l4">
                                      <div class="card small">
                                        <div class="card-image">
                                          <img src="uploads/'.$result['ContestID'].'/'.$result['Problem_Code'].'".jpg">
                                        </div>                                       
                                        <div class="card-action">
                                        <form method="POST">
                                            <center><button type="submit" formaction="newupload.php" class="btn waves-effect" name="submit" value="'.$result['Problem_Code'].'">Change</button></center>
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
