<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>雇员列表信息</title>
</head>

<?php 
    require_once 'EmpService.class.php';

    $pageSize=6;        //每页显示记录数
    $rowCount=0;        //共有记录数，从数据库获取
    $pageNow=1;         //显示第几页，用户来指定
    
    //通过用户点击修改pageNow的值
    if (!empty($_GET['pageNow']))  {
    $pageNow=$_GET['pageNow'];
    }
    
    //创建empService对象实例
    $empService=new EmpService();
    //调用函数，获取页数
    $pageCount=$empService->getPageCount($pageSize);
    //调用函数，获取应当显示的用户雇员列表
    $res2=$empService->getEmpListByPage($pageNow, $pageSize);
    
    echo "<table width='700px'>";
    echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";
    
    //通过数组取值
    for ($i=0;$i<count($res2);$i++)  {
        $row=$res2[$i];         
        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td><td><a href='#'>删除用户</a></td><td><a href='#'>修改用户</a></td></tr>";
    }
    
    echo "<h1>雇员信息列表</h1>";
    echo "</table>";
        
    //显示上一页和下一页
    if ($pageNow>1)  {
        $prePage=$pageNow-1;
        echo "<a href='empList.php?pageNow=$prePage'>上一页</a>&nbsp;";
    }
    if ($pageNow<$pageCount)  {
        $nextPage=$pageNow+1;
        echo "<a href='empList.php?pageNow=$nextPage'>下一页</a>&nbsp;";
    }
    
    //使用for循环打印超链接，实现同时10页翻页的功能
    //利用变量做活
    $page_whole=10;
    $start=floor(($pageNow-1)/$page_whole)*$page_whole+1;           //floor：向下取整函数
    $index=$start;
    
    //定义$start  1->10   11->20   21->30  分段相同....
    //1->10  =>floor(($pageNow-1)/10)=0*10+1=1
    //11->20 =>floor(($pageNow-1)/10)=1*10+1=11
    //21->30 =>floor(($pageNow-1)/10)=2*10+1=21
    
    //向前整体翻动10页
    //如果当前页在1->10，则没有向前翻动的必要
    if ($pageNow>10) {
    echo "<a href='empList.php?pageNow=".($start-1)."'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
    }
    //显示10页超链接
    for (;$start<$index+$page_whole;$start++)  {
        echo "<a href='empList.php?pageNow=$start'>$start</a>";       
    }
    //向后整体翻动10页
    echo "<a href='empList.php?pageNow=$start'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";
         
    //显示当前页和共有多少页
    echo "当前页{$pageNow}/共{$pageCount}页";
    //指定跳转到某页
    echo "<br/><br/>";
?>

<form action="empList.php">
跳转到：<input type="text" name="pageNow" />
<input type="submit" value="GO" />
</form>

</html>



