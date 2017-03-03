# 常用命令

- `git push -u origin master` 同步当前分支下的主分支到远程仓库的主分支,第一次填写时才添加-u参数
- `git push origin master` 同步当前分支下的主分支到远程仓库的主分支

# TODO list

- 在api路由中使用mems/captcha验证码包出现验证失败?
	- 因此无法在VUE中使用验证码
	
- 打包工具后的layer弹出层无效,临时解决方法在
	-    {{--弹出层临时解决方案,带完善--}}
		app目录下的98和99行	
		
		`<script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>`
     	   `<script src="{{asset('vendor/layer/layer.js')}}"></script>`
- datatables使用ajax做数据源时按照官网的写法报错aData is undifind
	暂时解决办法,加上一行 `"sAjaxDataProp" : '',//加上该条ajax数据源才有效`
	- 详见 key/list.blade.php中的datatables配置部分
- laravel自带的登录表单,在没有勾选记住我的情况下登录,重启浏览器后,依旧会记住登录状态大概1个小时左右
# vue使用经验

1. `v-if=null 或false 或0 或空字符串 或`时不显示 -- {} ,[],或者任意字符串时则显示
	- 这侧面表现出来了在vue.js中的字符串转换规则
	
# 后台简单一个模块的工作流程
 ### 准备阶段
 1. 注册路由
 
 2. 创建控制器(后台通常是resource控制器)
 	- 添加datatables的数据源路由,如 ajax_key
 3. 创建模型(因为逻辑通常写在repository中,所以前后台公用一个模型)
 4. 创建数据迁移,及数据填充
 5. 创建repository仓库,并在控制器中注入该仓储
 ### 开发阶段
 1. 列表展示  index
 	- 控制器中index方法分配一个试图 如 /views/admin/article/list.blade.php
 	- 使用dataTables插件完成该模块的列表展示,编写后台数据源,即在控制器中添加一个 public function ajax_xxx()方法
 3. 数据添加 create story
 	- 控制器中return一个试图,如果有附加数据则返回附加数据
 	- 试图的制作
 	...
 4.编辑同上,删除时需要确认,并且如果该数据有关联数据,要删除关联表中的数据
 ---
 ### 后台评论模块的开发
 1. 后台评论不需要编辑,不需要后台添加,因此只需要一个删除功能
 	- 所以不需要resource路由
 		- 需要的路由有 index() destroy() ajax_index()
	- CommentRepository中添加一个dataTables需要的路由
 2. 前台的字段分析
 	- 关系模型是为一对多
 	- 用户自定义的用户名
 	- 点赞数(该功能前台暂时未定义)
 	- 评论内容,评论内容过过长,所以显示一部分,然后添加一个鼠标移入事件,鼠标移入时,显示完整的评论内容
 	- 评论的发表时间
 	- 评论对应的文章标题(标题不需要隐藏)
3. 鉴于数据量,dataTables使用服务器模式
####扩展  
	
前台添加特别功能,直接显示删除按钮,在没有登录功能的情况下,如何显示删除按钮呢?
- 直接检测验证后台的登录状态,如果登录通过则显示删除按钮,对应的api为后台的删除方法(此方法必须要登录才能使用咯!)
 	
 	
 # 注意
 
 1. 为了减少你重构代码的次数,请一定要注意一些常用字段的命名,尤其是数据库方面,同一类数据尽量命名相同
 	,比如关键字的 name 字段 和分类的字段的 name字段命名相同,可以让你更加方便快捷的复制代码