<?php
require_once('./module/sql_orderMod.class.php');

class obossMod extends commonMod{
	public function index(){
		$sqlOrder = new sql_orderMod();
		// get_order($a_id, $date = date('Y-m-d H',strtotime('-3 day')), $status = '', $sender = 0, $school = 0, $brand = 0)
		$a_id = $this->in_cookie('aid', None, 1, 'True');
		
		$temp = $_GET['status'];
		if (is_numeric($temp)) {
			$status = $temp;
		}else{
			$status = -1;
		}
		$sender = $this->in_get('sd', 0, 1);
		$school = $this->in_get('sc', 0, 1);
		$cid = $this->in_get('cid', 0, 1);
		$brand = $this->in_get('brand', 0, 1);
		$ex_d = $this->in_get('ex_d', date('Y-m-d'), 2);
		$pr_d = $this->in_get('pr_d', date('Y-m-d', strtotime('+1 day')), 2);

		$url = preg_replace("/&p=\d+/", '', $_SERVER['REQUEST_URI']);
		$url .= '&p={page}';
		$url = str_replace('oboss&p', 'oboss?p', $url);

		if ($brand > 0 && $school > 0) {
			$fid = $sqlOrder->get_fid_gid($brand, $school);
			if ($fid) {
				$res = $sqlOrder->get_order($a_id, $url, $status, $sender, $school, $cid, $fid, $ex_d, $pr_d);
			}else{
				echo ('没有该品牌的订水情况');
				$res = array('info' => '', 'page' => '');
			}
		}else{
			$res = $sqlOrder->get_order($a_id, $url, $status, $sender, $school, $cid, $brand, $ex_d, $pr_d);
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
		$mark = $this->in_get('mark', 0, 1);
		$sender = $this->in_get('sd', 0, 1);
		$school = $this->in_get('sc', 0, 1);
		$cid = $this->in_get('cid', 0, 1);
		$brand = $this->in_get('brand', 0, 1);
		$ex_d = $this->in_get('ex_d', date('Y-m-d'), 2);
		$pr_d = $this->in_get('pr_d', date('Y-m-d', strtotime('+1 day')), 2);

		if ($brand > 0 && $school > 0) {
			$fid = $sqlOrder->get_fid_gid($brand, $school);
			if ($fid) {
				$res = $sqlOrder->export_order($mark, $a_id, $status, $sender, $school, $cid, $fid, $ex_d, $pr_d);
			}else{
				$this->alert('没有该品牌的订水情况');
				$res = '';
			}
		}else{
			$res = $sqlOrder->export_order($mark, $a_id, $status, $sender, $school, $cid, $brand, $ex_d, $pr_d);
		}
		if ($res) {
			header("Content-Type: application/$file_type;charset=gbk");
			header("Content-Disposition: attachment; filename=1.xls");
			header("Pragma: no-cache");
			$title = "日期\t用户名\t手机号\t学校\t宿舍号\t品牌\t数量\t送货员\t结算方式\n";
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
				echo $value['created']. "\t".$value['name']. "\t".$value['phone']. "\t".$value['s_name'].'-'.$value['c_name']. "\t".$value['addr']. "\t".$value['g_name']. "\t".$value['num']. "\t".$value['send_name']. "\t".$pay_type. "\n";
			}
		}else{
			$this->alert('没有找到相关数据');
		}
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