<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將session清空
$msg="" ;
$file = "message2.html" ;
$username = $_SESSION["username"];
$msg .="<p>使用者:". $username ."登出</p>" ;
$fp = fopen($file, "a+");
fwrite($fp, $msg);
fclose($fp);
session_destroy();
echo '登出中......';

echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
?>