<?php
	
	$newusername = ""; $newpassword = ""; $msg="";
	if (isset($_POST["newusername"])) 
	{
		$newusername = $_POST["newusername"];
	}
	if (isset($_POST["newpassword"])) 
	{
		$newpassword = $_POST["newpassword"];
	}
	if ($newusername!=""&&$newpassword!="") 
	{
		$db = mysqli_connect("localhost","root","A12345678");
		mysqli_select_db($db,"alentest");
		$sql = "SELECT * FROM login WHERE username ='$newusername'";
		$rows = mysqli_query($db,$sql);
		if (mysqli_fetch_row($rows)) 
		{
			$msg .= "使用者帳號已存在";
		}
		else
		{
			$sql = "INSERT INTO login(username,password) VALUES('$newusername','$newpassword')" ;
			if (mysqli_query($db,$sql)) 
			{
				$msg .= "註冊成功" ;
			}
			else
			{
				$msg .= "註冊失敗" ;
			}
		}
		

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
		echo $msg;
	?>

<a href="login.php">回到登入頁面</a>
</body>
</html>