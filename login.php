<html>
<head>
<title>User Login
</title>
<link rel="icon" type="image/png"sizes="32*32" href="user.png">
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<?php
session_start();
require_once 'config.php';
require_once 'functions.php';
//Check if we are already logged in to prevent redirections
if(isset($_SESSION['id'])){
        header("Location: profile.php");
}
    // define variables and set to empty values
    $username = $password = "";
    $usernameErr = $passwordErr = "";
    $count = 0;
    $msg = '';

    //Submitting the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);

        //Validating our username
        if (empty($username)) {
            $usernameErr = "Username is required";
            $count++;
        } else {
            $username = test_input($_POST["username"]);}
        //Validating our password
        if (empty($password)) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }
        //Check if we are free of errors
        if($count == 0){
            
            //check if this user exists in the database
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($query);
            
            //if data matches
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                    //Check if passwords match
echo $password;
echo $row["password"];
                    if($password==$row['password']) {
                        //Setting our SESSION variables
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['address'] = $row['address'];
                        $_SESSION['image'] = $row['image'];
                        $_SESSION['created_at'] = $row['created_at'];
                        header ("Location: profile.php");
                        exit(); } 
                    else {
                        $passwordErr = 'Wrong password. Please try again';
                        $password = "";
                        $count++;}
                }
            } 
            else {
                $msg = "There is no account with this username in the database";
                $username = $password = "";
                $count++;
            }
    } // End of IF
?>

<a  href="home.html">Home</a>
<a class="nav-link" href="registration.php">Register</a>
<a class="nav-link active" href="login.php">Login</a>
<div class="alert-box">
<?php
if($msg != ''){
echo '<hr>';
echo '<div class="alert alert-danger" role="alert">';
echo  $msg;
echo '</div>';
}
else if (isset($_GET['message'])){
echo '<hr>';
echo '<div class="alert alert-success" role="alert">';
echo  $_GET['message'];
echo '</div>';
}
?>
</div>
<form class="text-monospace" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<center><h1><p>Please fill the credentials to login</p></h1></center>
    <div class="loginbox">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<legend><img src="user.png" alt="user" class="user"/></legend>
<h2>Login Here</h2>
<table>
<tr>
<td><label>Username:</label></td>
<td><input type="text" name="username" placeholder="Enter your username here..." required maxlength="20" autofocus id="p1"></td>
</tr>
<tr>
<td><label>Password:</label>
</td>
<td>
<input type="password" name="password" placeholder="*********" required  maxlength="22" autofocus id="p2" ></td>
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
