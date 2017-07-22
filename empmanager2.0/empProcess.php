<?php
require_once 'EmpService.class.php';

//接收用户要删除的用户id
//创建empService对象实例
$empService=new EmpService();

//接收
if(!empty($_REQUEST['flag'])){
    
    //接收flag值.
    $flag=$_REQUEST['flag'];
    //如果$flag="del", 说明用户要执行删除请求
    if($flag=="del"){
        //这是我们知道要删除用户
        $id=$_REQUEST['id'];
        //echo "你希望删除的用户id=$id";
        if($empService->delEmpById($id)==1){
            //成功!
            header("Location: ok.php");
            exit();
        }else{
            //失败!
            header("Location: error.php");
            exit();
        }
    }else if ($flag=="addEmp")  {
        //说明希望添加用户
        //接收数据
        $name=$_POST['name'];
        $grade=$_POST['grade'];
        $email=$_POST['email'];
        $salary=$_POST["salary"];
        //添加数据库
        $res=$empService->addEmp($name, $grade, $email, $salary);
        if ($res==1)  {
            //header("Location:ok.php");
            include 'ok.php';           //注：这种跳转方式和header起到的效果类似，但是效率更高
        }else {
            include 'error.php';
        }
    }else if ($flag="updateEmp")  {
        //表明希望修改用户
        //接收表单提交数据，是默认从数据库中获取到的用户信息
        $id=$_POST['id'];
        $name=$_POST['name'];
        $grade=$_POST['grade'];
        $email=$_POST['email'];
        $salary=$_POST["salary"];
        //将修改后的信息添加数据库
        $res=$empService->updateEmp($id,$name, $grade, $email, $salary);
        if ($res==1)  {
            //header("Location:ok.php");
            include 'ok.php';
        }else {
            include 'error.php';
        }
    }
}
?>












