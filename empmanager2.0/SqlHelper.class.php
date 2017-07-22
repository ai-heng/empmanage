	<?php
	//这个一个工具类,作用是完成对数据库的操作
	class SqlHelper {
	    
	    public $conn;
	    public $dbname="empmanage";
	    public $username="root";
	    public $password="zhang970817";
	    public $host="localhost";
	    
	    public function __construct(){
	        
	        $this->conn=mysqli_connect($this->host,$this->username,$this->password,$this->dbname);
	        if(!$this->conn){
	            die("连接失败".mysqli_error());
	        }
	    }
	    
	    //执行dql语句
	    public function execute_dql($sql){
	        
	        $res=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
	        return $res;
	        
	    }
	    
	    //执行dql语句，但是返回的是一个数组
	    public function execute_dql2($sql){
	        
	        $arr=array();
	        $res=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
	        
	        //把$res里的东西转移到$arr
	        while($row=mysqli_fetch_assoc($res)){
	            $arr[]=$row;
	        }
	        //返回数组值之前便可以关闭结果集$res，释放资源
	        mysqli_free_result($res);
	        return $arr;
	        
	    }
	    
	    //考虑分页情况的查询,这是一个比较通用的并体现oop编程思想的代码
	    //$sql1="select * from where 表名 limit 0,6";
	    //$sql2="select count(id) from 表名"
	    
	    public function exectue_dql_fenye($sql1,$sql2,$fenyePage){
	        //这里我们查询了要分页显示的数据
	        $res=mysqli_query($this->conn,$sql1) or die(mysqli_error($this->conn));
	        //$res=>array()
	        $arr=array();
	        //把$res转移到$arr
	        while($row=mysqli_fetch_assoc($res)){
	            $arr[]=$row;
	        }
	        
	        mysqli_free_result($res);
	        
	        $res2=mysqli_query($this->conn,$sql2) or die(mysqli_error($this->conn));
	        
	        if($row=mysqli_fetch_row($res2)){
	            //计算出总页数
	            $fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
	            //总记录数
	            $fenyePage->rowCount=$row[0];
	        }
	        
	        mysqli_free_result($res2);
	        
	        //把导航信息也封装到fenyePage对象中
	        
	        $navigate="";              //用该字符串串出需要显示的界面
	        if ($fenyePage->pageNow>1){
	            $prePage=$fenyePage->pageNow-1;
	            $navigate="<a href='{$fenyePage->gotoUrl}?pageNow=$prePage'>上一页</a>&nbsp;";
	        }
	        if($fenyePage->pageNow<$fenyePage->pageCount){
	            $nextPage=$fenyePage->pageNow+1;
	            //字符串后面+.用于将其和之前的字符串串接在一起
	            $navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$nextPage'>下一页</a>&nbsp;";
	        }
	        
	        //使用for循环打印超链接，实现同时10页翻页的功能
	        //定义$start  1->10   11->20   21->30  分段相同....
	        //1->10  =>floor(($pageNow-1)/10)=0*10+1=1
	        //11->20 =>floor(($pageNow-1)/10)=1*10+1=11
	        //21->30 =>floor(($pageNow-1)/10)=2*10+1=21
	        
	        $page_whole=10;
	        $start=floor(($fenyePage->pageNow-1)/$page_whole)*$page_whole+1;
	        $index=$start;
	        
	        //显示10页超链接
	        for(;$start<$index+$page_whole;$start++){
	            $navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$start'>[$start]</a>";
	        }
	        
	        //向前整体翻动10页
	        //如果当前pageNow在1-10页数，就没有向前翻动的超连接
	        if($fenyePage->pageNow>$page_whole){
	            $navigate.="&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=".($start-1)."'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
	        }
	        
	        //向后整体翻动10页
	        $navigate.="&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$start'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";
	       
	        //显示当前页和共有多少页
	        $navigate.=" 当前页{$fenyePage->pageNow}/共{$fenyePage->pageCount}页";
	        
	        //把$arr赋给$fenyePage
	        $fenyePage->res_array=$arr;
	        //把$navigate赋给$fenyePage
	        $fenyePage->navigate=$navigate;
	        
	    }
	    
	    //执行dml语句
	    public  function execute_dml($sql){
	        
	        $b=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
	        if(!$b){
	            return 0;              //失败
	        }else{
	            if(mysqli_affected_rows($this->conn)>0){
	                return 1;          //表示执行ok
	            }else{
	                return 2;          //表示没有行受到影响
	            }
	        }
	    }
	    
	    //关闭连接的方法
	    function close_connect(){
	        
	        if(!empty($this->conn)){
	            mysqli_close($this->conn);
	        }
	    }
	}
?>