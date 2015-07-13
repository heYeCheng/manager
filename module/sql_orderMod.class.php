<?php
class sql_orderMod extends commonMod{
	// 管理订单模块
	
	///////////////////////////////////////////////////////////// 以下这些全开放给经销商自己管理 
	/**
	* 获取此管理员所有品牌信息
	* @param a_id  销售员在本系统的 id 编号
	* @param type  若为 1 表示要获取普通信息，为 2 表示要获取详细信息
	* @param g_id  若为 0， 表示获取所有产品，若为 其它表示获取某款产品的信息
	*/
	public function get_order($a_id, $url, $status = -1, $sender = 0, $school = 0, $brand = 0, $ex_d = '', $pr_d = ''){
		$con = 'a_id='. $a_id;

		if ($status != -1) {
			$con .= ' and send_status ='.$status;
		}

		if ($sender > 0) {
			$con .= ' and send_id='. $sender;
		}

		if ($school > 0) {
			$con .= ' and s_id='.$school;
		}

		if ($brand > 0) {
			$con .= ' and g_id='.$brand;
		}

		if (!empty($ex_d) and !empty($pr_d)) {
			$con .= ' and created >=\'' .$ex_d. '\' and created <=\''.$pr_d.'\'';
		}
		$con .= ' and flag = 0';

		$page = new Page();
		$listRows = 1; //产品每页显示的信息条数
		// $url=__URL__.'?p={page}';//分页基准网址
		$cur_page = $page->getCurPage($url);
		$limit_start = ($cur_page-1)*$listRows;
		$limit = $limit_start.','.$listRows;

		$field1 = 'o_id';
		$count = $this->model->table($this->config['order'])->field($field1)->where($con)->count();
		$page = $page->show($url,$count,$listRows);

		$field = 'o_id, addr, name, phone, created, s_name, g_name, num, pay_type, send_status, send_id, send_name';
		$res = $this->model->table($this->config['order'])->field($field)->where($con)->limit($limit)->order('DATE_FORMAT(created, \'%Y-%m-%d\') asc, addr asc')->select();

		return array('info'=>$res, 'page'=>$page);
	}

	public function export_order($a_id, $status = -1, $sender = 0, $school = 0, $brand = 0, $ex_d = '', $pr_d = ''){
		$con = 'a_id='. $a_id;

		if ($status != -1) {
			$con .= ' and send_status ='.$status;
		}

		if ($sender > 0) {
			$con .= ' and send_id='. $sender;
		}

		if ($school > 0) {
			$con .= ' and s_id='.$school;
		}

		if ($brand > 0) {
			$con .= ' and g_id='.$brand;
		}

		if (!empty($ex_d) and !empty($pr_d)) {
			$con .= ' and created >=\'' .$ex_d. '\' and created <=\''.$pr_d.'\'';
		}
		$con .= ' and flag = 0';

		$field = 'o_id, addr, name, phone, created, s_name, g_name, num, pay_type, send_status, send_id, send_name';
		$res = $this->model->table($this->config['order'])->field($field)->where($con)->order('DATE_FORMAT(created, \'%Y-%m-%d\') asc, addr asc')->select();
		return $res;
	}

	/**
	* 设置订单已完成
	* @param a_id  销售商
	* @param ids  订单 o_id
	*/
	public function set_order_finish($a_id, $ids){
		$con = 'a_id='. $a_id . ' and o_id in ('. $ids . ')';
		$data['status'] = 'TRADE_CLOSED';
		
		$res = $this->model->table($this->config['order'])->data($data)->where($con)->update();
		return $res;
	}

	/**
	* 设置订单删除
	* @param a_id  销售商
	* @param ids  订单 o_id
	*/
	public function set_order_del($a_id, $ids){
		$con = 'a_id='. $a_id . ' and o_id in ('. $ids . ')';

		$data['flag'] = 1;
		
		$res = $this->model->table($this->config['order'])->data($data)->where($con)->update();
		return $res;
	}

	
	
	///////////////////////////////////////////////////////////// 以上这些全开放给经销商自己管理 

	///////////////////////////////////////////////////////////// 以下这些只面向管理员
	
}

?>