<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}
// echo "Welcome, " . $_SESSION['userid'] . "! Your ID is: " . $_SESSION['userid'];
include 'conn.php';

if (!isset($_SESSION['userid'])) {
    echo "User not logged in.";
    exit();
}

$user_id = (int) $_SESSION['userid'];

$sql = "SELECT * FROM users WHERE userid = $user_id"; 
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $user['userName']; ?>'s Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="profile-container">
        <div class="navigation">
            <h2>BookFriends</h2>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="registeruser.html">Registration Form</a></li>
                <li><a href="profile.php" class="active">Profile</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.html">Log out</a></li>
            </ul>
        </div>
        <div class="profile-tabel-container">
            <div class="profile-card">
            <h2>Hi , <?php echo $user['full_name']; ?></h2>
            <p>Username: <?php echo $user['userName']; ?></p>
            <p>Email:<?php echo $user['email']; ?></p>
            </div>
            <div class="users-list">
            <h2>All Users</h2>
            <input type="text" id="searchUser" placeholder="Search by username or full name" onkeyup= "filterUsers()">
            <table class="user-tabel" id="user-tabel">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address Line 1</th>
                    <th>Address Line 2</th>
                    <th>City</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                $all_users = $conn->query("SELECT * FROM users");
                while ($u = $all_users->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$u['userid']}</td>";
                    echo "<td>{$u['userName']}</td>";
                    echo "<td>{$u['full_name']}</td>";
                    echo "<td>{$u['gender']}</td>";
                    echo "<td>{$u['DOB']}</td>";
                    echo "<td>{$u['email']}</td>";
                    echo "<td>{$u['phone']}</td>";
                    echo "<td>{$u['add_line_1']}</td>";
                    echo "<td>{$u['add_line_2']}</td>";
                    echo "<td>{$u['city']}</td>";
                    echo '<td><button onclick="editUser(' . $u['userid'] . ')">Edit</button> </td>';
                    echo '<td><button onclick="deleteUser(' . $u['userid'] . ')">Delete</button></td>';
                    // echo '<td><button onclick="deleteUser(' . $u['userid'] . ')">Delete</button></td>';
                    echo "</tr>";
                }
                ?>
            </table>
         </div>

        </div>
        
    </div>

    <script>
        function filterUsers() {
        const input = document.getElementById("searchUser").value.toLowerCase();
        const rows = document.querySelectorAll("#user-tabel tr:not(:first-child)");

        rows.forEach(row => {
            const username = row.cells[1].textContent.toLowerCase();
            const fullname = row.cells[2].textContent.toLowerCase();
            row.style.display = (username.includes(input) || fullname.includes(input)) ? "" : "none";
    });}

    function editUser(userId) {
        console.log(userId);
        window.location.href = "editUser.php?id=" + userId;
    }


    function deleteUser(userId){
        // alert(userId);
        window.location.href = "deleteuser.php?id=" + userId;
    }
    </script>
</body>
</html>
