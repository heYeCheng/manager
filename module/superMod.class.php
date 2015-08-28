<?php
require_once('./module/sql_orderMod.class.php');
require_once('./module/sql_userMod.class.php');

class superMod extends commonMod{
	public function index(){
		$sqlOrder = new sql_orderMod();
		$a_id = $this->in_cookie('aid', None, 1, 'True');
		
		$temp = $_GET['status'];
		if (is_numeric($temp)) {
			$status = $temp;
		}else{
			$status = -1;
		}
		$school = $this->in_get('sc', 0, 1, True);
		$cid = $this->in_get('cid', 0, 1);
		$aid = $this->in_get('sell', 0, 1);
		$ex_d = $this->in_get('ex_d', date('Y-m-d'), 2);
		$pr_d = $this->in_get('pr_d', date('Y-m-d', strtotime('+1 day')), 2);

		$url = preg_replace("/&p=\d+/", '', $_SERVER['REQUEST_URI']);
		$url .= '&p={page}';
		$url = str_replace('super&p', 'super?p', $url);

		$res = $sqlOrder->get_order_super($url, $status, $school, $cid, $aid, $ex_d, $pr_d);
		if (!$res) {
			echo ('没有该品牌的订水情况');
			$res = array('info' => '', 'page' => '');
		}
		
		$this->assign('o_info', $res['info']);
		$this->assign('page', $res['page']);
		$this->display('order_boss');
	}

	public function export(){
		$sqlOrder = new sql_orderMod();
		$a_id = $this->in_cookie('aid', None, 1, 'True');
		
		$temp = $_GET['status'];
		if (is_numeric($temp)) {
			$status = $temp;
		}else{
			$status = -1;
		}
		$school = $this->in_get('sc', 0, 1, True);
		$cid = $this->in_get('cid', 0, 1);
		$aid = $this->in_get('sell', 0, 1);
		$ex_d = $this->in_get('ex_d', date('Y-m-d'), 2);
		$pr_d = $this->in_get('pr_d', date('Y-m-d', strtotime('+1 day')), 2);

		$res = $sqlOrder->export_order_super($status, $school, $cid, $aid, $ex_d, $pr_d);
		if (!$res) {
			echo ('没有该品牌的订水情况');
		}

		if ($res) {
			header("Content-Type: application/$file_type;charset=gbk");
			header("Content-Disposition: attachment; filename=1.xls");
			header("Pragma: no-cache");
			$title = "日期\t用户名\t手机号\t学校\t宿舍号\t品牌\t数量\t结算方式\t状态\n";
			echo("$title");

			foreach ($res as $key => $value) {
				if ($value['pay_type'] == 0) {
					$pay_type = '预付+提水';
				}else if ($value['pay_type'] == 1) {
					$pay_type = '提水';
				}else if ($value['pay_type'] == 2) {
					$pay_type = '线下支付';
				}else if ($value['pay_type'] == 3) {
					$pay_type = '积分兑换';
				}

				if ($value['send_status'] == 0) {
					$send_status = '未配送';
				}else if ($value['send_status'] == 1) {
					$send_status = '正在配送';
				}else if ($value['send_status'] == 2) {
					$send_status = '已配送';
				}
				echo $value['created']. "\t".$value['name']. "\t".$value['phone']. "\t".$value['s_name'].'-'.$value['c_name']. "\t".$value['addr']. "\t".$value['g_name']. "\t".$value['num']. "\t".$vpay_type. "\t".$send_status. "\n";
			}
		}else{
			$this->alert('没有找到相关数据');
		}
	}
	

	public function user(){
		$sqlUser = new sql_userMod();

		$school = $this->in_get('sc', 0, 1, True);
		$cid = $this->in_get('cid', 0, 1);
		$ex_d = $this->in_get('ex_d', date('Y-m-d'), 2);
		$pr_d = $this->in_get('pr_d', date('Y-m-d', strtotime('+1 day')), 2);

		$url = preg_replace("/&p=\d+/", '', $_SERVER['REQUEST_URI']);
		$url .= '&p={page}';
		$url = str_replace('user&p', 'user?p', $url);

		$res = $sqlUser->get_user_super($url, $school, $cid, $ex_d, $pr_d);
		if (!$res) {
			echo ('没有该品牌的订水情况');
			$res = array('info' => '', 'page' => '');
		}
		
		$this->assign('o_info', $res['info']);
		$this->assign('page', $res['page']);
		$this->display('user_list');
	}
}

?>