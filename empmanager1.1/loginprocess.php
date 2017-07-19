<?php 
    require_once 'AdminService.class.php';
    
    //接收用户数据
    $id=$_POST['id'];
    $password=$_POST['password'];
    
    //实例化一个AdminService方法
    $adminService=new AdminService();
    if ($adminService->cheakAdmin($id, $password))  {
        //合法
        header("Location:empmanage.php");
        //查询成功时跳转到empmanage.php
        exit();
    }else {
        //非法
        header("Location:login.php?error=1");
        //返回重新登录
        exit();
    }           
?>




