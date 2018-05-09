

<?php
	session_start();

$cookie_name = "cookieUser";
$cookie_value = "new cookie";
$sessionID=session_id();

setcookie($cookie_name, $sessionID,time() + (86400 * 30), "/","localhost",false,true); // 86400 = 1 day

?>

<!DOCTYPE HTML>
<html>
<head>

<script>
	
	function SendRequest(method,url,htmlTag) 
	{
  		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function ()
			{
				if (xhttp.readyState == 4 && xhttp.status == 200)  //readyState == 4 : request finished and response is ready, status == 200 : "OK" 
				{
				console.log("CSRF Token"+this.responseText);
				document.getElementById(htmlTag).value = xhttp.responseText; //get the response as a string
				}
			};
		xhttp.open(method,url,true);
		xhttp.send();
	}
	
</script>
</head>

	<?php
		
		if (isset($_COOKIE[$cookie_name])) 
		{
			echo "<script>SendRequest('POST','csrf.php','cst');</script>";
		}


	if(!isset($_COOKIE[$cookie_name])) {
    
     	$msg = "Cookie is not Created";
		 echo "<script type='text/javascript'>alert('$msg')</script>";
	} 
	else {

     $msg = "Cookie Created";
	 echo "<script type='text/javascript'>alert('$msg')</script>";
	}
	
	

	?>
<body>
</br>

	<form method="POST" action="csrf.php">

		Username:<br/>
		<input type="text" placeholder="Enter Username" name="username" required>
		</br>

		Password:<br/>
		<input type="password" placeholder="Enter Password" name="password" required>
		
		<br/> <br/>

		<input type="hidden" id="cst" name="token" value="<?php echo $_SESSION['CSRF'];?>"> 

		<input type="submit" name="submit" value="submit"/>

		</form>

<div id="fb-root"></div>

<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="true">
	
</div>


<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

</body>
</html>