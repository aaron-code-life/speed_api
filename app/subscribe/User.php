<?php
declare (strict_types = 1);

namespace app\subscribe;

use think\facade\Log;

class User
{
    public function onUserLogin($arg)
    {
        // UserLogin事件响应处理
        Log::write('UserLogin事件响应处理','info');
    }

    public function onUserAdd($arg){
        Log::write('onUserAdd事件响应处理','info');
    }

    public function onUserAdded($arg){
        Log::write('onUserAdded事件响应处理','info');
    }

}
