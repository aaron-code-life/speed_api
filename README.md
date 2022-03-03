SPEED_API
===============

> 基于thinkphp6.0

 ## · 基础api文件生成说明
 * 如下例：生成表名为 user（不包含表前缀）的控制器、
     模型服务类、验证器类等文件，若文件存在不会生成成功
 ```
php think api user 
```
* 如果需要要强制覆盖（慎用！）、执行以下命令
 ```
php think api user --force=true
```
* 如果需要要指定生成文件、执行以下命令,说明：指定生成文件；m代表模型，v代表验证器，c代表控制器，s代表事件订阅，多个逗号隔开
 ```
php think api user --file=m,v,c
```

 ## · 接口文档生成
 * 控制器目录controller下有个 showdoc_api.sh 具体命令如下
 ```
bash ./showdoc_api.sh [参数] 
#参数为需要扫描生成的目录,如为空则自动选择当前脚本所在目录
```
* 以下是接口注释文档示例：
 ```php
 
 	@catalog        (目录)
 	@title          (名称)
 	@description    (描述)
 	@method         (请求方式)
 	@url            (路由)
 	@param          (参数)
 	@return         (返回)
 	@return_param   (返回字段)
 
 	/**
 	* showdoc
 	* @catalog 示例
 	* @title 新增示例
 	* @description 新增示例
 	* @method post
 	* @url /api/uesr
 	* @param id 必选 int 主键id
 	* @param name 必选 varchar 姓名
 	* @param content 必选 varchar 内容
 	* @param create_time 必选 datetime 创建时间
 	* @param update_time 必选 datetime 更新时间
 	* @param status 必选 tinyint 状态
 	* @return  {"code":20000,"message":"成功","time":"成功","data":{"id":"主键id","name":"姓名","content":"内容","create_time":"创建时间","update_time":"更新时间","status":"状态"}}
 	* @return_param id int 主键id
 	* @return_param name varchar 姓名
 	* @return_param content varchar 内容
 	* @return_param create_time datetime 创建时间
 	* @return_param update_time datetime 更新时间
 	* @return_param status tinyint 状态
 	*/
 	
```
