<?php
require_once('db.php');

// routes
if(isset($_GET['f'])){
	if($_GET['f']=='login') login();
	if($_GET['f']=='register') register();
	if($_GET['f']=='getRestaurants') getRestaurants();
	if($_GET['f']=='search') search();
	if($_GET['f']=='add') add();

}

//functions here after


function login(){
	global $conn;
	$email = $_POST['email'];
	$pw = $_POST['password'];

	$sql = "SELECT * FROM `users` WHERE `email` = '".$email."' AND `password` = '".md5($pw)."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			setcookie('uid', $row['id'], time() + (86400 * 30), "/"); // 86400 = 1 day
			header('location: index.php');
		}
	} else {
		header('location: login.php?m=Wrong Password');
	}

}

function register(){
	global $conn;
	$email = $_POST['email'];
	$pw = $_POST['password'];

	$sql = "INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, '".$email."', MD5('".$pw."'));";
	$result = $conn->query($sql);
	header('location: login.php?m=User created. You may now login');
}

function getRestaurants(){
	global $conn;
	$response = '[';
	$sql = "SELECT * FROM `restaurants`";
	// SELECT * FROM `restaurants` WHERE `name` LIKE '%a%'
	if(isset($_GET['search'])) $sql = "SELECT * FROM `restaurants` WHERE `name` LIKE '%".$_GET['search']."%'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$response.='{';
			$response.='"id":"'.$row['id'].'",';
			$response.='"name":"'.$row['name'].'",';
			$response.='"location":"'.$row['location'].'",';
			$response.='"picture":"'.$row['picture'].'",';
			$response.='"price":"'.$row['price'].'"';
			$response.='},';
		}
	} else {
		$response .= '{"status": "No Restaurants Found"}';
	}
	$response.=']';
	$response = str_replace("},]","}]", $response);
	echo $response;
}

function search(){
	$search = $_POST['search'];
	header('location: index.php?search='.$search);
}

function add(){
	global $conn;
	$name = $_POST['name'];
	$location = $_POST['location'];
	$type = $_POST['type'];
	$price = $_POST['price'];
	$picture = $_POST['picture'];

	$sql = "INSERT INTO `restaurants` (`id`, `name`, `location`, `tags`, `price`, `picture`) VALUES (NULL, '".$name."', '".$location."', '".$type."', '".$price."', '".$picture."');";
	// INSERT INTO `restaurants` (`id`, `name`, `location`, `tags`, `price`, `picture`) VALUES (NULL, 'Le Chef at The Manor', 'Camp John Hay', '[\'fine dining\']', '4', 'le-chef-at-the-manor.jpg'), (NULL, 'Good Taste Cafe & Restaurant', 'City Proper', '[\'Local Cuisine\']', '2', 'photo8jpg.jpg');

	$result = $conn->query($sql);
	header('location: index.php');
}


?>