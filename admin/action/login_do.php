<?php
/**
 *
 * User: suyin
 * Date: 2017/8/11 13:43
 *
 */
require '../../setting.php';
require '../../lib/Tpl.class.php';
require '../../common/common.php';

session_start();
$msgTitle = '登录';
$jumpUrl = HTTP_PATH.PROJECT_NAME.'/login.php';

$username =  $_POST['username'];
$pwd = md5($_POST['pwd'].$username);
$code = trim(strtolower($_POST['code']));
$sessionCode = strtolower($_SESSION['verificationCode']);


$sql = "select A_ID,A_UserName from admin_info where `A_UserName`=  '".$username."' and `A_Password`= '".$pwd."'";

$ret = $Conn::$pdo->query($sql);
$res = $ret->fetchAll(PDO::FETCH_ASSOC);
if(strcmp($sessionCode,$code) !== 0){
    message($msgTitle,'验证码输入错误!',$jumpUrl);
}elseif(empty($res)){
    message($msgTitle,'用户名或密码不正确!',$jumpUrl);
}
if($res[0]){
    $_SESSION['user'] = $username;
    @$_SESSION['expire'] = time() + 1000;
}

header('Location:'.HTTP_PATH.PROJECT_NAME.'/index.php');


