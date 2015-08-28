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
	public function get_order($a_id, $url, $status = -1, $sender = 0, $school = 0, $cid = 0, $brand = 0, $ex_d = '', $pr_d = ''){
		$con = 'a_id='. $a_id;

		if ($status != -1) {
			$con .= ' and send_status ='.$status;
		}

		if ($sender > 0) {
			$con .= ' and send_id='. $sender;
		}

		if ($school > 0) {
			$con .= ' and s_id='.$school. ' and c_id='.$cid;
		}

		if ($brand > 0) {
			$con .= ' and g_id='.$brand;
		}

		if (!empty($ex_d) and !empty($pr_d)) {
			$con .= ' and created >=\'' .$ex_d. '\' and created <=\''.$pr_d.'\'';
		}
		$con .= ' and flag = 0';

		$page = new Page();
		$listRows = 5; //产品每页显示的信息条数
		// $url=__URL__.'?p={page}';//分页基准网址
		$cur_page = $page->getCurPage($url);
		$limit_start = ($cur_page-1)*$listRows;
		$limit = $limit_start.','.$listRows;

		$field1 = 'o_id';
		$count = $this->model->table($this->config['order'])->field($field1)->where($con)->count();
		$page = $page->show($url,$count,$listRows);

		$field = 'o_id, addr, name, phone, created, s_name, c_name, g_name, num, pay_type, send_status, send_id, send_name';
		$res = $this->model->table($this->config['order'])->field($field)->where($con)->limit($limit)->order('DATE_FORMAT(created, \'%Y-%m-%d\') asc, addr asc')->select();

		return array('info'=>$res, 'page'=>$page);
	}

	// mark = 1 表示标记为正在配送，然后再导出，  否则只是普通导出而已
	public function export_order($mark, $a_id, $status = -1, $sender = 0, $school = 0, $cid = 0, $brand = 0, $ex_d = '', $pr_d = ''){
		$con = 'a_id='. $a_id;

		if ($mark == 1) {
			$con .= ' and send_status = 0';
		}else{
			if ($status != -1) {
				$con .= ' and send_status ='.$status;
			}
		}

		if ($sender > 0) {
			$con .= ' and send_id='. $sender;
		}

		if ($school > 0) {
			$con .= ' and s_id='.$school. ' and c_id='.$cid;
		}

		if ($brand > 0) {
			$con .= ' and g_id='.$brand;
		}

		if (!empty($ex_d) and !empty($pr_d)) {
			$con .= ' and created >=\'' .$ex_d. '\' and created <=\''.$pr_d.'\'';
		}
		$con .= ' and flag = 0';
		$field = 'o_id, addr, name, phone, created, s_name, g_name, c_name, num, pay_type, send_status, send_id, send_name';

		if ($mark == 1) {
			$data['send_status'] = 1;
			$res = $this->model->table($this->config['order'])->data($data)->where($con)->update();

			if ($res) {
				$export_con = 'a_id='. $a_id;
				if ($school > 0) {
					$export_con .= ' and s_id='.$school. ' and c_id='.$cid;
				}
				$export_con = str_replace('send_status = 0', 'send_status = 1', $export_con);
				$last_time = date('Y-m-d H:i:s',strtotime("-10 minute"));  // 避免出现极端情况
				$export_con .= ' and update_time > \''.$last_time.'\'';
				$res = $this->model->table($this->config['order'])->field($field)->where($export_con)->order('DATE_FORMAT(created, \'%Y-%m-%d\') asc, addr asc')->select();
			}else{
				echo "设置失败";
			}
		}else{
			$res = $this->model->table($this->config['order'])->field($field)->where($con)->order('DATE_FORMAT(created, \'%Y-%m-%d\') asc, addr asc')->select();
		}
		return $res;
	}

	/**
	* 设置订单已完成
	* @param a_id  销售商
	* @param ids  订单 o_id
	*/
	public function set_order_finish($a_id, $ids){
		$con = 'a_id='. $a_id . ' and o_id in ('. $ids . ')';
		$data['send_status'] = 2;
		
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


	/////////////////////////////////////////

	/**
	* 获取预订订单
	* @param a_id  销售员在本系统的 id 编号
	* @param type  若为 1 表示要获取普通信息，为 2 表示要获取详细信息
	* @param g_id  若为 0， 表示获取所有产品，若为 其它表示获取某款产品的信息
	*/
	public function get_order_pre($a_id, $url, $school = 0, $cid =0, $brand = 0, $ex_d = '', $pr_d = ''){
		$con = 'a_id='. $a_id;

		if ($school > 0) {
			$con .= ' and s_id='.$school. ' and c_id='.$cid;
		}

		if ($brand > 0) {
			$con .= ' and g_id='.$brand;
		}

		if (!empty($ex_d) and !empty($pr_d)) {
			$con .= ' and created >=\'' .$ex_d. '\' and created <=\''.$pr_d.'\'';
		}

		$page = new Page();
		$listRows = 5; //产品每页显示的信息条数
		// $url=__URL__.'?p={page}';//分页基准网址
		$cur_page = $page->getCurPage($url);
		$limit_start = ($cur_page-1)*$listRows;
		$limit = $limit_start.','.$listRows;

		$field1 = 'o_id';
		$count = $this->model->table('order_pre')->field($field1)->where($con)->count();
		$page = $page->show($url,$count,$listRows);

		$field = 'o_id, name, phone, s_name, g_name, c_name, addr, pre_num, left_num, update_time';
		$res = $this->model->table('order_pre')->field($field)->where($con)->limit($limit)->order('update_time desc, addr asc')->select();

		return array('info'=>$res, 'page'=>$page);
	}

	public function export_order_pre($a_id, $school = 0, $cid =0, $brand = 0, $ex_d = '', $pr_d = ''){
		$con = 'a_id='. $a_id;

		if ($school > 0) {
			$con .= ' and s_id='.$school. ' and c_id='.$cid;
		}

		if ($brand > 0) {
			$con .= ' and g_id='.$brand;
		}

		if (!empty($ex_d) and !empty($pr_d)) {
			$con .= ' and created >=\'' .$ex_d. '\' and created <=\''.$pr_d.'\'';
		}

		$field = 'o_id, name, phone, s_name, g_name, c_name, addr, pre_num, left_num, update_time';
		$res = $this->model->table('order_pre')->field($field)->where($con)->order('update_time desc, addr asc')->select();
		return $res;
	}

	//////////////////////
	/**
	* 根据其父 id 值，获取产品的id，只能有一个
	* @param brand  父 id
	*/
	public function get_fid_gid($brand, $sc){
		$field = 'g_id';
		$con = 'f_id='. $brand .' and s_id='.$sc;
		$res = $this->model->table($this->config['goods'])->field($field)->where($con)->find();

		if ($res) {
			return $res['g_id'];
		}else{
			return False;
		}
	}
	
	
	///////////////////////////////////////////////////////////// 以上这些全开放给经销商自己管理 

	///////////////////////////////////////////////////////////// 以下这些只面向管理员
	/**
	* 获取所有经销商的订单
	* @param a_id  销售员在本系统的 id 编号
	*/
	public function get_order_super($url, $status = -1, $school = 0, $cid = 0, $aid = 0, $ex_d = '', $pr_d = ''){
		$con = 's_id='.$school. ' and c_id='.$cid;

		if ($aid > 0) {
			$con .= ' and a_id='.$aid;
		}

		if ($status != -1) {
			$con .= ' and send_status ='.$status;
		}

		if (!empty($ex_d) and !empty($pr_d)) {
			$con .= ' and created >=\'' .$ex_d. '\' and created <=\''.$pr_d.'\'';
		}

		$page = new Page();
		$listRows = 15; //产品每页显示的信息条数
		// $url=__URL__.'?p={page}';//分页基准网址
		$cur_page = $page->getCurPage($url);
		$limit_start = ($cur_page-1)*$listRows;
		$limit = $limit_start.','.$listRows;

		$field1 = 'o_id';
		$count = $this->model->table($this->config['order'])->field($field1)->where($con)->count();
		$page = $page->show($url,$count,$listRows);

		$field = 'addr, name, phone, created, s_name, c_name, g_name, num, pay_type, send_status';
		$res = $this->model->table($this->config['order'])->field($field)->where($con)->limit($limit)->order('DATE_FORMAT(created, \'%Y-%m-%d\') asc, addr asc')->select();

		return array('info'=>$res, 'page'=>$page);
	}

	// 导出数据
	public function export_order_super($status = -1, $school = 0, $cid = 0, $aid = 0, $ex_d = '', $pr_d = ''){
		$con = 's_id='.$school. ' and c_id='.$cid;

		if ($aid > 0) {
			$con .= ' and a_id='.$aid;
		}

		if ($status != -1) {
			$con .= ' and send_status ='.$status;
		}

		if (!empty($ex_d) and !empty($pr_d)) {
			$con .= ' and created >=\'' .$ex_d. '\' and created <=\''.$pr_d.'\'';
		}

		$field = 'addr, name, phone, created, s_name, c_name, g_name, num, pay_type, send_status';
		$res = $this->model->table($this->config['order'])->field($field)->where($con)->limit($limit)->order('DATE_FORMAT(created, \'%Y-%m-%d\') asc, addr asc')->select();

		return $res;
	}
}

?>