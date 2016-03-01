<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;

/**
 * 用户角色模型
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */

class MemberRoleModel extends Model {

    protected $_validate = array(
        array('name', '1,16', '昵称长度为1-16个字符', self::EXISTS_VALIDATE, 'length'),
        array('name', '', '角色名称被占用', self::EXISTS_VALIDATE, 'unique'), //角色名称被占用
    );
	
	/* 自动完成规则 */
    protected $_auto = array(
        array('update_time', NOW_TIME, self::MODEL_BOTH)
    );

    public function lists($status = 1, $order = 'id DESC', $field = true){
        $map = array('status' => $status);
        return $this->field($field)->where($map)->order($order)->select();
    }

	public function addMemberRole($memberRole = array()){
		if(!is_array($memberRole) || !isset($memberRole['name']) || !isset($memberRole['status'])){
			return -1;
		}
		// 添加用户角色
		if($this->create($memberRole)){
			$role_id = $this->add();
			return $role_id ? $role_id : 0; //0-未知错误，大于0-注册成功
		} else {
			return $this->getError(); //错误详情见自动验证注释
		}
	}

}
