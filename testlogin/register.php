<?php
if (!isset($_POST['submit'])) {
	exit('请先注册！');
}
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

session_start();

if (!ctype_alnum($username)) {
	echo "<script type='text/javascript'>alert('用户名包含非法字符');</script>";
	echo "<script type='text/javascript'>history.back();</script>";
	exit;
	//echo '用户名包含非法字符';
	//echo "<br/><a href='register.html'>返回</a>";
} elseif (!(strlen($username) > 5 && strlen($username) < 13)) {
	echo "<script type='text/javascript'>alert('用户名长度不符合规范');</script>";
	echo "<script type='text/javascript'>history.back();</script>";
	exit;
	//echo '用户名长度不符合规范';
	//echo "<br/><a href='register.html'>返回</a>";
} elseif (!(@ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $email))) {
	echo "<script type='text/javascript'>alert('邮箱不合法');</script>";
	echo "<script type='text/javascript'>history.back();</script>";
	exit;
	//echo '邮箱不合法';
	//echo "<br/><a href='register.html'>返回</a>";
} elseif (!ctype_alnum($password)) {
	echo "<script type='text/javascript'>alert('密码包含非法字符');</script>";
	echo "<script type='text/javascript'>history.back();</script>";
	exit;
	//echo '密码包含非法字符';
	//echo "<br/><a href='register.html'>返回</a>";
} elseif (!(strlen($password) > 7 && strlen($password) < 17)) {
	echo "<script type='text/javascript'>alert('密码长度不符合规范');</script>";
	echo "<script type='text/javascript'>history.back();</script>";
	exit;
	//echo '密码长度不符合规范';
	//echo "<br/><a href='register.html'>返回</a>";
} elseif ($password !== $password2) {
	echo "<script type='text/javascript'>alert('两次密码输入不一致');</script>";
	echo "<script type='text/javascript'>history.back();</script>";
	exit;
	//echo '两次密码输入不一致';
	//echo "<br/><a href='register.html'>返回</a>";
} elseif (!(strtolower($_REQUEST['authcode']) == $_SESSION['authcode'])) {
	echo "<script type='text/javascript'>alert('验证码错误');</script>";
	echo "<script type='text/javascript'>history.back();</script>";
	exit;
	//echo "验证码不一致";
} else {
	$abc = mysqli_connect('localhost', 'root', '', 'website01') or die('Error connecting to MySQL');
	$query = "insert into user_list(username,email,password) VALUES ('$username','$email',SHA('$password'))";
	mysqli_query($abc, $query) or die('Error quering');
	mysqli_close($abc);
	echo "<br/><a href='my.php'>注册成功，点击进入主页</a>";
}
?>