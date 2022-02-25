<?php
include "db.php"; 
	if(isset($_POST['addpost'])){
		/*print_r($_POST);
		echo "<pre>";
		print_r($_FILES);
		echo "<pre>";*/
	$ptitle = mysqli_real_escape_string($conn, $_POST['post_title']);
	$pcontent = mysqli_real_escape_string($conn, $_POST['post_content']);
	$cid = $_POST['post_category'];
	$query = "INSERT INTO `blog_article`(`articletitle`, `articlecontant`, `category_id`) VALUES ('$ptitle', '$pcontent', '$cid')";
	$run = mysqli_query($conn, $query);
	$post_id = mysqli_insert_id($conn);
	//echo $post_id;die;
	$image_name = $_FILES['post_image']['name'];
	$img_tmp = $_FILES['post_image']['tmp_name'];
	/*print_r($image_name);
	echo "<br>";
	print_r($img_tmp);*/
	foreach ($image_name as $index=>$img) {
		if(move_uploaded_file($img_tmp[$index], "images/$img" )){
			//echo "image uploaded<br>";
		$query = "INSERT INTO `images`(`post_id`, `image`) VALUES ('$post_id', '$img')";
		$run2 = mysqli_query($conn, $query);
		echo "<script>alert('add post successfully')</script>"
		header('location:dashboard.php');
		}
	}
	}
 ?>