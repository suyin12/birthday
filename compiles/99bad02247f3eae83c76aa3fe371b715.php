<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>登录</title>
</head>
<body>
<form name="" action="admin/action/login_do.php" method="post" >
    <table>
        <tr>
            <td colspan="2">系统登录</td>
        </tr>
        <tr>
            <td>用户名:</td>
            <td><input type="text" name="username" placeholder="请输入用户名"/></td>
        </tr>
        <tr>
            <td>密码:</td>
            <td><input type="password" name="pwd" placeholder="请输入密码"/></td>
        </tr>
        <tr>
            <td>验证码:</td>
            <td><input type="text" name="code" placeholder="请输入验证码"/><img src=""></td>
        </tr>
        <tr>
            <td><input type="submit" value="登录" /></td>
            <td><a href="#">注册</a><a href="#">忘记密码?</a></td>
        </tr>
    </table>
</form>
</body>
</html>