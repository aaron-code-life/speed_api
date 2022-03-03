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


|参数名|说明|
|:----    |-----   |
| @catalog      | 生成文档要放到哪个目录。如果只是二级目录，则直接写目录名字。如果是三级目录，而需要写二级目录/三级目录，即用/隔开。如”一层/二层/三层” |
| @title        | 表示生成的文档标题 |
| @description  | 是文档内容中对接口的描述信息 |
| @method       | 接口请求方式。一般是get或者post |
| @url          | 接口URL。不要在URL中使用&符号来传递参数。传递参数请写在参数表格中 |
| @header       | 可选。header说明。一行注释对应着表格的一行。用空格或者tab符号来隔开每一列信息。|
| @param        | 参数表格说明。一行注释对应着表格的一行。用空格或者tab符号来隔开每一列信息。|
| @json_param   | 可选。当请求参数是json的时候，可增加此标签。请把json内容压缩在同一行内。当采用这种json方式的时候，上面的@param表格的参数说明将自动变成是对此json的字段描述说明|
| @return       | 返回内容。请把返回内容压缩在同一行内。如果是json，程序会自动进行格式化展示。 如果是非json内容，则原样展示。|
| @return_param | 返回参数的表格说明。一行注释对应着表格的一行。用空格或者tab符号来隔开每一列信息。|
| @remark       | 备注信息|
| @number       | 可选。文档的序号。|
 ```php
 	/**
 	* showdoc
 	* @catalog 示例
 	* @title 新增示例
 	* @description 新增示例
 	* @method post
 	* @url /api/uesr
 	* @header token 必选 string token
 	* @param id 必选 int 主键id
 	* @param name 必选 varchar 姓名
 	* @param content 可选 varchar 内容
 	* @param create_time 必选 datetime 创建时间
 	* @param update_time 必选 datetime 更新时间
 	* @param status 必选 tinyint 状态
 	* @json_param {"id":1,"name":"姓名","create_time":"2022-03-03 17:09:02","update_time":"2022-03-03 17:09:02","status":0}
 	* @return  {"code":20000,"message":"成功","time":"成功","data":{"id":"主键id","name":"姓名","content":"内容","create_time":"创建时间","update_time":"更新时间","status":"状态"}}
 	* @return_param id int 主键id
 	* @return_param name varchar 姓名
 	* @return_param content varchar 内容
 	* @return_param create_time datetime 创建时间
 	* @return_param update_time datetime 更新时间
 	* @return_param status tinyint 状态
 	* @remark 这里是备注信息
    * @number 99
 	*/
 	
```
