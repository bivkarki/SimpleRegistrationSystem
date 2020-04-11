<html>
<head>
<title>User Login
</title>
<link rel="icon" type="image/png"sizes="32*32" href="user.png">
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body onload="<?php $password=$msg="";?>">
<?php
session_start();
require_once("config.php");
require_once("functions.php");
//Check if we are already logged in to prevent redirections
if(isset($_SESSION['id'])){
        header("Location: profile.php");
}
    // define variables and set to empty values
    $username = $password = "";
    $count = 0;
    $msg ="";

    //Submitting the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);

        //Validating our username
        if (empty($username)) {
            $count++;}
	 else {
            $username = test_input($_POST["username"]);}

	//Validating our password
        if (empty($_POST["password"])) {
            $count++;
        } else {
            $password = test_input($_POST["password"]);}

        //Check if we are free of errors
        if($count == 0){
            //check if this user exists in the database
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($query);

            //if data matches
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                    //Check if passwords match
                    if($password==$row['password']) {
                        //Setting our SESSION variables
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['hobbies'] = $row['hobbies'];
                        $_SESSION['image'] = $row['image'];
                        $_SESSION['created_at'] = $row['created_at'];
                        header ("Location: profile.php");
                        exit(); }
                    else {
                        $msg = 'Wrong password. Please try again.';
                        $password = "";
                        $count++;}
                }

            else { 
                $msg = "There is no account with this username.";
                $count++;
            }
}    } // End of IF
?>
 <div id="top-nav-box">
    <div id="home">
        <a href="home.html"><img src="home.png" title="Go to Home" id="homeimg" style="margin-left:10px;"></a>
    </div>
<a href="registration.php" style="float: right;margin-right: 20px;margin-top:-15px;"><button   id="b2">Sign Up</button></a>
<a href="profile.php" style="float: right;margin-right: 20px;margin-top:-15px;"><button   id="b2">Profile</button></a>
   </div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<center>
<?php echo "<p style='color:#355c7d;font-size:25px;'>".$_GET["message"]."</p>";?> 
</center>
<center><h1><p>Please fill the credentials to login</p></h1></center>
   <div class="loginbox">
<legend><img src="user.png" alt="user" class="user"/></legend>
<h2>Login Here</h2>
<table>
<caption>
<?php
if($msg != ''){
echo "<img src='error.png' style='background:rgba(230, 230, 230,0.001);height: 40px;width:50px;' alt='error:'>";
echo "<p style='color:red;font-size:20px;'>". $msg."</p>";
}
?>
</caption>
<br>
<tr>
<td><label>Username:</label></td>
<td><input type="text" name="username" placeholder="Enter your username here..." required maxlength="20" autofocus id="p1" value="<?php echo $username; ?>"></td>
</tr>
<tr>
<td><label>Password:</label>
</td>
<td>
<input type="password" name="password" placeholder="Enter Password" value="<?php echo $password;?>" required  maxlength="22" autofocus id="p2" ></td>
</tr>
</table>
<br>
</form>
<br><br>
        <center><button class="b1" type="submit">Log In</button></center>
        <br><br>
        <center><a  href="registration.php">Not an User? Signup here</a>  </center>
        </div>
</body>

</html>
