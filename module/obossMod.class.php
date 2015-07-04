<?php
require_once('./module/sql_orderMod.class.php');

class obossMod extends commonMod{
	public function index(){
		$sqlOrder = new sql_orderMod();

		// get_order($a_id, $date = date('Y-m-d H',strtotime('-3 day')), $status = '', $sender = 0, $school = 0, $brand = 0)
		$a_id = $this->in_cookie('aid', None, 1, 'True');
		
		$status = $this->in_get('status', '', 2);
		$sender = $this->in_get('sd', 0, 1);
		$school = $this->in_get('sc', 0, 1);
		$brand = $this->in_get('brand', 0, 1);
		$ex_d = $this->in_get('ex_d', '', 2);
		$pr_d = $this->in_get('pr_d', '', 2);

		$url = preg_replace("/&p=\d+/", '', $_SERVER['REQUEST_URI']);
		$url .= '&p={page}';

		$res = $sqlOrder->get_order($a_id, $url, $status, $sender, $school, $brand, $ex_d, $pr_d);

		// dump($res['info']);exit();
		$this->assign('o_info', $res['info']);
		$this->assign('page', $res['page']);
		$this->display('order_boss');
	}

	public function mark(){
		$sqlOrder = new sql_orderMod();

		$a_id = $this->in_cookie('aid', None, 1, 'True');
		$ids = $this->in_post('ids', '', 2, 'True');
		$action = $this->in_post('action', '', 2, 'True');

		$idArr = explode('@@', $ids);
		foreach ($idArr as $value) {
			if (strlen($value) < 17) {
				$tempArr[] = '\''.$value.'\'';
			}
		}
		$ids = implode(',', $tempArr);
		if (strlen($ids) < 6) {
			$action = 'useless';
		}

		switch ($action) {
			case 'finish':
				$res = $sqlOrder->set_order_finish($a_id, $ids);
				break;
			case 'del':
				$res = $sqlOrder->set_order_del($a_id, $ids);
				break;
			default:
				$res = 0;
				break;
		}

		if ($res) {
			echo 1;
		}else{
			echo 0;
		}
	}

	

}

?>