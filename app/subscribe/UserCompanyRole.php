<?php
declare (strict_types = 1);

namespace app\subscribe;

use app\model\CompanyRole;
use app\model\Company;
use app\model\User;
use app\model\UserCompanyRole as UserCompanyRoleModel;

class UserCompanyRole
{

    public function onUcrAdd($arg){

        //判断是否提交过岗位认证
        $userCompanyRole = (new UserCompanyRoleModel())->where([
            ['user_id','=',request()->user->id],
            ['status','IN','0,1'],
        ])->find();

        if ($userCompanyRole) api_error('您已经提交过岗位认证,请勿重复提交',403);

        //新增岗位前判断公司和工种是否存在
        $company = (new Company())
            ->where([
                ['id','=',$arg['params']['company_id']],
                ['status','=',1]
            ])
            ->find();

        if (!$company) api_error('公司不存在');

        $company_role = (new CompanyRole())->where([
            ['id','=',$arg['params']['company_role_id']],
            ['company_id','=', $arg['params']['company_id']],
            ['status','=', 1],
        ])->find();

        if (!$company_role) api_error('工种不存在');

        if((new User())->where('id',request()->user->id)->save([
            'truename' => $arg['params']['truename'],
            'id_card' => $arg['params']['id_card'],
            'id_card_positive' => $arg['params']['id_card_positive'],
            'id_card_back' => $arg['params']['id_card_back']
        ])){
            unset($arg['params']['truename']);
            unset($arg['params']['id_card']);
            unset($arg['params']['id_card_positive']);
            unset($arg['params']['id_card_back']);
        }else{
            api_error('人员信息更新失败');
        }

    }

    public function onUcrAdded($arg){
        //新增后更新人员表数据
    }

}
