<?php
	
	session_start();
	$username = "" ;$msg="";
	$file = "message2.html";
	if (isset($_SESSION['username'])) 
	{
		$username  = $_SESSION["username"]  ;
		$msg .="<p>使用者:". $username  ."登入</p>" ;
		$fp = fopen($file, "a+");
		fwrite($fp, $msg);
		fclose($fp); 	
	}
	else
	{
		header("location:login.php") ;
	}

	// if ($username!="") 
	// {
	// 	if ($username == "logout") 
	// 	{	
	// 		$name = $_SESSION["username"];
	// 		$msg .="<p>使用者:". $name ."登出</p>" ;
	// 		$fp = fopen($file, "a+");
	// 		fwrite($fp, $msg);
	// 		fclose($fp);
	// 		session_destroy();
	// 		header("location:login.php"); 
	// 	}
		

	// }
	

	

	


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="chatroom.css">
	<style>
		.background{
			background-image: url('login.jpg');
			background-repeat: no-repeat;
			background-size: 2000px 1100px;
		}
	</style>
	<script src="jquery-3.1.0.min.js"></script>

	<script>
		$(function(){

			$('form#chat-form').submit(function(e)
			{
				e.preventDefault();
				var chatmessage = $('#chatmessage').val();
				$.post("writechat.php",{text:chatmessage});
				$('#chatmessage').val('');
				return false ;
			}) ;

			function loadContent()
			{
				var OldHeight = $('#chatwindow').prop("scrollHeight")-20;

				$.ajax({
					url:"message2.html",
					cache:false,
					success:function(content){

						$('#chatwindow').html(content);
						var NewHeight = $('#chatwindow').prop("scrollHeight")-20;
						if (NewHeight>OldHeight) 
						{
							$('#chatwindow').animate({
								scrollTop:NewHeight
							},'slow');
						}

					}
				})
			}
			setInterval(loadContent,2000);


		})
		
	</script>
</head>
<body class="background">

<div id="chatmenu">
	
	<div id="chattitle">
		<p>歡迎使用者:<?php echo $username?></p>
		<a href="logout.php">登出</a>
	</div>

	<div id="chatwindow">
	
	</div>

	<div id="chatform">
		<form id="chat-form">
			<input type="text" id="chatmessage">
			<input type="submit" value="送出">
		</form>	
	</div>
</div>

</body>
</html>