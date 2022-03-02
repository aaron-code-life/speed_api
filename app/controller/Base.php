<?php
namespace app\controller;
use app\BaseController;
use think\App;
use think\exception\ValidateException;

//api基类
class Base extends BaseController
{

    protected $_user = null;
    protected $params = null;
    protected $model = null;
    protected $validate = true;//默认开启验证
    protected $limit = 15;

    /*事件*/
    protected $addEvent = [];//新增前
    protected $addedEvent = [];//新增后
    protected $editEvent = [];//编辑前
    protected $editedEvent = [];//编辑后
    protected $deleteEvent = [];//删除前
    protected $deletedEvent = [];//删除后

    /**
     * 引入Base控制器的traits
     */
    use \app\traits\Api;

    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->request->filter(['strip_tags', 'trim']);//参数统一过滤
        $this->param();
        $this->_user = $this->request->user;//定义请求用户
    }

    public function param(){
        //todo::到时候要对参数做处理时使用
        $this->params = $this->request->all();
    }

    //统一验证
    public function validateParams($data,$validate,$scene='',$notice = '操作'){
        try {
            //验证参数
            $validateObj = validate($validate);
            if(!empty($scene)) $validateObj = $validateObj->scene($scene);
            $validateObj->check($data);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            api_error($notice.'失败：'.$e->getMessage(),403);
        }
    }

}
