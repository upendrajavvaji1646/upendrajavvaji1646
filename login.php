
<?php
	session_start();
	require "conn.php";
	$error="";
	if(isset($_POST['User'])){
		$user=$_POST['User'];

		$sql="Select * from game where username='$user'";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			$_SESSION["username"]=$user;
			echo $_SESSION["username"];
			header("Location:index.php");
			$error="";
		}
		else{
			
			$a=[1,2,3,4];
			$array="";
			for($i=0;$i<5;$i+=1){
				$index=array_rand($a,1);
				 $array = $array . $a[$index];
			}
			$sql="insert into game values('$user','5','0','$array','0','0','NA')";
			$result=$conn->query($sql);
			if($result){
				$_SESSION["username"]=$user;
				header("Location:index.php");
			}
			// for($i=0;$i<5;$i++){
			// 	echo $array[$i]." ";
			// }
		}
	}

?>	

<html>
<head>
	<link rel="stylesheet" href="css/login.css">
</head>
<body>

	<div class="loginbox">
		<!-- <img src="images/avatar.jpg" class="avatar"> -->
			<h1>Login Here</h1>
				<form action="login.php" method="post">
                    <br><br>
					<p>Username</P>
					<input type="text" placeholder="Enter User Name" required="required" name="User">
					
                

					<p style="color:red"><?php 
						if($error==="1"){
							echo "Username Not Exits";
						}
					?></p>
					
					<br>
					
					<input type="submit" value="Login">
					<!-- <a href="index.html" >Back</a><br> -->
				</form>
	</div>

</body>
</html>