<html>
<head>
    <title>SignUp Here</title>
    <link rel="stylesheet" href="signup.css">
   <link rel="icon" type="image/png" sizes="32*32" href="user.png">
</head>
<body onload="<?php $name=$username=$email=$hobbies=$password=$confirm_password=$msg="";?>" >
<?php
require_once("config.php");
require_once("functions.php");
//defining necessary variables
$name=$username=$email=$hobbies=$password=$confirm_password="";
$nameErr=$usernameErr=$hobbiesErr=$addressErr=$passwordErr=$confirm_passwordErr="";
$msg='';
//total no. of errors
$count=0;

//Submitting the form
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$name=test_input($_POST["name"]);
$username=test_input($_POST["username"]);
$email=test_input($_POST["email"]);
$hobbies=test_input($_POST["hobbies"]);
$password=test_input($_POST["password"]);
$confirm_password=test_input($_POST["confirm_password"]);
echo "biv";
if(empty($name) or ($name=""))
{ $nameErr="*Name is required"; $count++;}
else
{ $name=test_input($_POST["name"]);
if(!preg_match("/^[a-zA-Z ]*$/",$name))
	{$nameErr="*Only letters allowed"; $count++;}
}

if (empty($username) or ($username=""))
{ $usernameErr="*Username is required";
$count++;}
else
{
$username=test_input($_POST["username"]);

//checking username existence

$query="Select * from users where username='$username'";
$result=$conn->query($query);

if ($result->num_rows > 0)
{$usernameErr="*Username taken";
$count++;}
}

if(empty($email))
{ $emailErr="*Email is required";}
else
{
$email=test_input($_POST["email"]);
//checking email existence
$query="Select * from users where email='$email'";
$result=$conn->query($query);

if ($result->num_rows > 0)
{$emailErr="*Email already exists";
$count++;}

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
 { $emailErr = "*Invalid email format";
$count++;}
}


if(empty($password))
{ $passwordErr="*Password is required ";
$count++;}
else
{$password=$_POST["password"];}

if(empty($confirm_password))
{
$confirm_passwordErr="*Password must match";
$count++;}
else
{
$confirm_password=$_POST["confirm_password"];

if($confirm_password != $password)
$confirm_passwordErr="*Password Don't match";
}

if ($count == 0)
{

$query="Insert into users (name,email,username,password,hobbies) Values ('$name','$email','$username','$password','$hobbies')";

if ($conn->query($query))
{
//header('Location: login.php?message=$msg');
$color="#355c7d";
$msg="Your account has been created successfully!!";
$name=$username=$email=$hobbies=$password=$confirm_password="";
header('Location: login.php?message='.$msg);
}

else
$msg= "Something Went Wrong in database!!,Please try again later";
}
else
$msg= "Something Went Wrong!!,Please try again later";
}
?>
//HTML Components
    <div id="top-nav-box">
    <div id="home">
        <a href="home.html"><img src="home.png" title="Go to Home" id="homeimg" style="margin-left:10px;"></a>
    </div>
     <a href="login.php" style="float: right;margin-right: 20px;margin-top:-15px;"><button   id="button1">Login</button></a>
   </div>
    <div id="container">
 <?php
if ($msg!='')
{
$color="red";
echo "<center><div style='font-size:30px;margin-bottom:20px;color:".$color.";padding-top:15px;'>";
echo $msg;
echo '</div></center>';
}
?>
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
    <td><input type="text"  id="t1" name="name" placeholder="Enter your full name" value="<?php echo $name; ?>"<span class="error-txt"><?php echo $nameErr; ?></span>
    </td>
    </tr>
    <tr>
    <td><label>Email:</label>
    <td><input  type="text" id="t2" name="email" required placeholder="Enter your email address" value="<?php echo $email; ?>"><span class="error-txt"><?php echo $emailErr; ?></span></td>
    </tr>
    <tr>
    <td><label>Username:</label></td>
    <td><input type="text"  id="t1" name="username" placeholder="Enter an username " value="<?php echo $username; ?>"><span class="error-txt"><?php echo $usernameErr; ?></span></td>
    </tr>
    <tr>
    <td><label>Enter Password:</label></td>
    <td><input  type="password"  id="p1" name="password" placeholder="Enter a password" value="<?php echo $_POST['password']; ?>" ><span class="error-txt"><?php echo $passwordErr; ?></span></td>
    </tr>
    <tr>
    <td><label>Confirm Password:</label></td>
    <td><input type="password"  id="p2" name="confirm_password" placeholder="Retype your password here" value="<?php echo $_POST['confirm_password']; ?>"><span class="error-txt"><?php echo $confirm_passwordErr; ?></span></td>
    </tr>
    <tr>
    <td> <label>Hobbies(Optional):</label></td>
    <td> <textarea cols="35" rows="3" name="hobbies" placeholder="Enter details here"></textarea></td>
    </tr>
    </table>
    <br>
            <center><input type="reset" name="reset"  value="Reset" class="b1" /><center>
            <center><input type="submit" class="b2" value="Sign Up"></center>
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
