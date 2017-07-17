<?php 
    //接收用户数据
    $id=$_POST['id'];
    $password=$_POST['password'];
    
    //利用mysqli库，验证数据库
    //1.创建连接
    $conn=mysqli_connect("localhost","root","zhang970817","empmanage");
    if (!$conn)  {
        die("connect error".mysqli_connect_error());
    }
    //数据库查询   
    $sql="select password from admin where id=$id";
    //通过login界面输入的Id来获取数据库密码，然后和输入的密码进行对比
    $res=mysqli_query($conn, $sql);
    if ($row=mysqli_fetch_assoc($res))  {
        //表明id值存在
        if ($row['password']==md5($password))  {
            //查询到的password和用户输入的密码相同，md5为加密格式
            header("Location:empmanage.php");
            //查询成功时跳转到empmanage.php
            exit();
        }
    }
    //除上述条件外，其余形式均失败，跳转回login界面重新登录，并利用error提示错误信息
    header("Location:login.php?error=1");
    exit();
    
    //关闭资源
    mysqli_free_result($res);
    mysqli_close($conn);
    
//     //简单验证（不到数据库）
//     if ($id=="100"&& $password=="123") {
//         //合法，跳转到empManage.php
//         header("Location:empManage.php");
//         //如果要跳转，最好加上exit
//         exit();
//     }
//     else {
//         //非法用户
//         header("Location:login.php?error=1");       //返回错误信息，编号errno=1
//         exit();
//     }
    
?>




