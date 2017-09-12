<?php
session_start();
if (!isset($_SESSION['username'])) {
	exit("<a href='index.html'>请先登录或注册一个！</a>");
}else {
	$username=$_SESSION['username'];
	echo "个人主页<br>";
	echo "welcome:" . $username;
	echo "<br><a href='logout.php'>退出</a>";
}
?>