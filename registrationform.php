<?php
include_once 'header.php';
?>
		<script type="text/javascript">
			function validate(form)
			{
				console.log('www');
				fail  = validateUsername(form.username.value)
				fail += validatePassword(form.password.value)
				fail += validateAge(form.age.value)
				fail += validateEmail(form.email.value)
				fail += validateAddress(form.address.value)
				fail += validateCountry(form.country.value)
				if (fail == "") return true
				else { alert(fail); return false }
			}
			function validateUsername(field) {
				if (field == "") return "No Username was entered\n"
				else if (field.length < 5)
					return "Usernames must be at least 5 characters\n"
				else if (/[^a-zA-Z0-9_-]/.test(field))
					return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames\n"
				return ""
			}
			function validatePassword(field) {
				if (field == "") return "No Password was entered\n"
				else if (field.length < 6)
					return "Passwords must be at least 6 characters\n"
				else if (!/[a-z]/.test(field) ||
				! /[A-Z]/.test(field) || ! /[0-9]/.test(field))
					return "Passwords require one each of a-z, A-Z and 0-9\n"
				return ""
			}
			function validateAge(field) {
				if (isNaN(field)) return "No Age was entered\n"
				else if (field < 18 || field > 110)
					return "Age must be between 18 and 110\n"
				return ""
			}
			function validateEmail(field) {
				chck="/\S+@\S+\.\S+/"
				if (field == "") return "No Email was entered\n"
				else if (!((field.indexOf(".") > 0)
					&&(field.indexOf("@") > 0)) ||field.match(chck))
					return "The Email address is invalid\n"
				return ""
			}
			function validateAddress(field) {
				if (field == "") return "No Address was entered\n"
				return ""
			}
			function validateCountry(field) {
				if (field == "") return "No Country was entered\n"
				return ""
			}

		</script>
		<table>
			<tr><th colspan="2" align="center">Registration Form</th></tr>
			<form method="post" action="registration.php" onSubmit="return validate(this)">
			<tr><td><label>Username</label></td>
			<td><input type="text" maxlength="32"  name="username" /></td></tr>
			<tr><td><label>Password</label></td>
			<td><input type="text" maxlength="12" name="password" /></td></tr>
			<tr><td><label>Age</label></td>
			<td><input type="text" maxlength="3"  name="age"  /></td></tr>
			<tr><td><label>Email</label></td>
			<td><input type="text" maxlength="64"    name="email"  /></td></tr>
			<tr><td><label>Address</label></td>
			<td><input type="text" maxlength="16" name="address"  /></td></tr>
			<tr><td><label>Country</label></td>
			<td><select name="country">
				<option value="">Select</option>
				<option value="uk">United Kingdom </option>
				<option value="usa">United States</option>
				<option value="europe">Europe</option>
			</select></td></tr>
			<tr><td><label>Contact No</label></td>
			<td><input type="text" maxlength="16" name="contactno"  /></td></tr>
			<tr><td colspan="2" align="center"> 
			<input type="submit" value="Register" /></td></tr>
			</form>
		</table>
<?php
include_once 'footer.php';
?>