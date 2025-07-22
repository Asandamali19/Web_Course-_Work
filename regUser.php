<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}
include("conn.php");

if(isset($_POST['submit'])){
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $full_name = $_POST['fullname'];
    $gender = $_POST['gender'];
    $DOB = $_POST['dob'];
    $email = $_POST['email'];
    $phoneno = $_POST['phone'];
    $addLine1 = $_POST['AddL1'];
    $addLine2 = $_POST['AddL2'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];

    $sql = "INSERT INTO users (userName, password, full_name, gender, DOB, email, phone, add_line_1, add_line_2, city, zipcode)
     VALUES ('$username','$password','$full_name','$gender','$DOB','$email','$phoneno','$addLine1','$addLine2','$city','$zipcode')";

     if(mysqli_query($conn, $sql)){
        echo "<script>
         alert('New Record created successfully 👌');
         window.location.href = 'registeruser.html';
         </script>";
     }
     else {
    echo "<script>
        alert('Something went wrong, please try again 👀');
        console.log('Error: " . addslashes($sql) . " - " . addslashes(mysqli_error($conn)) . "');
        window.location.href = 'registeruser.html';
    </script>";
}

}
else{
    echo "No data recived".$sql."<br>". mysqli_error($conn);
}


mysqli_close($conn);

?>