<?php
session_start();
setcookie("username", "", time() - 10000);
setcookie("ProblemsCount", "", time() - 10000);
setcookie("prob", "", time() - 100000);

echo "<script type='text/javascript'>alert('Logout Succesful');</script>";
session_unset();
session_destroy();
header( "Refresh:0; url=index.php", true, 303);
exit();
?>