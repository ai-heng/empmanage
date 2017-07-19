<?php 
    require_once 'SqlHelper.class.php';
    
    class EmpService  {    
        //获取页数函数
        function getPageCount($pageSize)  {
            //查询$rowCount
            $sql="select count(id) from emp";       
            $sqlHelper=new SqlHelper();
            $res=$sqlHelper->execute_dql($sql);
            //计算$pageCount
            if ($row=mysqli_fetch_row($res))  {
                $pageCount=ceil($row[0]/$pageSize);
            }
            
            //释放资源
            mysqli_free_result($res);
            
            //关闭连接
            $sqlHelper->close_connect();
                       
            return $pageCount;            
        }
        
        //获取应当显示的雇员信息
        function getEmpListByPage($pageNow,$pageSize)  {
            $sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";
             
            $sqlHelper=new SqlHelper();
            //这里的res是一个二维数组
            $res=$sqlHelper->execute_dql2($sql);
            
            //关闭连接
            $sqlHelper->close_connect();
            
            return $res;
        }       
    }
?>











