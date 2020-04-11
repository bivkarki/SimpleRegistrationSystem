<html>
<head>
<title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
   <link rel="icon" type="image/png" sizes="32*32" href="user.png">
</head>
<body>
<?php
 session_start();
 require_once("config.php");
 require_once("functions.php");
   //Check if the user is not logged in
    if(!isset($_SESSION['id'])){ //if not logged in
	$msg="You must login with your account to access Profile!!";
        header("Location: login.php?message=".$msg);
    }

    //Define variables and set them to empty values
    $name = $username = $email = $hobbies = $created_at = '';

    // define id variable and set to session value
    $id = $_SESSION['id'];

    $msg = '';

    //Submitting the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Delete account
        $del_query = "DELETE FROM users WHERE id = '$id'";

        if ($conn->query($del_query)) {
            $msg = "You account has been deleted";
            //Unset and delete the user information
            session_unset();
            session_destroy();
            header("Location: login.php?message=$msg");
            exit();
        }
    else {
            echo "Error deleting record: " . $conn->error;
        }
    }//End of IF
?>
<div id="top-nav-box">
    <div id="home">
        <a href="home.html"><img src="home.png" title="Go to Home" id="homeimg" style="margin-left:10px;"></a>
    </div>
<a href="registration.php" style="float: right;margin-right: 20px;margin-top:-15px;"><button   id="b2">Sign Up</button></a>
     <a href="logout.php" style="float: right;margin-right: 20px;margin-top:-15px;"><button   id="b2">Log Out</button></a>
</div>
<div class="block-heading">
<br>
<center> <h2 style="color:green;font-size:30px;">Profile Information</h2>
<p>Here you can view your profile information and you can also edit them</p>
</center>
<?php
if (isset($_GET['message']))
{
echo '<hr>';
echo '<div class="alert alert-success" role="alert">';
echo  $_GET['message'];
echo '</div>';
}
?>
</div>
<center>
<div id="info">
<?php
$query = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($query);
if ($result->num_rows > 0)
{
// output data of each row
$row = $result->fetch_assoc();
$name = $row['name'];
$username = $row['username'];
$email = $row['email'];
$hobbies = $row['hobbies'];
if($row["hobbies"]=="")
$hobbies="Not Provided";
$created_at = $row['created_at'];
}
else
echo "0 results";
?>
<div id="profile_pic">
<img id="dp" src="user.png" alt="User Image"/>
</div>
<div id="data">
<h3><?php echo ucwords($name); ?>
</h3>
<hr>
<p>Username: <strong><?php echo $username; ?></strong></p>
<p>Email: <strong><?php echo $email; ?></strong>&nbsp;</p>
<p>Hobbies: <strong><?php echo $hobbies; ?></strong>&nbsp;</p>
<hr>
<p>Member Since: <strong><?php echo $created_at; ?></strong></p>
</div>
</div>

<br>
<form id="form1" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<button type="submit" title="Are you Sure?" form="form1" value="Submit" id="delete"><img src="delete.png" class="icon"/> Delete Account </button>
</form>
</center>
<p>
<h2><b>NOTE:</b></h2>Feature to add profile image is in progress! Please bear with us,Thank you :)
</P>
</body>
</html>
