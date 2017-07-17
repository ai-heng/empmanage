<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
</head>
<h1>管理员登录系统</h1>
<form action="loginProcess.php" method="post">
<table>
<tr><td>用户id</td><td><input type="text" name="id"/></td></tr>
<tr><td>密&nbsp;码</td><td><input type="password" name="password"/></td></tr>
<tr>
<td><input type="submit" value="用户登录"/></td>
<td><input type="reset" value="重新填写"/></td>
</tr>
</table>
</form>
<?php 
    //接收error
    if (!empty($_GET['error']))  {
        //接收错误编号
        $error=$_GET['error'];
        if ($error==1)  {
            echo "<font color='red'size='3'>您的用户名或密码错误</font>";        
        }       
    }
?>
</html>