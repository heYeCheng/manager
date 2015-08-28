<?php
require_once('./module/sql_goodMod.class.php');
require_once('./module/sql_goodMod.class.php');
require_once('./module/safeMod.class.php');

class indexMod extends commonMod{
	public function index(){
		if (empty($_COOKIE['aid'])) {
			$this->display('login');
		}else{
			$sqlGood = new sql_goodMod();
			$sqlSend = new sql_sendMod();

			$this->assign('user', $_COOKIE['name']);

			// 获取学校信息
			$school_info = $this->model->table($this->config['school'])->field($field)->where($con)->select();
			$this->assign('s_info', $school_info);

			if ($_COOKIE['power'] == 0) {
				$brand_info = $sqlGood->get_brand_manager(0);
				$this->assign('b_info', $brand_info);

				// 展示经销商
				$admin_info = $sqlGood->get_admin_manager();
				$this->assign('a_info', $admin_info);

				$this->display('index-super');
			}else if ($_COOKIE['power'] == 1) {
				// $a_id = 2;   ################## 这个是管理员 id，必须严格控制
				$a_id = $this->in_cookie('aid', None, 1, 'True');

				$good_info = $sqlGood->get_brand($a_id);
				$this->assign('g_info', $good_info);

				// 获取配送员信息
				$sender_info = $sqlSend->get_sender($a_id);
				$this->assign('sd_info', $sender_info);

				$this->display('index');
			}
		}
	}


	// 用户登录
	public function login(){
		$safeMod = new safeMod();

		$user = $this->in_post('username', None, 2, 'True');
		$pwd = $this->in_post('password', None, 2, 'True');
		if (strlen($user) < 12 && strlen($pwd) < 12) {
			$res = $safeMod->login($user, $pwd);
		}else{
			$res = False;
		}
		if ($res) {
			$this->redirect('/');
		}else{
			$this->alert('用户名或密码错误');
		}
	}

	// 用户退出
	public function logout(){
		$safeMod = new safeMod();
		$safeMod->logout();
		$this->redirect('/');
	}

}

?>