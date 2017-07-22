<?php

	require_once 'SqlHelper.class.php';
	
	//该类是一个业务逻辑处理类,主要完成对admin表操作
	class AdminService{		
		//提供一个验证用户是否合法 的方法
		public function  checkAdimn($id,$password){
			
			$sql="select password,name from admin where id=$id";
			//创建一个SqlHelper对象
			$sqlHelper=new SqlHelper();
			//调用函数
			$res=$sqlHelper->execute_dql($sql);
			if($row=mysqli_fetch_assoc($res)){
				//比对密码
				if(md5($password)==$row['password']){
					return $row['name'];
				}
			}
			//资源
			mysql_free_result($res);
			//关闭连接 
			$sqlHelper->close_connect();
			return "";
		}
		
	}
?>