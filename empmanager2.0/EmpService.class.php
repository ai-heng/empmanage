<?php
    require_once 'SqlHelper.class.php';
    require_once 'Emp.class.php';
class EmpService  {
    
    //使用封装的方式完成分页
    function getFenyePage($fenyePage)  {
        //创建一个SqlHelper对象实例
        $sqlHelper=new SqlHelper();
        
        //从数据库获取每一页需要显示的数据
        $sql1="select * from emp limit ".($fenyePage->pageNow-1)*$fenyePage->pageSize.",".$fenyePage->pageSize;
        //从数据库获取总行数
        $sql2="select count(id) from emp";
        
        $sqlHelper->exectue_dql_fenye($sql1, $sql2, $fenyePage);
        $sqlHelper->close_connect();
        
    }
    
    //删除用户功能
    function delEmpById($id)  {
        $sql="delete from emp where id=$id";
        //创建SqlHelper对象
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dml($sql);
        
        return $res;
    }
    
    //根据id号获取一个雇员信息
    function getEmpById($id)  {
        $sql="select * from emp where id=$id";
        $sqlHelper=new SqlHelper();
        $arr=$sqlHelper->execute_dql2($sql);
        $sqlHelper->close_connect();
        //二次封装，$arr->Emp对象实例
        //创建一个emp对象实例
        $emp=new Emp();
        
        $emp->setId($arr[0]['id']);
        $emp->setName($arr[0]['name']);
        $emp->setGrade($arr[0]['grade']);
        $emp->setEmail($arr[0]['email']);
        $emp->setSalary($arr[0]['salary']);
        return $emp;
    }
    
    //修改功能
    function updateEmp($id,$name,$grade,$email,$salary)  {
        $sql="update emp set name='$name',grade='$grade',email='$email',salary='$salary' where id='$id'";
        
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dml($sql);
        $sqlHelper->close_connect();
        return $res;
    }
    
    //添加用户功能
    function addEmp($name,$grade,$email,$salary)  {
        $sql="insert into emp (name,grade,email,salary) values('$name','$grade','$email','$salary')";
        //通过SqlHelper完成添加
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dml($sql);
        $sqlHelper->close_connect();
        return $res;
    }
}
?>











