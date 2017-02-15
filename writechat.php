<?php

session_start();
if (isset($_SESSION["username"])) 
{
	date_default_timezone_set("Asia/Taipei");
	$text = $_POST["text"] ;
	$date = date("H:i:s");
	$fp = fopen("message2.html", "a+");

	$msg ="<div class='message'><span class='name'>".$_SESSION["username"].":</span>".stripslashes(htmlspecialchars($text))."<span class='right'>".$date."</span></div>" ;
	fwrite($fp, $msg);
	fclose($fp);
}

?>	
