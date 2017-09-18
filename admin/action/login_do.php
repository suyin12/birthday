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
$code = $_POST['code'];

$sql = "select A_ID,A_UserName from admin_info where `A_UserName`=  '".$username."' and `A_Password`= '".$pwd."'";

$ret = $Conn::$pdo->query($sql);
$res = $ret->fetchAll(PDO::FETCH_ASSOC);
if($_SESSION['verificationCode'] != $code){
    die('验证码输入错误!!');
}elseif(empty($res)){
    die('用户名或密码不正确!!');
}
if($res[0]){
    $_SESSION['user'] = $username;
    @$_SESSION['expire'] = time() + 1000;
}

echo HTTP_PATH.PROJECT_NAME.'/index.php';exit;
header('Location:'.HTTP_PATH.PROJECT_NAME.'/index.php');


