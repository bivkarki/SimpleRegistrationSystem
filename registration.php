<html>
<body>
<?php
require_once("config.php");
require_once("functions.php");
//defining necessary variables
$name=$username=$email=$address=$password=$confirm_password="";
$nameErr=$usernameErr=$emailErr=$addressErr=$passwordErr=$confirm_passwordErr="";
$msg='';
//total no. of errors
$count=0;

//Submitting the form
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$name=test_input($_POST["name"]);
$username=test_input($_POST["username"]);
$email=test_input($_POST["email"]);
$address=test_input($_POST["address"]);
$password=test_input($_POST["password"]);
$confirm_password=test_input($_POST["confirm_password"]);

if(empty($name))
{ $nameErr="Name is required"; $count++;}
else
{ $name=test_input($_POST["name"]);
if(!preg_match("/^[a-zA-Z ]*$/",$name))
	{$nameErr="Only letters and whitespace allowed"; $count++;}
}

if (empty($username))
{ $usernameErr="Username is required";
$count++;}
else{$username=test_input($_POST["username"]);}

//checking username existence

$query="Select * from users where username='$username'";
$result=$conn->query($query);

if ($result->num_rows > 0)
{$usernameErr="Username already exists in database";
$count++;}
}

if(empty($email))
{ $emailErr="Email is required";}
else
{
$email=test_input($_POST["email"]);
//checking email existence
$query="Select * from users where email='$email'";
$result=$conn->query($query);

if ($result->num_rows > 0)
{$emailErr="Email already exists in database";
$count++;}

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
 { $emailErr = "Invalid email format";
$count++;}
}


if(empty($_POST["password"]))
{ $passwordErr="Password is required";}
else
{$password=test_input($_POST["password"]);}

if(empty($_POST["confirm_password"]))
{ $confirm_passwordErr="You need to confirm your password";}
else
{
$confirm_password=test_input($_POST["confirm_password"]);

if($confirm_password != $password)
$confirm_passwordErr="Password Doesn't match";
}

if ($count == 0)
{
//Generating the reset_code for user
$reset_code=md5(crypt(rand(),'aa'));

$query="Insert into users (name,email,username,password,address,reset_code,is_active) Values ('$name','$email','$username','$password','$address','$reset_code',0)";

if ($conn->query($query))
{
echo "New Record Created SuccessFully!";
$msg="Your account has been created successfully. Click <a href='https://mail.google.com' target='external' >Here	</a>";
$message="You have been registered syccessfully.Click the link below to verify your account:<br><br><a href='account_verify.php?code=$reset_code'>Click to Verify</a>";

//sending email to user
//send_mail($email,$message);
$name=$username=$email=$address=$password=$confirm_password="";
}
else
//echo "Error: ".$query."<br>".$conn->connect_error;
echo "Something Went Wrong!!";
}


?>
<?php
if ($msg!='')
{echo '<div>';
echo $msg;
echo '</div>';
}
?>
<div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
    <div> Name:<input type="text" name="name"><span class="error-txt"><?php echo $nameErr; ?></span></div>
    <div> Email<input type="text" name="email"><span class="error-txt"><?php echo $emailErr; ?></span></div>
    <div> Username<input type="text" name="username"><span class="error-txt"><?php echo $usernameErr; ?></span></div>
    <div> Address:<input type="text" name="address"><span class="error-txt">(optional)</span></div>
    <div> Password:<input type="password" name="password"><span class="error-txt"><?php echo $passwordErr; ?></span></div>
    <div> Confirm Password: <input type="password" name="confirm_password"><span class="error-txt"><?php echo $confirm_passwordErr; ?></span></div>
    <br>
    <button type="submit">Sign Up</button>
</form>
</body>
</html>
