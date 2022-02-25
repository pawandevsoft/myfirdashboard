<?php 
//print_r($_REQUEST);die;
//print_r($_POST);
include "db.php";
if(isset($_POST['addcomment'])){

$name = mysqli_real_escape_string($conn, $_POST['name']);
$comments = mysqli_real_escape_string($conn, $_POST['comment']);
$post_id = $_POST['post_id'];
//echo "hello";die;
$comment_insert= "INSERT INTO `comments`(`name`, `comment` ,`post_id`) VALUES ('$name','$comments','$post_id')";
if(mysqli_query($conn, $comment_insert)){
	header("location:single_post.php?id=$post_id");
}else{
	echo "Error". mysqli_error($conn);
}
}
 ?>