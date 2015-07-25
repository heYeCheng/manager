<?php

class safeMod extends commonMod{
	// 管理员登陆
	public function login($admin, $pwd){
		$con['user'] = $admin;
		$con['pwd'] = $pwd;
		$field = 'a_id, name, power';

		$res = $this->model->table($this->config['admin'])->field($field)->where($con)->find();
		// dump($res);exit();
		if ($res) {
			setcookie('aid', $res['a_id'], time() + EX_TIME_COOKIE, '/');
			setcookie('name', $res['name'], time() + EX_TIME_COOKIE, '/');
			setcookie('power', $res['power'], time() + EX_TIME_COOKIE, '/');
			return True;
		}else{
			return False;
		}
	}

	// 管理员退出
	public function logout(){
		setcookie('aid', '', -1, '/');
		setcookie('name', '', -1, '/');
		setcookie('power', '', -1, '/');
	}

	// 验证是不是管理员
	public function check_login(){
		
	}
}

?>