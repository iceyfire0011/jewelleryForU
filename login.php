<?php
include_once 'header.php';
?>
		<table class="login">
			<tr>
				<th colspan="2" align="center">Sign In Form</th>
			</tr>
			<form method="post" action="checklogin.php">
			<tr>
				<td><label>username</label></td>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td><label>Password</label></td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center"> 
					<input type="submit" value="Sign in" />
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"> 
					Please Sign in OR <br> <i> 
					<a href="registrationform.php">Register
				</td>
			</tr>
			</form>
		</table>
<?php
include_once 'footer.php';
?>