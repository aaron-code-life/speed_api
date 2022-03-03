<?php
declare (strict_types = 1);

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\facade\Db;

class Api extends Command
{
    protected $ds = "/";
    protected $force = false;
    protected $file = [];
    protected function configure()
    {
        // 指令配置
        $this->setName('api')
            ->addArgument('table', Argument::OPTIONAL, "需要生成的表")
            ->addOption('force', null, Option::VALUE_REQUIRED, '强制覆盖')
            ->addOption('file', null, Option::VALUE_REQUIRED, '指定生成文件；m代表模型，v代表验证器，c代表控制器，s代表事件订阅，多个逗号隔开')
            ->setDescription('根据表名生成所需要的类例如：php think api user 为生成user表的控制器-模型-验证器类');
    }

    protected function execute(Input $input, Output $output)
    {

        $database = env('database.database', '');
        $prefix = env('database.prefix', '');
        //表名
        $table = trim($input->getArgument('table'));
        if ($input->hasOption('force') && $input->getOption('force') == 'true') {
            $this->force = true;
        }
        if ($input->hasOption('file')) {
            $this->file = explode(',',$input->getOption('file'));
        }
        //类名
        $table_comment_u = $table;
        $model_name = ucwords($this->toCamelCase($table));
        $dbconnect = Db::connect('mysql');
        $table = $prefix.$table;
        //获取表的构建语句
        $create_table_sql = $dbconnect->query("show create table {$table}", [], true);
        $create_table_sql = $create_table_sql[0]['Create Table'];
        //获取表信息
        $table_info = $dbconnect->query("SHOW TABLE STATUS LIKE '{$table}'", [], true);

        $table_comment = $table_info[0]['Comment'];

        $table_comment = mb_substr($table_comment, -1) == '表' ? mb_substr($table_comment, 0, -1) : $table_comment;
        //从数据库中获取表字段信息 show create table user
        $sql = "SELECT * FROM `information_schema`.`columns` "
            . "WHERE TABLE_SCHEMA = ? AND table_name = ? "
            . "ORDER BY ORDINAL_POSITION";

        //加载表的列
        $return_data  = [
            'code' => 20000,
            'message' => '成功',
            'time' => '成功',
            'data' => [],
        ];

        $columnList = $dbconnect->query($sql, [$database, $prefix."{$table}"]);

        $apiAddDoc = [
            0=>"\n\t/**",
            1=>'* showdoc',
            2=>'* @catalog '.$table_comment,
            3=>'* @title 新增'.$table_comment,
            4=>'* @description 新增'.$table_comment,
            5=>'* @method post',
            6=>'* @url /api/写上你设置的的路由！！！！',
            7=>'* @header token 必选 string token'
        ];

        //生成接口文档验证器规则 message scene
        $vrule = [];//'truename'  => 'require|max:20',
        $vmessage = [];//'truename'  => 'require|max:20',
        $vscene = [];//'truename.require'  => '真实姓名必须填写',
        $vscene[] = "'add'  =>  [";

        foreach ($columnList as $k => $v){
            $return_data['data'][$v['COLUMN_NAME']] = $v['COLUMN_COMMENT'];
            //* @return_param meat int 分页数据,总共几条
            //$apiAddDoc[$k+7] = "* @Apidoc\Param(\"{$v['COLUMN_NAME']}\", type=\"{$v['DATA_TYPE']}\",default=\"{$v['COLUMN_DEFAULT']}\" ,require=true, desc=\"{$v['COLUMN_COMMENT']}\")";//
            $apiAddDoc[$k+8] = "* @param {$v['COLUMN_NAME']} 必选 {$v['DATA_TYPE']} {$v['COLUMN_COMMENT']}";//
            //$apiAddDoc[$k+7+count($columnList)] = "* @Apidoc\Returned(\"{$v['COLUMN_NAME']}\",default=\"{$v['COLUMN_DEFAULT']}\", type=\"{$v['DATA_TYPE']}\",desc=\"{$v['COLUMN_COMMENT']}\")";//
            $apiAddDoc[$k+8+count($columnList)+2] = "* @return_param {$v['COLUMN_NAME']} {$v['DATA_TYPE']} {$v['COLUMN_COMMENT']}";
            $vmessage[] = "'{$v['COLUMN_NAME']}.require'  => '{$v['COLUMN_COMMENT']}必须填写',//{$v['COLUMN_COMMENT']}";
            $max = "";

            //DATA_TYPE COLUMN_TYPE COLUMN_DEFAULT

            $s = strpos($v['COLUMN_TYPE'],"(");
            if($s){
                $str = substr($v['COLUMN_TYPE'],$s+1);
                $str = str_replace(")","",$str);
                $len = explode(",",$str);
                $max = "|max:".$len[0];
                $vmessage[] = "'{$v['COLUMN_NAME']}.max'  => '{$v['COLUMN_COMMENT']}字符长度不能超过{$len[0]}',//{$v['COLUMN_COMMENT']}";
            }

            $vrule[] = "'{$v['COLUMN_NAME']}'  => 'require{$max}',//{$v['COLUMN_COMMENT']}";
            $vscene[] = "'{$v['COLUMN_NAME']}',";
        }
        $vscene[] = "],";
        $apiAddDoc[count($columnList)+8] = "* @json_param ".json_encode($return_data,JSON_UNESCAPED_UNICODE);
        $apiAddDoc[count($columnList)+9] = "* @return ".json_encode($return_data,JSON_UNESCAPED_UNICODE);
        $apiAddDoc[] = "* @remark 这里是备注信息";
        $apiAddDoc[] = "* @number 99";
        $apiAddDoc[] = "*/";

        //生成模型
        $mpath = app_path() . $this->ds . 'model' . $this->ds . $model_name . '.php';
        if(empty($this->file) || in_array('m',$this->file)){
            if(!file_exists($mpath) || $this->force) {
                $this->writeToFile('model', [
                    'table_comment' => $table_comment,
                    'create_table_sql'=>$create_table_sql,
                    'table_comment_u'=>$table_comment_u,
                    'class_name' => $model_name
                ], $mpath);
                $output->writeln("model/{$model_name}.php-新建成功");
            }else{
                $output->writeln($mpath.'文件已存在');
            }
        }

        //生成控制器
        $cpath = app_path() . $this->ds . 'controller' . $this->ds . $model_name . '.php';
        if(empty($this->file) || in_array('c',$this->file)){
            if(!file_exists($cpath) || $this->force) {
                ksort($apiAddDoc);
                $apiAddDoc = implode("\n\t", array_values($apiAddDoc));
                $this->writeToFile('controller', [
                    'table_comment' => $table_comment,
                    'apiAddDoc' => $apiAddDoc,
                    'class_name' => $model_name
                ], $cpath);
                $output->writeln("controller/{$model_name}.php-新建成功");
            }else{
                $output->writeln($cpath.'文件已存在');
            }
        }

        //生成验证器
        $vpath = app_path().$this->ds.'validate'.$this->ds.$model_name.'.php';
        if(empty($this->file) || in_array('v',$this->file)){
            if(!file_exists($vpath) || $this->force){
                //生成验证器
                $vrule = implode("\n\t\t", array_values($vrule));
                $vmessage = implode("\n\t\t", array_values($vmessage));
                $vscene = implode("\n\t\t\t", array_values($vscene));
                $this->writeToFile('validate',[
                    'table_comment'=>$table_comment,
                    'vrule'=>$vrule,
                    'vmessage'=>$vmessage,
                    'vscene'=>$vscene,
                    'class_name'=>$model_name,
                    'create_table_sql'=>$create_table_sql,
                ],$vpath);
                $output->writeln("validate/{$model_name}.php-新建成功");
            }else{
                $output->writeln($vpath.'文件已存在');
            }
        }

        //生成订阅事件
        $spath = app_path() . $this->ds . 'subscribe' . $this->ds . $model_name . '.php';
        if(empty($this->file) || in_array('s',$this->file)){
            if(!file_exists($spath) || $this->force) {
                $this->writeToFile('subscribe', [
                    'table_comment' => $table_comment,
                    'table_comment_u'=>$table_comment_u,
                    'class_name' => $model_name
                ], $spath);
                $output->writeln("subscribe/{$model_name}.php-新建成功");
            }else{
                $output->writeln($spath.'文件已存在');
            }
        }

    }

