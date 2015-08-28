<?php
class sql_sendMod extends commonMod{
	// 配送员有模块
	
	///////////////////////////////////////////////////////////// 以下这些全开放给经销商自己管理 
	/**
	* 获取此经销商的配送员
	* @param a_id  销售商
	* @param s_id  销售员所属学校 id
	*/
	public function get_sender($a_id, $s_id = 0){
		$con['a_id'] = $a_id;
		if ($s_id > 0) {
			$con['s_id'] = $s_id;
		}

		$field = 'send_id, name';
		
		$res = $this->model->table($this->config['send'])->field($field)->where($con)->select();
		return $res;
	}


	/**
	* 增加配送员
	* @param a_id  销售商
	* @param name  配送员名字
	*/
	public function add_send($a_id, $name){
		$data['a_id'] = $a_id;
		$data['name'] = $name;
		$res = $this->model->table($this->config['send'])->data($data)->insert();
		return $res;
	}

	/**
	* 删除配送员
	* @param a_id  销售商
	* @param name  配送员名字
	*/
	public function del_send($a_id, $send_id){
		$con['a_id'] = $a_id;
		$con['send_id'] = $send_id;
		$res = $this->model->table($this->config['send'])->where($con)->delete();
		return $res;
	}

	/**
	* 获取某配送员的信息
	* @param a_id  销售商
	* @param send_id  配送员 id
	*/
	public function get_send_info($a_id, $send_id){
		$con['send_id'] = $send_id;
		$con['a_id'] = $a_id;
		$field = 's_id, c_id, addr';
		
		$res = $this->model->table($this->config['send'])->field($field)->where($con)->find();
		return $res;
	}

	/**
	* 获取某配送员的信息
	* @param a_id  销售商
	* @param send_id  配送员 id
	*/
	public function set_send_info($a_id, $send_id, $s_id, $c_id, $addr){
		$con['send_id'] = $send_id;
		$con['a_id'] = $a_id;
		$data['addr'] = $addr;
		$data['s_id'] = $s_id;
		$data['c_id'] = $c_id;
		
		$res = $this->model->table($this->config['send'])->data($data)->where($con)->update();
		return $res;
	}
	
	
	///////////////////////////////////////////////////////////// 以上这些全开放给经销商自己管理 

	///////////////////////////////////////////////////////////// 以下这些只面向管理员
	
}

?>