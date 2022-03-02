<?php
declare (strict_types = 1);

namespace app\subscribe;

/*示例事件订阅*/
class Test
{

    /* 以下方法不局限于命名，你可以在添加事件在控制器中按实际逻辑随意搭配 */

    /*
     * @$arg['params'] 触发时间方法接收的参数-引用传值，对参数做修改会影响方法中的值
     * @$arg['model'] 触发事件的模型
     * */
    public function onTestAdd($arg){
        //新增前逻辑
        $arg['params']['name'] = $arg['params']['name'].'大漂亮';
    }

    public function onTestAdded($arg){
        //新增后逻辑
    }

    public function onTestEdit($arg){
        //编辑前逻辑
    }

    public function onTestEdited($arg){
        //编辑后逻辑
    }

    public function onTestDelete($arg){
        //删除前逻辑
    }

    public function onTestDeleted($arg){
        //删除后逻辑
    }

}
