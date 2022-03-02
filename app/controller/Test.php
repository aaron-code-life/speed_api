<?php
namespace app\controller;

/**
 * 示例
 */
class Test extends Base
{
    public function initialize()
    {
        parent::initialize();
        $this->model = new \app\model\Test();
    }

    
	/**
	* showdoc
	* @catalog 示例
	* @title 新增示例
	* @description 新增示例
	* @method post
	* @url /api/写上你设置的的路由！！！！
	* @param id 必选 int 主键id
	* @param name 必选 varchar 姓名
	* @param content 必选 varchar 内容
	* @param create_time 必选 datetime 创建时间
	* @param update_time 必选 datetime 更新时间
	* @param status 必选 tinyint 状态
	* @return {"code":20000,"message":"成功","time":"成功","data":{"id":"主键id","name":"姓名","content":"内容","create_time":"创建时间","update_time":"更新时间","status":"状态"}}
	* @return_param id int 主键id
	* @return_param name varchar 姓名
	* @return_param content varchar 内容
	* @return_param create_time datetime 创建时间
	* @return_param update_time datetime 更新时间
	* @return_param status tinyint 状态
	*/
    public function add(){
        parent::add();
    }

}