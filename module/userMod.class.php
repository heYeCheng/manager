<?php
require_once('./module/sql_userMod.class.php');

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


}