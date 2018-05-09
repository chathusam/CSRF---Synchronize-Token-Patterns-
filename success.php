  <!DOCTYPE html>
   <html>
   <head>
<?php
 session_start();

?>
     <title></title>
   </head>
   <body>

	<script> alert('Successful: Tokens Matched') </script>
      
    <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
    <table>
    <tr><td>First Name:</td><td><input type="text" name="fname"/></td></tr>
    <tr><td>Last Name:</td><td><input type="text" name="lname"/></td></tr>
    </table>
    </br>
    <input type="hidden" name="csrf_token" value="<?=$csrf_to;?>">
    <input type="submit" name="subm" value="submit"/>
    </form>

   </body>
   </html>
