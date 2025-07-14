<?php
include 'conn.php';
include 'function.php';

session_start();



if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$username = $_POST['username'];
	$password = $_POST['password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			$query = "select * from users where userName = '$username' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['userid'] = $user_data['userid'];
						header("Location: dashboard.php");
						exit();
					}
				}
			}

			 echo "<script>alert('Invalid username or password');window.location.href = 'login.html';</script>";

		}else
		{
           echo "<script>alert('Invalid username or password');window.location.href = 'login.html';</script>";

		}
	}

?>
