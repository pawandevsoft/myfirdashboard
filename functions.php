<?php 
	function getCategoryName($conn,$id){
		//echo $id;
		$query = "SELECT * FROM category WHERE id = $id";
		//echo $query;die;
		$result = mysqli_query($conn,$query);
		//echo $result;die;
		$data = mysqli_fetch_assoc($result);
		return $data['name'];
		
	}
	function getAllCategory($conn){
		$query = "SELECT * FROM category";
		$result = mysqli_query($conn,$query);
		$data = array();

		while ($d = mysqli_fetch_assoc($result)) {
			$data[]=$d;
		}
		return $data;
		
	}
	function getimageName($conn,$post_id){
		$query = "SELECT * FROM images WHERE post_id = $post_id";
		$result = mysqli_query($conn,$query);
		$data = array();

		while ($d = mysqli_fetch_assoc($result)) {
			$data[]=$d;
		}
		return $data;
		
	}
	function getnavdropdown($conn,$menu_id){
		$query = "SELECT * FROM submenu WHERE parent_menu_id = $menu_id";
		$result = mysqli_query($conn,$query);
		$data = array();

		while ($d = mysqli_fetch_assoc($result)) {
			$data[]=$d;
		}
		return $data;
		
	}
	function getnavdropdownNO($conn,$menu_id){
		$query = "SELECT * FROM submenu WHERE parent_menu_id = $menu_id";
		$result = mysqli_query($conn,$query);
		return mysqli_num_rows($result);
		
	}
	function getComments($conn,$post_id){
		$query = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY id DESC";
		$result = mysqli_query($conn,$query);
		$data = array();

		while ($d = mysqli_fetch_assoc($result)) {
			$data[]=$d;
		}
		return $data;
		
	}
/*	function getAdminInfo($conn,$email){
		$query = "SELECT * FROM admin WHERE email = '$email'";
		$result = mysqli_query($conn,$query);
		
		$data = mysqli_fetch_assoc($result);
		return $data;
		
	}*/
 ?>