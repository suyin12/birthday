<?php
/**
 *
 * User: suyin
 * Date: 2017/8/11 13:43
 *
 */
require '../../setting.php';
require '../../lib/Tpl.class.php';

session_start();
$username =  $_POST['username'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];

if(empty($username)||empty($pwd)){
    die("用户名或密码不能为空!!");
}
if(strcmp($pwd,$pwd2) !== 0){
    die("输入的两次密码不一致!!");
}

$pwd = md5($pwd.$username);

$time = time();
$sql = "insert into admin_info(A_ID,A_UserName,A_Password,A_Tel,A_QQ,A_Email,A_Createtime,A_Status)values('','$username','$pwd',0,0,0,$time,0)";

$ret = $Conn::$pdo->query($sql);

if($ret){
    $_SESSION['user'] = $username;
    @$_SESSION['expire'] = time() + 1000;
}

header('Location:'.HTTP_PATH.PROJECT_NAME.'/index.php');


