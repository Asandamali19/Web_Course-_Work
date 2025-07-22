<?php

include("conn.php");

$id = $_GET["id"];

$sql = "SELECT * FROM users WHERE userid = $id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])){

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

    $update_sql = "UPDATE users SET
    userName = '$username',
    password = '$password',
    full_name = '$full_name',
    gender ='$gender',
    DOB ='$DOB',
    email ='$email',
    phone ='$phoneno',
    add_line_1 ='$addLine1',
    add_line_2 ='$addLine2',
    city ='$city',
    zipcode ='$zipcode' WHERE userid =$id";

    $result = mysqli_query($conn, $update_sql);

    if ($result === TRUE) {
        echo "Your data has been updated successfully!";
        header("Location: profile.php");
        exit();

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$dobFormatted = '';
if (!empty($row['dob'])) {
    $dobFormatted = date('Y-m-d', strtotime($row['dob']));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejister User</title>
    <link rel="stylesheet" href="registeruser.css">
</head>
<body>
    <div class="register-wapper">
        <div class="navigation">
            <h2>BookFriends</h2>
            <ul>
                <li><a href="dashboard.php" >Home</a></li>
                <li><a href="registeruser.html"class="active">Registration Form</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>

        <div class="formBody">
             <form method="post">
                <fieldset>
                    <legend>User Information</legend>

                    <label for="userName">Username:</label><br>
                    <input type="text" id="userName" name="userName" value="<?php echo htmlspecialchars($row['userName']); ?>" required><br><br>

                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required><br><br>

                    <label for="confirm_password">Confirm Password:</label><br>
                    <input type="password" id="confirm_password" name="confirm_password" value="<?php echo htmlspecialchars($row['password']); ?>" required><br><br>

                    <label for="fullname">Full Name:</label><br>
                    <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($row['full_name']); ?>" required><br><br>

                    <label>Gender:</label><br>
                    <input type="radio" id="male" name="gender" value="Male" <?php if ($row['gender'] == 'Male') echo 'checked'; ?>>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="Female"<?php if ($row['gender'] == 'Female') echo 'checked'; ?>>
                    <label for="female">Female</label><br><br>

                    <label for="dob">Date of Birth:</label><br>
                    <!-- <input type="date" id="dob" name="dob"  value="<?php echo isset($row['dob']) ? htmlspecialchars(date('Y-m-d', strtotime($row['dob']))) : ''; ?>">"><br><br> -->
                    <!-- <input type="date" id="dob" name="dob" value="<?php echo isset($row['dob']) ? htmlspecialchars(date('Y-m-d', strtotime($row['dob']))) : ''; ?>"> -->
                   <input type="date" id="dob" name="dob" value="<?php echo $row['DOB']; ?>">

                    <label for="email">E-mail:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br><br>

                    <label for="phone">Phone Number:</label><br>
                    <input type="text" id="phone" name="phone" pattern="[0-9]{10}" placeholder="0771234567"value="<?php echo htmlspecialchars($row['phone']); ?>"><br><br>

                    <label for="AddL1">Address Line 1:</label><br>
                    <input type="text" id="AddL1" name="AddL1" value="<?php echo htmlspecialchars($row['add_line_1']); ?>" required><br><br>

                    <label for="AddL2">Address Line 2:</label><br>
                    <input type="text" id="AddL2" name="AddL2" value="<?php echo htmlspecialchars($row['add_line_2']); ?>"><br><br>

                    <label for="city">City:</label><br>
                    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($row['city']); ?>"><br><br>

                    <label for="zipcode">Zip Code:</label><br>
                    <input type="text" id="zipcode" name="zipcode" pattern="[0-9]{5}" placeholder="12345" value="<?php echo htmlspecialchars($row['zipcode']); ?>"><br><br>

                    <input type="submit" value="update" name="submit">
                </fieldset>
            </form>

        </div>
       
    </div>
    
</body>
</html>