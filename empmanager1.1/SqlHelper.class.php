<?php 

    //工具类，完成对数据库的操作
    class SqlHelper  {
        public $conn;
        public $dbname="empmanage";
        public $username="root";
        public $password="zhang970817";
        public $host="localhost";
        
        //数据库连接
        public function _construct()  {
            $this->conn=mysqli_connect($this->host,$this->username,$this->password,$this->dbname);
            if (!$this->conn)  {
                die ("connect error".mysqli_error());
            }
        }        
        
        //执行dql语句
        public function execute_dql($sql)  {
            //global $this->conn;
            $res=mysqli_query($this->conn,$sql) or die(mysqli_error());
            return $res;
        }
        
        //执行dql语句，返回一个数组
        public function execute_dql2($sql)  {
            $arr=array();
            $res=mysqli_query($this->conn,$sql) or die(mysqli_error());
            //$i=0;
            //把$res里的东西转移到$arr
            while ($row=mysqli_fetch_assoc($res))  {
                $arr[]=$row;                  //???
            }
            //返回数组值之前便可以关闭结果集$res，释放资源
            mysqli_free_result($res);
            
            return $arr;
        }                
        
//         //执行dml语句
//         public function execute_dml($sql)  {
//             $b=mysqli_query($this->conn,$sql) or die(mysqli_error());
//             if (!$b){
//                 return 0;
//             }else {
//                 if (mysqli_affected_rows($b)>0)  {     //????
//                     return 1;           //表示执行成功
//                 }else {
//                     return 2;           //表示没有行受到影响 
//                 }
//             }
//         }
        
        //关闭连接
        public function close_connect()  {
            if (!empty($this->conn))  {
                mysqli_close($this->conn);
            }
        }        
    }
?>












