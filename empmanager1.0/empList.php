<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>雇员列表信息</title>
</head>

<?php 
    //显示所有用户的信息
    //查询数据
    $conn=mysqli_connect("localhost","root","zhang970817","empmanage");
    if (!$conn)
        die("connect error".mysqli_connect_error());
    //利用变量做活
    $pageSize=3;        //每页显示记录数
    $rowCount=0;        //共有记录数，从数据库获取
    $pageNow=1;         //显示第几页，用户来指定
    
    //通过用户点击修改pageNow的值
    if (!empty($_GET['pageNow']))  {
    $pageNow=$_GET['pageNow'];
    }
    $pageCount=0;       //共有几页，通过程序计算得出
    
    $sql="select count(id) from emp";
    $res2=mysqli_query($conn,$sql);
    //取出记录行数
    if ($row=mysqli_fetch_array($res2))
    $rowCount=$row[0];
    //取出记录行数
//     if ($row=mysqli_fetch_assoc($res2)  
//         $rowCount=$row[0]; 
    //计算共有几页
    $pageCount=ceil($rowCount/$pageSize);           //ceil函数：进一法取整
    $sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";

    //固定写法，显示$pageSize=3,显示第2页
    //$sql="select * from emp limit 3，3";
    $res1=mysqli_query($conn,$sql);
    echo "<table width='700px'>";
    echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";
    
    while ($row=mysqli_fetch_assoc($res1))  {
        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td><td><a href='#'>删除用户</a></td><td><a href='#'>修改用户</a></td></tr>";
    }
    echo "<h1>雇员信息列表</h1>";
    echo "</table>";
    
    //打印出页码超链接
    for ($i=1;$i<=$pageCount;$i++)  {
        echo "<a href='empList.php?pageNow=$i'>$i</a>&nbsp;";
    }
    //显示上一页和下一页
    if ($pageNow>1)  {
        $prePage=$pageNow-1;
        echo "<a href='empList.php?pageNow=$prePage'>上一页</a>&nbsp;";
    }
    if ($pageNow<$pageCount)  {
        $nextPage=$pageNow+1;
        echo "<a href='empList.php?pageNow=$nextPage'>下一页</a>&nbsp;";
    }
    //一次性跳转多页
    echo "<a href='#'><<</a>&nbsp;&nbsp;";
    echo "<a href='#'>[1]</a>";
    echo "<a href='#'>[2]</a>";
    echo "<a href='#'>[3]</a>";
    echo "<a href='#'>[4]</a>";
    echo "<a href='#'>[5]</a>";
    echo "<a href='#'>>></a>";        
    //显示当前页和共有多少页
    echo "当前页{$pageNow}/共{$pageCount}页";
    //指定跳转到某页
    echo "<br/><br/>";
?>

<form action="empList.php">
跳转到：<input type="text" name="pageNow" />
<input type="submit" value="GO" />
</form>
<?php        
    //关闭资源
    mysqli_free_result($res1);
    mysqli_close($conn);
?>
</html>



