<?php
	session_start();
	$username = "";$password ="" ; $msg = "";
	if (isset($_POST["username"])) 
	{
		$username = $_POST["username"];
	}
	if (isset($_POST["password"])) 
	{
		$password = $_POST["password"];
	}
	if ($username!=""&&$password!="") 
	{
		$db = mysqli_connect("localhost","root","A12345678");
		mysqli_select_db($db,"alentest");
		$sql = "SELECT * FROM login WHERE username ='$username' AND 
				password = '$password'" ;
		$rows = mysqli_query($db,$sql) ;
		if (mysqli_fetch_row($rows)) 
		{
			header("location:success.php?username=".$username) ;
		}
		else
		{
			$msg .= "帳號密碼輸入錯誤" ;
		}

	}

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login</title>
	<style>
		.background{
			background-image: url('login.jpg');
			background-repeat: no-repeat;
			background-size: 2000px 1100px;
		}
		.login{
			width: 550px;
			height: 480px;
			background-color:white;
			/*opacity: 0.8; */
			margin-top: 150px;
			margin-left: auto;
			margin-right: auto;
			border-radius: 5%; 
			font-size: 28px;
		}
		.loginTitle{
			height: 100px;
			width: 400px;
			margin-left: auto;
			margin-right: auto;
			text-align: center;
			border-bottom: 1px solid black;
			padding: 15px;
			font-family: Cursive;
			font-size: 40px;
			color:red;
		}
		.loginForm{
			margin: 60px;
			margin-top: 20px;
			padding: 20px;
			padding-top: 0px;
			font-family: Cursive;
			font-size: 20px;
		}
		.form-group{
			margin-top: 20px;
		}
		.submit{
			
			float: right;
		}
	</style>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	function Vaildate()
	{
		var IdValue = document.forms["form"]["username"].value;
		var PasswordValue = document.forms["form"]["password"].value;

		var RegisterIdVaule =document.forms["registerForm"]["newusername"].value;
		var RegisterPasswordVaule =document.forms["registerForm"]["newpassword"].value;


		//登入驗證
		IsEmpty(IdValue);
		IsNotChiness(IdValue);
		IsNotSpecialChar(IdValue);

		IsEmpty(PasswordValue);
		IsNotChiness(PasswordValue);
		IsNotSpecialChar(PasswordValue);

		//註冊驗證
		IsEmpty(RegisterIdVaule);
		IsNotChiness(RegisterIdVaule);
		IsNotSpecialChar(RegisterIdVaule);

		IsEmpty(RegisterPasswordVaule);
		IsNotChiness(RegisterPasswordVaule);
		IsNotSpecialChar(RegisterPasswordVaule);



		
	
		return false;

	}

	//id不能為空值
	function IsEmpty(InputValue)
	{
		if(InputValue=="")
		{
			alert("值不能為空");
			return false ;
		}
	}
	//id不能為中文
	function IsNotChiness(InputValue)
	{
		for(var i=0;i<InputValue.length;i++)
		{
			if(InputValue.charCodeAt(i)>128)
			{
				alert('值不能為中文');
				return false ;
			}
		}
	}
	//id不能為特殊字元
	function IsNotSpecialChar(InputValue)
	{
		contain(InputValue,"!@#$%^&*()_+<,>.?/:;\"\'{}[]\"\'\\");

		function contain(InputValue,str)
		{
			for(var i=0;i<str.length;i++)
			{
				if (InputValue.indexOf(str.charAt(i))>=0)
				{
					alert('不能為特殊字元');
					break;
					// alert(IdValue.indexOf(str.charAt(i)));
				}
			}
		}
	}
	</script>
</head>
<body class="background">
	<div class="login">
		<div class="loginTitle">
			Login
		</div>
		<!-- 登入介面 -->
		<div class="loginForm">
			<form role="form" class="form-horizontal" action="" method="post" onsubmit="return Vaildate()" name="form">
				<div class="form-group">
					<label for="id">Id:</label>
				    <input type="text" class="form-control" id="id" placeholder="UserId" name="username" value="<?php echo 
				     $username ?>">
				</div>
				<div class="form-group">
				    <label for="pwd">Password:</label>
				    <input type="password" class="form-control" id="pwd" placeholder="Password" name="password">
				</div>
			  	<button type="submit" class="btn btn-primary submit " >Login</button>	
			</form>
			
			<!-- 註冊對話視窗 -->
			<button class="btn btn-danger" data-toggle="modal" data-target="#myRegister">立即註冊</button>
			
			<div id="myRegister" class="modal fade" role="dialog">
				<div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				    	<div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">註冊新帳號</h4>
					    </div>
					    <div class="modal-body loginForm">
					    	<form action="register.php" method="post" class="form-horizontal" name="registerForm" onsubmit="return Vaildate()">
					    		<div class="form-group">
									<label for="myRegisterId">Id:</label>
								    <input type="text" class="form-control" id="myRegisterId" placeholder="UserId" name="newusername">
								</div>
								<div class="form-group">
								    <label for="myRegisterPwd">Password:</label>
								    <input type="password" class="form-control" id="myRegisterPwd" placeholder="Password" name="newpassword">
								</div>
							  	<button type="submit" class="btn btn-primary submit form-group" >註冊</button>	
					    	</form>
					    </div>
					    <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					    </div>
				    </div>
			  	</div>
			</div>

			<div style="color: red"><?php echo $msg?></div>
		</div>
	</div>
</body>
</html>