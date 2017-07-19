<?php

    require_once 'SqlHelper.class.php';
    
    //业务逻辑处理类，主要完成对admin表的操作
    class AdminService  {
        //提供一个验证用户是否合法的方法
        public function cheakAdmin($id,$password)  {
            $sql="select password form admin where id=$id";
            //创建一个SqlHelper对象
            $sqlHelper=new SqlHelper();
            //调用SqlHelper函数
            $sqlHelper->execute_dql($sql);
            if ($row=mysqli_fetch_row($res))  {
                if (md5($password)==$row['password'])  {
                    return ture;
                }
            }
            return false;
        //释放资源
        mysqli_free_result($res);
        $sqlHelper->close_connect();
        
        }
        
        
        
        
    }

?>








