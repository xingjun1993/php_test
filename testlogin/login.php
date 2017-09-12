<?php
session_start();
if (!isset($_POST['submit'])) {
	exit('请先登录！');
}
$abc = mysqli_connect('localhost', 'root', '', 'website01') or die('Error connecting to MySQL');

$user_username = mysqli_real_escape_string($abc, trim($_POST['username']));

$user_password = mysqli_real_escape_string($abc, trim($_POST['password']));

$query = "SELECT username FROM user_list WHERE username = '$user_username' AND password = SHA('$user_password')";
$data = mysqli_query($abc, $query);

if (empty($user_username) || empty($user_password)) {
	echo 'Sorry, you must enter your username and password to log in.';
} elseif (mysqli_num_rows($data) !== 1) {
	echo 'Sorry, you must enter a valid username and password to log in.';
} else if (mysqli_num_rows($data) == 1) {

	$row = mysqli_fetch_array($data);

	$_SESSION['username'] = $row['username'];

	setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));
	echo 'success<br>';
	echo "<a href='my.php'>个人主页</a>";
}
?>