    /**
     * 写入到文件
     * @param string $name
     * @param array  $data
     * @param string $pathname
     * @return mixed
     */
    protected function writeToFile($name, $data, $pathname)
    {
        foreach ($data as $index => &$datum) {
            $datum = is_array($datum) ? '' : $datum;
        }
        unset($datum);
        $content = $this->getReplacedStub($name, $data);

        if (!is_dir(dirname($pathname))) {
            mkdir(dirname($pathname), 0755, true);
        }
        return file_put_contents($pathname, $content);
    }


    /**
     * 获取替换后的数据
     * @param string $name
     * @param array  $data
     * @return string
     */
    protected function getReplacedStub($name, $data)
    {
        foreach ($data as $index => &$datum) {
            $datum = is_array($datum) ? '' : $datum;
        }
        unset($datum);
        $search = $replace = [];
        foreach ($data as $k => $v) {
            $search[] = "{{{$k}}}";
            $replace[] = $v;
        }
        $stubname = $this->getStub($name);
        $stub = file_get_contents($stubname);
        $content = str_replace($search, $replace, $stub);
        return $content;
    }

    /**
     * 获取基础模板
     * @param string $name
     * @return string
     */
    protected function getStub($name)
    {
        return __DIR__ . $this->ds . 'stubs' . $this->ds . $name . '.stub';
    }

    //下划线命名到驼峰命名
    function toCamelCase($str)
    {
        $array = explode('_', $str);
        $result = $array[0];
        $len=count($array);
        if($len>1)
        {
            for($i=1;$i<$len;$i++)
            {
                $result.= ucfirst($array[$i]);
            }
        }
        return $result;
    }
}
