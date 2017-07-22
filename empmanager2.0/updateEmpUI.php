<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
</head>

<?php 
    require_once 'EmpService.class.php';
    
    //该页面要显示准备修改的用户信息
    $id=$_GET['id'];
    
    //通过id来得到该用户的其他信息

    $empService=new EmpService();
    //$empService->getEmpById($id);
    $emp=$empService->getEmpById($id);
    //显示信息
?>

<h1>修改雇员</h1>
<form action="empProcess.php" method="post">
<table>
<tr><td>id号</td><td><input readonly="readonly" type="text" name="id" value="<?php echo $emp->getId();?>"/></td></tr>
<tr><td>名字</td><td><input type="text" name="name" value="<?php echo $emp->getName();?>"/></td></tr>
<tr><td>级别</td><td><input type="text" name="grade" value="<?php echo $emp->getGrade();?>"/></td></tr>
<tr><td>电邮</td><td><input type="text" name="email" value="<?php echo $emp->getEmail();?>"/></td></tr>
<tr><td>薪水</td><td><input type="text" name="salary" value="<?php echo $emp->getSalary();?>"/></td></tr>
<tr><td><input type="submit" value="修改用户"/></td><td><input type="reset" value="重新填写"/></td></tr>

<!-- 向empProcess.php发送修改用户的请求 -->
<input type="hidden" name="flag"value="updateEmp">;
</table>
</form>
</html>