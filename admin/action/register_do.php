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
$pwd = md5($_POST['pwd'].$username);
if(empty($username)||empty($pwd)){
    die("用户名或密码不能为空");
}
$time = time();
$sql = "insert into admin_info(A_ID,A_UserName,A_Password,A_Tel,A_QQ,A_Email,A_Createtime,A_Status)values('','$username','$pwd',0,0,0,$time,0)";

$ret = $Conn::$pdo->query($sql);

if($ret){
    $_SESSION['user'] = $username;
    @$_SESSION['expire'] = time() + 1000;
}

header('Location:'.HTTP_PATH.PROJECT_NAME.'/index.php');

