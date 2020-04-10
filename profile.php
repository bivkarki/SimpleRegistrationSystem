<?php 
 session_start();
 require_once 'config.php';
 require_once 'functions.php';
   //Check if the user is not logged in
    if(!isset($_SESSION['id'])){ //if not logged in
        header("Location: login.php");
    }

    //Define variables and set them to empty values
    $name = $username = $email = $website = $created_at = '';

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
<a class="nav-link active" href="profile.php">Profile</a>
<a href="logout.php">Logout</a>
 <div class="block-heading">
                    <h2 class="text-info">Profile Information</h2>
                    <p>Here you can view your profile information and you can also edit them</p>
                    <?php
                        if (isset($_GET['message'])){
                            echo '<hr>';
                            echo '<div class="alert alert-success" role="alert">';
                            echo  $_GET['message'];
                            echo '</div>';
                        }
                    ?>
</div>
<div class="row">
<div class="col-md-6">
                        <?php
                            $sql = "SELECT image FROM users WHERE id = '$id'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $image = $row['image'];
                                if ($image == ''){
                                    echo '<div class="image-box">';
                                    echo    '<div class="img" style="background-image: url(&quot;images/profile.jpg&quot;);"></div>';
                                    echo '</div>';
                                } else {
                                    echo '<div class="image-box">';
                                    echo    '<div class="img" style="background-image: url(&quot;images/' . $image . '&quot;);"></div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "0 results";
                            }
                        ?>
 </div>
             <div class="col-md-6">
                        <?php
                            $sql = "SELECT * FROM users WHERE id = '$id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                $row = $result->fetch_assoc();
                                $name = $row['name'];
                                $username = $row['username'];
                                $email = $row['email'];
                                $website = $row['website'];
                                $created_at = $row['created_at'];
                            } else {
                                echo "0 results";
                            }
                        ?>
                        <h3><?php echo $name; ?></h3>
                        <hr>
                        <div class="getting-started-info">
                            <p>Username: <strong><?php echo $username; ?></strong></p>
                            <p>Email: <strong><?php echo $email; ?></strong>&nbsp;</p>
                            <p>Website: <strong><?php echo $website; ?></strong>&nbsp;</p>
                        </div>
                        <hr>
                        <p>Created at: <strong><?php echo($created_at); ?></strong></p>
                        <hr>
                        <div class="row">
                            <div class="col text-left">
                                <div class="btn-group" role="group">
                                    <a class="btn btn-dark text-center border rounded shadow-lg d-xl-flex" role="button" href="upload_image.php" data-toggle="tooltip" data-placement="top" title="Upload new image">
                                        <i class="fa fa-file-picture-o d-xl-flex" style="margin-right: 0px;"></i>
                                    </a>
                                    <a class="btn btn-dark border rounded shadow-lg d-xl-flex" role="button" href="edit_profile.php" data-toggle="tooltip" data-placement="top" title="Edit profile">
                                        <i class="fa fa-edit d-xl-flex" style="margin-right: 0px;"></i>
                                    </a>
                                    <a class="btn btn-dark border rounded shadow-lg d-xl-flex" role="button" href="change_password.php" data-toggle="tooltip" data-placement="top" title="Change password">
                                        <i class="fa fa-unlock-alt d-xl-flex" style="margin-right: 0px;"></i>
                                    </a>
                                </div>
                                
                            </div>
                            <div class="col text-right">
                                <a class="btn btn-dark text-center border rounded shadow-lg " role="button" href="#" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-power-off d-xl-flex" style="margin-right: 0px;"></i>
                                </a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete your account</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        Do you really want to delete your account?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <form class="text-monospace" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                  <input type="submit" value='Yes' class="btn btn-primary">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
