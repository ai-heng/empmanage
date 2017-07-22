<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>雇员信息列表</title>
<script type="text/javascript">
<!--

	function confirmDele(val){
		return window.confirm("是否要删除id="+val+"的用户");
	}
//-->
</script>
</head>
<?php

	require_once 'EmpService.class.php';
	require_once 'FenyePage.class.php';

	//创建一个FenyePage对象实例
	$fenyePage=new FenyePage();
	
	//给fenyePage指定必须的数据
	$fenyePage->pageNow=1;
	$fenyePage->pageSize=6;
	$fenyePage->gotoUrl="empList.php";
	
	
	//这里我们需要根据用户的点击来修改$pageNow这个值
	//这里我们需要判断 是否有这个pageNow发送，有就使用，
	//如果没有，则默认显示第一页
	if(!empty($_GET['pageNow'])){
		$fenyePage->pageNow=$_GET['pageNow'];
	}
	
	//创建empService对象实例
	$empService=new EmpService();
	//调用getEmpListByPage方法,该方法可以把fenyePage完成
	$empService->getFenyePage($fenyePage);
	
	//打印出表头信息
	echo "<table border='1px' bordercolor='green'  cellspacing='0px'  width='700px'>";
	echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>"; 
	
	//从数据库中取出具体信息
	for($i=0;$i<count($fenyePage->res_array);$i++){
		$row=$fenyePage->res_array[$i];
		//在每一行记录最后两列都有"删除用户"和"修改用户",通过flag标志向empProcess.php控制器发送删除和修改用户的指令
			echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td>".
		"<td><a onclick='return confirmDele({$row['id']})' href='empProcess.php?flag=del&id={$row['id']}'>删除用户</a></td><td><a href='updateEmpUI.php?id={$row['id']}'>修改用户</a></td></tr>"; 
	}
	
	//打印出表尾
	echo "<h1>雇员信息列表 </h1>";
	echo "</table>";
	
	
    //把导航栏封装起来	
	echo $fenyePage->navigate;
	
?>
    <!-- 指示跳转到某页 -->
	<form action="empList.php">
	跳转到:<input type="text" name="pageNow" />
	<input type="submit" value="GO">
	</form>
	<hr/>
</html>