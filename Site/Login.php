<!-- include the connection here  -->
<?php
	include "Connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<!-- Link used -->
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Style -->
	<style type="text/css">
		@import "bourbon";

body {
	background-image: url(/Quinta_das_Flores/Site/css/image/ROM_3824.JPG);	
	background-position: center;
	background-attachment:fixed;
	background-size: 100%;
}

.wrapper {	
	
	margin-top: 80px;
 	margin-bottom: 80px;
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color: #fff;
  border: 1px solid rgba(0,0,0,0.1);  

  .form-signin-heading,
	.checkbox {
	  margin-bottom: 30px;
	}

	.checkbox {
	  font-weight: normal;
	}

	.form-control {
	  position: relative;
	  font-size: 16px;
	  height: auto;
	  padding: 10px;
		@include box-sizing(border-box);

		&:focus {
		  z-index: 2;
		}
	}

	input[type="text"] {
	  margin-bottom: -1px;
	  border-bottom-left-radius: 0;
	  border-bottom-right-radius: 0;
	}

	input[type="password"] {
	  margin-bottom: 20px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
}

	</style>
</head>
<body>
	<div class="wrapper">
    <form class="form-signin" action="#" method="POST">       
    	<h2 class="form-signin-heading">Please login</h2>
    	<input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
    	<input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
    	<label class="checkbox">
        	<input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
    	</label>
    	<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
		
		<img src="images/emDev.png" width="60px;" style="padding-top: 25px; display: block;margin:0 auto;">
	
	<!-- Validation login (change page)-->
	<?php
	if ($_POST) {
		$sql = "SELECT count(*) FROM account WHERE (email = :email OR password = :password) AND active = 1";
		$data = $conn->prepare($sql);
		$data->bindParam(":email" , $_POST['email'], PDO::PARAM_STR); //change the placeholders
		$data->bindParam(":password" , $_POST['password'], PDO::PARAM_STR); //change the placeholders
		$data->execute(); //play!

		if ($data->fetchColumn()==0) { //if no column come from SQL
			echo "<p style='color:red;font-weight:bolder;'>Wrong Password</p>";
		}
		else{
			header('location: /Quinta_das_Flores/Site/mainPage.php');
		}
	}
	?>
	</form>
  </div>
</body>
</html>

<?php
	include "footer.php";
?>

<script type="text/javascript">
	
	//wrong password ALERT
	function showAlert() {
		alert("Wrong Password.");
	}
</script>