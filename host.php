<?php

session_start();
if(!isset($_SESSION['admin']))
                                {
                                    echo '<script>alert("You need to be admin to access the content")</script>';
                                    header( "Refresh:0; url=index.php", true, 303);
                                    exit();
                                }


?>
<!DOCYTPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CryptoCracker</title>
        <link rel="shortcut icon" href="images/tablogo.png"/> <!--shortcut icon on tab-->
        <link rel="stylesheet" href="font/font-awesome-4.2.0/css/font-awesome.min.css">

        <!-- Materialize -->
        <link href="css/materialize.min.css" rel="stylesheet">
        
        <!-- Custom CSS file-->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/host_style.css" rel="stylesheet">
    </head>
    
    <body>
       
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                  <a href="#!" class="brand-logo">CryptoCracker</a>
                  <a class="btn-flat waves-effect login-btn" href="logout.php">logout</a>
                </div>
            </nav>
        </div>
        
        <div class="details row container">
            <h4 class="col s12 l4 offset-l4">Fill Contest Details</h4>
              <div class="row col s12 l8 offset-l2">
                <form class="col s12" action="host_upload.php" method="post">
                  <div class="row">
                    <div class="input-field col s12 l7">
                      <input id="contestname" type="text" class="validate" name="contestname" required>
                      <label for="contestname">Contest Name</label>
                    </div>
                  </div>
<!--
                  <div class="row">
                      <div class="input-field col s12 l6">
                          <h6>Contest Type</h6>
                          <input name="contesttype" type="radio" id="test1" />
                          <label for="test1">Type1</label>
                          <input name="contesttype" type="radio" id="test2" />
                          <label for="test2">Type2</label>
                      </div>
                  </div>
-->
                  <div class="row">
                      <div class="input-field col s12 l7">
                          <input id="problemscount" type="number" class="validate" name="problemscount" required>
                          <label for="problemscount">No. of Problems</label>
                      </div>
                  </div>
                  <div class="row">
                      <div class="input-field col s12 l7">
                        <select name="category">
                            <option value="1">Aptitude</option>
                            <option value="2">Astronomy</option>
                            <option value="3">Electronics</option>
                            <option value="4">Others</option>
                        </select>
                        <label>Category</label>
                      </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="description" class="materialize-textarea" rows="10" name="description"></textarea>
                      <label for="description">Description</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="rules" class="materialize-textarea" rows="15" name="rules"></textarea>
                      <label for="rules">Rules and Regulations</label>
                    </div>
                  </div>
                  <div class="row">
                      <div class="input-field col s12 l6">
                          <input name = "starttime" id="stime" type="text" class="validate" placeholder="YYYY-MM-DD HH:MM:SS">
                          <label for="stime">Start Time</label>
                      </div>
                      <div class="input-field col s12 l6">
                          <input name = "endtime" id="etime" type="text" class="validate" placeholder="YYYY-MM-DD HH:MM:SS">
                          <label for="etime">End Time</label>
                      </div>
                  </div>
                  <div class="row">
                      <button type="submit" value="Submit" class="btn waves-effect col s6 offset-s3" style="margin-top:10px;">Submit</button>
                  </div>
                </form>
              </div>
            <h4 class="col s12 l4 offset-l4"></h4>
        </div>
        
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/materialize.min.js"></script>
        <script>
            $(document).ready(function(){
                
                $('select').material_select();
            });
        </script>
    </body>
    
</html>
