<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        header( "Refresh:0; url=contest.php", true, 303);
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
        <link href="font/material-design-icons/material.css" rel="stylesheet">

        <!-- Materialize -->
        <link href="css/materialize.min.css" rel="stylesheet">
        
        <!-- Custom CSS file-->
        <link href="css/style.css" rel="stylesheet">
    </head>
    
    <body style="overflow-y:hidden">
       
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                  <a href="#!" class="brand-logo">CryptoCracker</a>
                  <a class="btn-flat waves-effect login-btn modal-trigger" href="#modal">Signup</a>
                  <a class="btn-flat waves-effect login-btn modal-trigger" href="#modal">login</a>
                </div>
            </nav>
        </div>
        
        <!-- Login/Signup Modal -->
          <div id="modal" class="modal">
            <div class="modal-content">
              <div class="row">
                    <div class="col s12" style="padding:0px;">
                      <ul class="tabs">
                        <li class="tab col s6"><a class="active" href="#login"  style="border-right: 2px solid rgba(204,204,204,0.3);">Login</a></li>
                        <li class="tab col s6"><a href="#signup">Sign Up</a></li>
                      </ul>
                    </div>
                    <div id="login" class="col s12">
                        <div class="row">
                            <form class="col s12" name="login" action="logincheck.php" method="post">
                              <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                  <i class="col s2 fa fa-user"></i>
                                  <input id="icon_prefix" type="text" class="col s10 validate" name="username" required placeholder="Username">
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                  <i class="col s2 fa fa-unlock-alt"></i>
                                  <input id="password" type="password" class="col s10 validate" name="password" placeholder="Password" required>
                                </div>
                              </div>
                                <div class="modal-footer">
                                    <button type="submit" class= "modal-action modal-close waves-effect waves-green btn">Login</button>
                                </div>
                            </form>
                          </div>
                    </div>
                    <div id="signup" class="col s12">
                        <div class="row">
                            <form class="col s12" name="signup" action="signupcheck.php" method="post">
                              <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                  <i class="col s2 fa fa-user"></i>
                                  <input id="icon_prefix" type="text" class="col s10 validate" name="username" required placeholder="Username">
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12 l6">
                                  <input id="icon_prefix" type="number" class="validate" name="fname" required>
                                  <label for="icon_prefix">Roll No. 1</label>
                                </div>
                                <div class="input-field col s12 l6">
                                  <input id="icon_prefix" type="number" class="validate" name="lname">
                                  <label for="icon_prefix">Roll No. 2</label>
                                </div>
                              </div>
                              <div class="row">
                                    <div class="input-field col s12 l6">
                                        <i class="col s2 fa fa-envelope"></i>
                                      <input id="email" type="email" class="col s10 validate" placeholder="E-Mail" name="mail" required>
                                    </div>
                                    <div class="input-field col s12 l6">
                                      <i class="col s2 fa fa-phone"></i>
                                      <input id="phone" type="tel" class="col s10 validate" name="phone" required placeholder="Contact No.">
                                    </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12 l8 offset-l2">
                                  <i class="col s2 fa fa-key"></i>
                                  <input id="password" type="password" class="col s10 validate" name="password" required placeholder="Password">
                                </div>
                              </div>
                                <div class="modal-footer">
                                    <button type="submit" class= "modal-action modal-close waves-effect waves-green btn">Signup</button>
                                </div>
                            </form>
                          </div>
                    </div>
                </div>
            
          </div>
        </div>
        
        <div class="landing-bg" style="background-position-y:0px;background-size:cover">
            <div class="mask row">
                <p class="slogan col s12 l8 offset-l2">Welcome to Crypto-Contest Portal</p>
                <p class="sub-slogan col s12 l8 offset-l2">created with ♥ :)</p> 
<!--                <a href="#!" class="col s8 offset-s2 l2 offset-l5 btn-flat waves-effect contest-btn">View Contests</a>-->
            </div>
        </div>
        
        <div class="quote">
            <h5>"Programs must be written for people to read, and only incidentally for machines to execute."</h5>
            <h6>- Carl Rogers</h6>
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
                strings: ["Welcome to Crypto-Contest Portal"],
                typeSpeed: 30
              });
              $(".sub-slogan").typed({
                strings: ["created for those who love to solve!!"],
                typeSpeed: 15
              });
          });
        </script>
    </body>
    
</html>
