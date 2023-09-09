<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: signin.php");
    exit;
} else {
    $id = $_SESSION["username"];
}

$db = mysqli_connect("localhost", "root", "", "blogtest");
// Check connection
if ($db === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pid = $_POST['pid'];
   

   
            $sql = "DELETE from post where id = '$pid'";
            // Execute query
            if (mysqli_query($db, $sql)) {
                header("Location: posts.php");
            } else {
                echo "Delete failed !!";
            }
          
    
}
