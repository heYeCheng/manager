<?php
class sql_goodMod extends commonMod{
	// 管理员获取商品信息模块
	
	///////////////////////////////////////////////////////////// 以下这些全开放给经销商自己管理 
	/**
	* 获取此管理员所有品牌信息
	* @param a_id  销售员在本系统的 id 编号
	* @param type  若为 1 表示要获取普通信息，为 2 表示要获取详细信息
	* @param g_id  若为 0， 表示获取所有产品，若为 其它表示获取某款产品的信息
	*/
	public function get_brand($a_id, $type = 1, $g_id = 0){
		$con['a_id'] = $a_id;
		$con['s_id'] = -1;

		if ($type == 1) {
			$field = 'g_id, g_name';
		}else{
			$field = 'g_name, price, point, pic';
		}

		if ($g_id > 0) {
			$con['g_id'] = $g_id;
			$res = $this->model->table($this->config['goods'])->field($field)->where($con)->find();
		}else{
			$res = $this->model->table($this->config['goods'])->field($field)->where($con)->select();
		}
		
		return $res;
	}

	/**
	* 添加品牌
	* @param a_id  销售员在本系统的 id 编号
	* @param g_name  品牌名称
	*/
	public function add_brand($a_id, $g_name){
		$data['t_id'] = 1;   // t_id = 1 表示是 水 这个类别
		$data['a_id'] = $a_id;
		$data['g_name'] = $g_name;
		$data['s_id'] = -1;  // s_id = -1 表示是品牌，不能出售，只能用它来生成相应商品

		$res = $this->model->table($this->config['goods'])->data($data)->insert();
		return $res;
	}

	/**
	* 删除品牌
	* @param a_id  销售员在本系统的 id 编号
	* @param g_id  要删除的 id
	*/
	public function del_brand($a_id, $g_id){
		$con['a_id'] = $a_id;
		$con['g_id'] = $g_id;  

		$res = $this->model->table($this->config['goods'])->where($con)->find();
		if ($res) {
			$res = $this->model->table($this->config['goods'])->where($con)->delete();

			// 删除相应子商品
			$child_con['a_id'] = $a_id;
			$child_con['f_id'] = $g_id;
			$res = $this->model->table($this->config['goods'])->where($child_con)->delete();
			return 'suss';
		}else{
			// 没有数据可以删除
			return 'fail';
		}
	}

	/**
	* 修改品牌信息
	* @param a_id  销售员在本系统的 id 编号
	* @param g_id  若为 0， 表示获取所有产品，若为 其它表示获取某款产品的信息
	*/
	public function set_brand_info_basic($a_id, $g_id, $money, $point){
		$data['price'] = $money;
		$data['point'] = $point;

		$con['g_id'] = $g_id;
		$con['a_id'] = $a_id;
		$res = $this->model->table($this->config['goods'])->data($data)->where($con)->update();
		return $res;
	}

	/**
	* 修改品牌信息
	* @param a_id  销售员在本系统的 id 编号
	* @param g_id  若为 0， 表示获取所有产品，若为 其它表示获取某款产品的信息
	*/
	public function set_brand_info_pic($a_id, $g_id, $pic){
		$data['pic'] = $pic;

		$con['g_id'] = $g_id;
		$con['a_id'] = $a_id;
		$res = $this->model->table($this->config['goods'])->data($data)->where($con)->update();
		return $res;
	}

	
	///////////////////////////////////////////////////////////// 以上这些全开放给经销商自己管理 




	///////////////////////////////////////////////////////////// 以下这些只面向管理员

	/**
	* 获取某商品信息
	* @param g_id  表示获取某款产品的信息
	*/
	public function get_good_manager($g_id){
		$con['s_id'] = -1;
		$con['g_id'] = $g_id;

		$field = 'a_id, g_name, pic';
		$res = $this->model->table($this->config['goods'])->field($field)->where($con)->find();
		
		return $res;
	}

	/**
	* 用于删除某商品
	* @param s_id  学校的 id
	* @param g_id  表示某款产品的 id
	*/
	public function del_good_manager($s_id, $g_id){
		$con['s_id'] = $s_id;
		$con['g_id'] = $g_id;

		$res = $this->model->table($this->config['goods'])->where($con)->delete();
		return $res;
	}

	/**
	* 获取此所有品牌信息，此级别是超级管理员接口
	*/
	public function get_brand_manager($s_id = 0){
		$con['t_id'] = 1;
		if ($s_id > 0) {
			$con['s_id'] = $s_id;
			$field = 'a.sell_name as name, g_id, f_id, g_name, price, point';
		}else{
			$con['s_id'] = -1;
			$field = 'a.sell_name as name, g_id, g_name, price, point';
		}

		$res = $this->model->table('goods as g LEFT JOIN admin as a on a.a_id=g.a_id')->field($field)->where($con)->select();
		return $res;
	}
}

?>