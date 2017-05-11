<!DOCYTPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CryptoCracker</title>
        <link rel="shortcut icon" href="images/tablogo.png"/> <!--shortcut icon on tab-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Materialize -->
        <link href="css/materialize.min.css" rel="stylesheet">
        
        <!-- Custom CSS file-->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/host_style.css" rel="stylesheet">
    </head>
    
    <body onunload="">
       
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                  <a href="#!" class="brand-logo">CryptoCracker</a>
                  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                 
                  <a class="btn-flat waves-effect login-btn" href="logout.php">logout</a>
                </div>
            </nav>
        </div>
        
        <div class="details row container">
            <h4 class="col s12 l8 offset-l2" style="margin-right:20%">Upload Questions and Answers</h4>
            <form method="post" enctype="multipart/form-data" action="upload_check.php" name="upload_form">
                <?php
                session_start();
                
                    if(!isset($_SESSION['admin']))
                                {
                                    echo '<script>alert("You need to Log In first with admin privileges")</script>';
                                    header( "Refresh:0; url=index.php", true, 303);
                                    exit();
                                }
                    $problemscount = $_COOKIE['problemscount'];

                    for($i = 1 ; $i <= $problemscount ; $i++){

                        echo '
                            <div class="row">
                                <h5 class="col s1 l2">'.$i.'</h5>
                                <div class="file-field input-field col s6 l6">
                                      <div class="btn">
                                        <span>File</span>
                                        <input type="file" id="Q'.$i.'" name="Q'.$i.'" required>
                                      </div>
                                      <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                      </div>
                                </div>
                                <div class="input-field col s3 l3">
                                  <input id="answer" type="text" class="validate" name="answer[]" required>
                                  <label for="answer">Answer '.$i.'</label>
                                </div>
                            </div>
                        ';

                    }


                ?>

    <!--
                <div class="row">
                    <h5 class="col s1 l2">1.</h5>
                    <div class="file-field input-field col s6 l6">
                          <div class="btn">
                            <span>File</span>
                            <input type="file" name="Q1">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                          </div>
                    </div>
                    <div class="input-field col s3 l3">
                      <input id="answer" type="text" class="validate" name="answer[]">
                      <label for="answer">Answer 1</label>
                    </div>
                </div>
    -->
                <div class="row">
                    <button type="submit" value="Submit" class="submit-btn btn waves-effect col s8 l2 offset-s2 offset-l5">Submit</button>
                </div>
            </form>
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