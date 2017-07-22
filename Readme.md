﻿



# 雇员管理系统

这两天，照着**韩顺平**老师的PHP教程，把**雇员管理系统**代码敲了一遍，在这个过程中，把自己不懂的知识点融入到项目中去学习，我觉得通过这种方式的确有助于帮助自己进步，通过**stackOverflow**也解决了运行调试过程中出现的一些问题。

## 该项目实现的大致功能包括：

- 管理员登录系统
- 验证用户是否正确
- 后台主界面（包括管理用户、添加用户、查询用户、退出系统）
- 管理用户界面（实现数据分页功能）

##版本更新：

- **版本1.0**：采用最简单的**model1模式**，页面和业务逻辑混合在一起。
- **版本1.1**：在版本1.0的基础上，采用**分层模式**，将**页面**和**业务逻辑**分离，使得整体更有层次感，同时也完善了部分功能。
- **版本2.0**：在版本1.1的基础上，采用**MVC**开发模式，在项目编写的过程中强制将数据的输入、处理和输出进行分离，完善了添加、删除和修改用户的功能。

**版本1.0整体框架图**
![](http://opznmu7n5.bkt.clouddn.com/emp_model.png)

**版本1.1整体框架图**
![](http://opznmu7n5.bkt.clouddn.com/post17_1.png)

**版本2.0整体框架图**
![](http://opznmu7n5.bkt.clouddn.com/post19_1.png)

## 大致功能流程

**登录验证**
![](http://opznmu7n5.bkt.clouddn.com/post17_2.png)

**数据分页处理**
![](http://opznmu7n5.bkt.clouddn.com/post17_3.png)




