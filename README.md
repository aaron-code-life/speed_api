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
sh ./showdoc_api.sh [参数] 
#参数为需要扫描生成的目录,如为空则自动选择当前脚本所在目录
```
