<?php
    require_once 'AdminService.class.php';
    
    //接收用户数据->根据用户表单来设置接收方式
    $id=$_POST['id'];
    $password=$_POST['password'];
    
    //实例化一个AdminService方法
    $adminService=new AdminService();
    $name=$adminService->checkAdimn($id, $password);
    if ($name!="")  {
        //合法
        //查询成功时跳转到empmanage.php
         //include 'empManage.php?';
        header("Location:empmanage.php?name=$name");
        exit();
    }else {
        //非法
        //返回重新登录
        include 'login.php?error=1';
        exit();
    }
    
?>




