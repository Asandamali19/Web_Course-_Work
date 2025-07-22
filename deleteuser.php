<?php
include("conn.php");

if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    $sql = "DELETE FROM users WHERE userid = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Record deleted successfully";
        header("Location: profile.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No ID provided.";
}
?>
