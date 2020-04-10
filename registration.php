<html>
<head>
    <title>SignUp Here</title>
    <script src="signup.js"></script>
    <link rel="stylesheet" href="signup.css">
   <link rel="icon" type="image/png" sizes="32*32" href="user.png">
</head>
<body onload="generate()">
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
<
</form>
//HTML Components
    < <div id="top-nav-box">
    <a href="home.html" ><button   id="button1">Home</button></a>
     <a href="login.html" style="float: right;margin-right: 20px;"><button   id="button1">Login</button></a>
   </div>
    <div id="container">
  <p><Marquee behavior="alternate"><span id="s1"style="color: white;font-weight: 800;font-size: 35px;margin-bottom: 10px;"> Welcome!! We are very delighted for having you here!
 </span></MArquee></p>
  <br>
<br>
    <div class="signupbox">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <img id="userimg" src="user.png" alt="user" />
    <center><h2 style="color:orange;">Signup Form</h2></center>
    <br>
    <table id="signup">
    <tr>
    <td><label>Name:</label></td>
    <td><input type="text"  id="t1" name="name" placeholder="Enter your full name"><span class="error-txt"><?php echo $nameErr; ?></span>
    </td>
    </tr>
    <tr>
    <td><label>Email:</label>
    <td><input  type="email" id="t2" name="email" placeholder="Enter your email address"><span class="error-txt"><?php echo $emailErr; ?></span></td>
    </tr>
    <tr>
    <td><label>Username:</label></td>
    <td><input type="text"  id="t1" name="username" placeholder="Enter an username "><span class="error-txt"><?php echo $usernameErr; ?></span></td>
    </tr>
    <tr>
    <td><label>Enter Password:</label></td>
    <td><input  type="password"  id="p1" name="password" placeholder="Enter a password" ><span class="error-txt"><?php echo $passwordErr; ?></span></td>
    </tr>
    <tr>
    <td><label>Confirm Password:</label></td>
    <td><input type="password"  id="p2" name="confirm_password" placeholder="Retype your password here"><span class="error-txt"><?php echo $confirm_passwordErr; ?></span></td>
    </tr>
    <tr>
    <td> <label>Address(Optional):</label></td>
    <td> <textarea cols="35" rows="3" name="address">Enter Your Details here..</textarea></td>
    </tr>
    <tr>
    <td><label>CAPTCHA:</label></td>
    <td> <div id="captcha" > </div> </td>
    </tr>
    <tr>
    <td> <label>Enter CAPTCHA:</label> </td>
    <td> <input type="text" name="captcha" id="cap" onfocus="res()" /></td>
    </tr> 
    <tr>
    <td> <label></label> </td>
    <td> <p name="msg" id="msg">CAPTCHA Entered is Incorrect!</p></td>
    </td>
    </tr>
    </table>
    <br>
            <center><input type="reset" name="reset" value="Reset" class="b1" /><center>
            <center><input type="submit" class="b2" onclick="validate()"  value="Sign Up"></center>
            <br>
            <center><h1>Already an User?</h1><a href="login.html"> Login here</a>  </center>
            <br>
    </div> 
    </form>
    </div>
    
</div>
</div>
</body>
</html>
