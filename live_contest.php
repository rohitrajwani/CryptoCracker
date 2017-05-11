<?php
    
    //header('Cache-Control: no cache'); //no cache
    //session_cache_limiter('private_no_expire'); // works
    session_start();
    if(!isset($_SESSION['username']))
                                {
                                    echo '<script>alert("You need to Log In first")</script>';
                                    header( "Refresh:0; url=index.php", true, 303);
                                    exit();
                                }
    echo '<HTML>';
   include('connection.php');
    if(!isset($_POST['submit']))
                            {
                                $_POST['submit'] = $_SESSION['submit'];
                            }
                        else
                            {
                                $_SESSION['submit'] = $_POST['submit'];
                            }
    $contestid=$_POST['submit'];//please change this field
    setcookie("contestid",$contestid,time()+5000);
    // Create connection
    $conn = new mysqli($servername, $username, $password,'2014159');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $str = "SELECT * from registers WHERE ContestID='".$contestid."' AND Username = '".$_COOKIE['username']."'";
    $sq=$conn->query($str); 
    if($sq->num_rows<1)
    {
        $query = "INSERT INTO registers(Username,ContestID,Score,Timer) VALUES ('".$_COOKIE['username']."','".$contestid."',0,0)";
        $conn->query($query);
    }
    $query = "SELECT Problem_Code from contains WHERE ContestID='".$contestid."' ORDER BY Problem_Code";
    //echo $query;
    echo '<script>var question = [""];</script>';
    echo '<script>var solved = [""];</script>';
    $result = $conn->query($query);
    $count = $result->num_rows;
    $conn->close();
    $i = 1;
	$conn = new mysqli($servername, $username, $password,'2014159');
    echo'<script>var index=1;</script>';
    while($row = $result->fetch_assoc())
        {
            echo '<script>question['.$i.']="'.$row["Problem_Code"].'";</script>';
	    $query = "SELECT * from  attempts where Username='".$_SESSION['username']."' and Problem_Code = ".$row["Problem_Code"]."";	    
		$resultttt = $conn->query($query);
		 if($resultttt->num_rows>0)
			{
				echo '<script>solved['.$i.']=1</script>';
			}
		else
			echo '<script>solved['.$i.']=0</script>';
            $i++;
        }
   $info = getdate();
   $dstr = date("h:i:sa");
   $ll = strlen($dstr);
   if($dstr[$ll-2]=="p")
   	{
   		$info["hours"]+=12;
   	}
