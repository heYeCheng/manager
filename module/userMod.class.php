<?php
require_once(__DIR__.'/sql_userMod.class.php');

class userMod extends commonMod{

	public function index(){
		$sqlUser = new sql_userMod();

		$sc_res = $sqlUser->get_school();
		$this->assign("sc_res", $sc_res);

		$url = __URL__.'?p={page}'; //分页基准网址
		$array = $sqlUser->get_user($url);
		$this->assign("data", $array['data']);
		$this->assign("page_show", $array['page']);
		
		$this->display('user');
	}

	public function get_user_list(){
		$sqlUser = new sql_userMod();

		$con = '?type=1';
		if (isset($_GET['name'])) {
			$name = $_GET['name'];
			$con .= '&name='.$name;
		}
		if (isset($_GET['sc'])) {
			$sc_name = $_GET['sc'];
			$con .= '&sc='.$sc_name;
		}
		
		$url = __URL__.'/get_user_list'.$con.'&p={page}'; //分页基准网址
		$url = __URL__.'?p={page}'; //分页基准网址

		$array = $sqlUser->get_user($url, $name, $sc_name);
		echo json_encode($array);
	}

	/**
	* 当用户第一次关注公众号的时候，进行数据库插入操作
	* @param referer  0 为搜索关注，1 为二维码关注
	* @param type  二维码类型，1 为临时二维码，2为永久
	*/
	public function weixin_subscribe($openid, $referer = 0, $sell_id = 0){
		$sqlUser = new sql_userMod();
		$res = $sqlUser->get_user_openid($openid);
		if ($res) {
			$sqlUser->set_user_subscribe($res['p_id'], $res['sub_time'] + 1);
		}else{
			$r = connectRedis($this->config['RD_HOST'], $this->config['RD_PORT'], $this->config['RD_DB']);
			$token = $r->get('token');
			$wx_res = Weixin::get_user_info($token, $openid);
			if ($wx_res) {
				$res = $sqlUser->add_user_subscribe($wx_res, $referer, str_replace('sell_id', '', $sell_id));
				dump($res);
			}
		}
	}
}