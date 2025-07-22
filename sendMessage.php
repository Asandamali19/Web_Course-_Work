<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}
include("conn.php");

if(isset($_POST['submit'])){
    $username = $_POST['userName'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO feedback (userName, email, message)
     VALUES ('$username','$email','$message')";

    if(mysqli_query($conn, $sql)){
        echo "<script>
         alert('Your message send successfully 👌');
         window.location.href = 'registeruser.html';
         </script>";
    }
    else {
        echo "<script>
            alert('Something went wrong, please try again 👀');
            window.location.href = 'registeruser.html';
        </script>";
    }
}
else{
    echo "No data recived";
}

mysqli_close($conn);
?>