echo '
    <head>
	 <script src="js/jquery-2.1.4.min.js"></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CryptoCracker</title>
        <link rel="shortcut icon" href="images/tablogo.png"/> <!--shortcut icon on tab-->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

        <!-- Materialize -->
        <link href="css/materialize.min.css" rel="stylesheet">
        
        <!-- Custom CSS file-->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/live_contest_style.css" rel="stylesheet">
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
             <div class="row">
                <div class="col s12">
                  <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#questions">Questions</a></li>
                    <li class="tab col s3"><a href="#leaderboard"> View Leaderboard</a></li>
                  </ul>
                </div>
                <div id="questions" class="col s12">
		<div class="col s8"  style="border-right:2px solid lightgrey">
                    <h4 id="qno"></h4>';
		
                echo '<script>index='.$_COOKIE['prob'].';console.log(index);var MAX = '.$count.';
                                    </script>';
                                   
                echo '<script language="javascript">
                        document.getElementById("qno").innerHTML=index;
                        $(document).ready(function(){
                        $("#nexts").click(function() 
                            {
                                index=(index)%MAX+1;   
                                $.post("update_cookie.php",{questionno:index});
				                document.getElementById("qno").innerHTML=index;
                                document.getElementById("answer").value="";
                                document.getElementById("prob").value=index;
                                var str="uploads/'.$contestid.'/";
                                document.getElementById("attempt").value=question[index];
                                document.getElementById("sources").src = str+question[index];
								console.log(index);
                                
                                if(solved[index]==1)
                                    {
                                        //document.getElementById("answer").value = "Already Solved";
                                        //document.getElementById("ans_label").style.display = "none";
                                        document.getElementById("attempt").disabled = true;
                                        document.getElementById("answer").disabled = true;
                                        document.getElementById("attempt").innerHTML = "Already Solved";
                                    }
                                else
									{
									document.getElementById("attempt").disabled = false;
																        document.getElementById("attempt").innerHTML = "SUBMIT";
																        document.getElementById("answer").disabled = false;
									}
                                
                            });});
                   $(document).ready(function(){
			$("#prevs").click(function() 
                            {
                                index = index-1;
                                if(index==0)
                                    index = MAX;				  
                                $.post("update_cookie.php",{questionno:index});
                                document.getElementById("prob").value=index;
                                document.getElementById("qno").innerHTML=index;
                                var str="uploads/'.$contestid.'/";
                                document.getElementById("answer").value="";
                               document.getElementById("attempt").value=question[index];
                             console.log(index);   
                                document.getElementById("sources").src = str+question[index];
                                if(solved[index]==1)
                                    {
                                        //document.getElementById("answer").value = "Already Solved";
                                        //document.getElementById("ans_label").style.display = "none";
                                        document.getElementById("attempt").disabled = true;
                                        document.getElementById("answer").disabled = true;
                                        document.getElementById("attempt").innerHTML = "Already Solved";
                                    }
                                else
                                {
                                document.getElementById("attempt").disabled = false;
                                                                    document.getElementById("attempt").innerHTML = "SUBMIT";
                                                                    document.getElementById("answer").disabled = false;
                                }
                            });});
                        </script>';  
                    echo '
			<div lass="col s10 offset-s1" style="text-align:center">
                    		<img id = "sources" class="question" src="" style="margin:auto;max-width:100%">
			</div>
                     <script>str="uploads/'.$contestid.'/";
                                document.getElementById("sources").src = str+question[index];</script>
   
                        ';
                echo '
                <div class="buttons col s12">
                        <form method="post">
                        <input type="hidden" id="prob" name="prob" value="'.$_COOKIE["prob"].'">
                        <div class="col s4 offset-s2">
                            <div class="input-field">
                              <input id="answer" value = "" type="text" name="answer">
                              <label id="ans_label" for="answer">Answer</label>
                            </div>
                        </div>
                        <button class="btn col s2 offset-s1 ans-btn" name = "submit" type="submit" id="attempt" formaction = "anscheck.php" style="margin-top:0;">Submit</button><br>
                        </form>

                        <button id="prevs" class="btn col s2 offset-s4"  style="margin-right:15px;">Previous</button>
                        <button id="nexts" class="btn col s2" style="margin-left:15px;">Next</button>
                        <script>document.getElementById("attempt").value = question[index];</script>
                        
                    </div>
                
		</div>
		<div class="col s4">
			<h4 class="s12" id="timer">Server Time</h4>
			<script>
				var x = Date.UTC('.$info["year"].','.$info["mon"].','.$info["mday"].','.$info["hours"].','.$info["minutes"].','.$info["seconds"].');
				var d = new Date(x);
				console.log(d.getHours());
				setInterval(function() {
				        d = new Date(x-19800000-600000);
				        x = x + 1000;
				        var hhh = d.getHours()+12;
				        var mmm = (d.getMinutes()-4+60)%60;
				        var sss = d.getSeconds();
				        if(hhh<=9)
				        	hhh = "0" + hhh;
				        if(mmm<=9)
				        	mmm = "0" + mmm;
				        if(sss<=9)
				        	sss = "0" + sss;
				        document.getElementById("timer").innerHTML=(((hhh) +":" + (mmm) + ":" + sss ));
				}, 1000);			
			</script>
            <div class="col s12">
            ';
            echo '<script>
            function switching(i)
            	{
                    console.log("HI");
            		index = i;
            		document.getElementById("prob").value=index;
					document.getElementById("qno").innerHTML=index;
					var str="uploads/'.$contestid.'/";
					document.getElementById("answer").value="";
					document.getElementById("attempt").value=question[index];
					console.log(index);   
					document.getElementById("sources").src = str+question[index];
					if(solved[index]==1)
						{
							//document.getElementById("answer").value = "Already Solved";
							//document.getElementById("ans_label").style.display = "none";
							document.getElementById("attempt").disabled = true;
							document.getElementById("answer").disabled = true;
							document.getElementById("attempt").innerHTML = "Already Solved";
						}
					else
						{
							document.getElementById("attempt").disabled = false;
					        document.getElementById("attempt").innerHTML = "SUBMIT";
					        document.getElementById("answer").disabled = false;
						}
            	}
            </script>';
            $i = 1;
            while($i<=$count)
            	{
                echo '<div class="col s3">
                    <button class="qno" id = "question'.$i.'" onclick = "switching('.$i.')">'.$i.'</button>
                </div>';
                $i++;
                }
                
               echo '
            </div>
		</div>
        
		</div>
                        
                    
                <div id="leaderboard" class="col s12">
                   
                    <iframe class="leaderboard col s10 offset-s1" src="view_leaderboard.php"></iframe>
                </div>
              </div>
            <h4 class="col s12 l4 offset-l4"></h4>
        </div>
        
       
        <script src="js/materialize.min.js"></script><script>
        if(solved[index]==1)
                                    {
                                        //document.getElementById("answer").value = "Already Solved";
                                        //document.getElementById("ans_label").style.display = "none";
                                        document.getElementById("attempt").disabled = true;
                                        document.getElementById("attempt").innerHTML = "Already Solved";
                                        document.getElementById("answer").disabled = true;
                                    }
                    else
                    {
                    document.getElementById("attempt").disabled = false;
                    document.getElementById("attempt").innerHTML = "SUBMIT";
                    document.getElementById("answer").disabled = false;
                    }
                                    </script>
        <script src="js/typed.js"></script>
        <script>
            $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $(".modal-trigger").leanModal();
                //Tabs
                $("ul.tabs").tabs();
                $("select").material_select();
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
    
</html>';

?>
