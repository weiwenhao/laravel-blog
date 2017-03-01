# 常用命令

- `git push -u origin master` 提交主分支到远程仓库

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
# vue使用经验

1. `v-if=null 或false 或0 或空字符串 或`时不显示 -- {} ,[],或者任意字符串时则显示
	- 这侧面表现出来了在vue.js中的字符串转换规则