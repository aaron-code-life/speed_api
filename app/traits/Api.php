<?php
namespace app\traits;

use think\Exception;
use think\facade\Db;

trait Api {

    //验证
    protected function validateAction($params,$scene,$notice){
        if(!$this->validate) return;
        $validate = str_replace("\\model\\", "\\validate\\", get_class($this->model));
        $this->validateParams($params,$validate,$scene,$notice);
    }

    //增
    public function add(){
        $this->validateAction($this->params,'add','新增');
        Db::startTrans();
        try{
            //执行新增前事件
            foreach ($this->addEvent as $eb){
                event($eb,['params'=>&$this->params,'model'=>$this->model]);
            }
            //新增提交
            $res = $this->model->save($this->params);
            if($res){
                //执行新增后事件
                foreach ($this->addedEvent as $ea){
                    event($ea,['params'=>$this->params,'id'=>$this->model->getLastInsID()]);
                }
                Db::commit();
                api_success('新增成功');
            }
        }catch (Exception $e){
            Db::rollback();
            api_error('新增失败:'.$e->getMessage(),500);
        }
    }

    //改
    public function edit(){
        $this->validateAction($this->params,'edit','更新');
        $row = $this->model->find($this->params['id']);
        if(!$row) api_error('数据不存在',500);
        Db::startTrans();
        try{
            //执行更新前事件
            foreach ($this->editEvent as $eb){
                event($eb,['params'=>&$this->params,'model'=>$row]);
            }
            //更新提交
            $res = $row->save($this->params);
            if($res){
                //执行更新后事件
                foreach ($this->editedEvent as $ea){
                    event($ea,['params'=>$this->params,'model'=>$row]);
                }
                Db::commit();
                api_success('更新成功');
            }
        }catch (Exception $e){
            Db::rollback();
            api_error('更新失败:'.$e->getMessage(),500);
        }
    }

    //列表
    public function index($where = []){
        //todo::后面针对业务优化
        $sort = "id";
        $order = 'desc';
        $this->limit = $this->params['limit'] ?? $this->limit;
        $list = $this->model
            ->where($where)
            ->order($sort, $order)
            ->paginate($this->limit);
        api_success('获取成功',$list);

    }

    //详情
    public function detail(){
        $detail = $this->model->find($this->params['id']);
        if(!$detail) api_error('数据不存在',404);
        api_success('获取成功',$detail);
    }

    //删
    public function delete(){

        //未登录不能删除任何数据
        if(!$this->_user) api_success('请先登录！',401);

        //默认只能删与自己关联的
        $detail = $this->model->where([
            ['user_id','=',$this->_user->id],
            ['id','=',$this->params['id']],
        ])->find();

        if(!$detail) api_error('数据不存在',404);

        //执行删除前事件
        foreach ($this->deleteEvent as $da){
            event($da,['params'=>&$this->params,'model'=>$detail]);
        }

        if($detail->delete()){
            //执行删除后后事件
            foreach ($this->deletedEvent as $ea){
                event($ea,['params'=>$this->params,'model'=>$detail]);
            }
            api_success('删除成功');
        };
        api_error('删除失败',500);
    }




}
