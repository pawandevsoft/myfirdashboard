<?php 
session_start();

if(isset($_SESSION['UserLogedIn']) && !empty($_SESSION['UserLogedIn']))
{
	session_destroy();
	echo "<script>window.location.replace('login.php');</script>";
}
else
{
	echo "<script>alert('Something Error');</script>";
	echo "<script>window.location.replace('dashboard.php');</script>";		
}

?>