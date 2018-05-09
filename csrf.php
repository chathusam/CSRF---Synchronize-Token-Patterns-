
<?php

//start session
session_start();

//create a key for hash_hmac function
if (empty($_SESSION['key'])) 
{

    $_SESSION['key'] = base64_encode(openssl_random_pseudo_bytes(32));
}


//create CSRF token
	$csrf_to = hash_hmac('sha256', 'this is some string: csrf.php', $_SESSION['key']);

//store csrf token in session id
	$_SESSION['CSRF'] = $csrf_to;
  echo $csrf_to;

  
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		header("Location: success.php");
	}

  if (isset($_POST['submit']))
      {
          ob_end_clean();
          validation($_POST['token'],$_COOKIE['cookieUser'],$_POST['username'],$_POST['password']);
      }  
	
   //validate login & tokens
   		function validation($user_token,$user_sessionID,$user_name,$pwd)
   		{
   		if ( $user_sessionID ==session_id() && $user_name="user1" && $pwd="123") 
   		{
			   if (hash_equals($_SESSION['CSRF'], $user_token)) 
			     {
          	echo "<script> alert('Successful: Tokens Matched')</script>";
			      echo $_SESSION['CSRF']; echo " ";
			      echo $user_token;
          	$_SESSION['loggedin'] = true;	
          		//apc_delete('csrfs');
   			    }
   			else
   			{
          	$msg = "UnSuccessful: Tokens do not Match";
      			echo "<script type='text/javascript'>alert('$msg')</script>";
   			}
			}
			else
			{
			$msg = "UnSuccessful";
      			echo "<script type='text/javascript'>alert('$msg')</script>";
			}
   		}


	?>


