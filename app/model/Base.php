<?php
namespace app\model;

use think\Model;

class Base extends Model
{
    protected $autoWriteTimestamp = true;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $domain = request()->domain();
        $connections = config('ddb.databases');
        if(isset($connections[$domain])){
            $this->connection = $connections[$domain];
        }else{
            //TODO::这里随便写了一个后面要拓展再说
            $this->connection = 'mysql';
        }
    }
}
