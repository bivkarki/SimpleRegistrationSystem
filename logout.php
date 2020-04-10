<?php
session_start();
session_unset(); //to free the seesion
session_destroy();
header('Location: login.php');

?>
