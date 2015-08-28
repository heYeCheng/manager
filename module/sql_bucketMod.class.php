<?php
class sql_bucketMod extends commonMod{
	// 管理订单模块
	
	///////////////////////////////////////////////////////////// 以下这些全开放给经销商自己管理 
	/**
	* 获取此管理员所有空桶情况
	* @param a_id  销售员在本系统的 id 编号
	* @param addr  若为 0， 表示获取所有宿舍，若为 其它表示某宿舍楼
	*/
	public function get_bucket($a_id, $url, $school, $cid = 0, $addr = 0){
		$con = 'a_id='. $a_id;

		if ($school > 0) {
			$con .= ' and s_id = ' .$school. ' and c_id='.$cid;
		}
		if ($addr > 0) {
			$con .= ' and addr like \'' .$addr. '-%\'';
		}

		$page = new Page();
		$listRows = 15; //产品每页显示的信息条数
		// $url=__URL__.'?p={page}';//分页基准网址
		$cur_page = $page->getCurPage($url);
		$limit_start = ($cur_page-1)*$listRows;
		$limit = $limit_start.','.$listRows;

		$field1 = 'id';
		$count = $this->model->table('dormit_water')->field($field1)->where($con)->count();
		$page = $page->show($url,$count,$listRows);

		$field = 'id, s_name, addr, wait_recyle, status, update_time';
		$res = $this->model->table('dormit_water')->field($field)->where($con)->limit($limit)->order('addr desc')->select();

		return array('info'=>$res, 'page'=>$page);
	}

	public function export_bucket($mark, $a_id, $school, $cid = 0, $addr = 0){
		$con = 'a_id='. $a_id;
		
		if ($school > 0) {
			$con .= ' and s_id = ' .$school. ' and c_id='.$cid;
		}
		if ($addr > 0) {
			$con .= ' and addr like \'' .$addr. '-%\'';
		}

		if ($mark == 1) {  // 表示将这批数据设置为 正在回收水桶状态中
			$check_con = $con. ' and status = 1';   // 判断是否还有宿舍在回收水桶，如果有，必需先回收完毕才可以继续打印
			$check_field = 'id';
			$res = $this->model->table('dormit_water')->field($check_field)->where($check_con)->find();
			if ($res) {
				return 'error';
			}else{
				$data = '`recyling` = `wait_recyle`, `status` = 1';
				$res = $this->model->table('dormit_water')->data($data)->where($con)->update();
				if ($res) {
					$field = 's_name, addr, wait_recyle, update_time';
					$res = $this->model->table('dormit_water')->field($field)->where($check_con)->order('addr desc')->select();
					return $res;
				}else{
					return False;
				}
			}
		}else{
			$field = 's_name, addr, wait_recyle, update_time';
			$res = $this->model->table('dormit_water')->field($field)->where($con)->order('addr desc')->select();
			return $res;
		}
	}

	/**
	* 设置空桶回收已完成
	* @param a_id  销售商
	*/
	public function mark_bucket($a_id, $school, $cid = 0, $addr = 0){
		$con = 'a_id='. $a_id;
		
		if ($school > 0) {
			$con .= ' and s_id = ' .$school. ' and c_id='.$cid;
		}
		if ($addr > 0) {
			$con .= ' and addr like \'' .$addr. '-%\'';
		}
		$con .= ' and status = 1';
		$data = '`recyled_bucket` =`recyled_bucket` + `recyling` , `wait_recyle` = `wait_recyle` - `recyling`, `status` = 0';
		$res = $this->model->table('dormit_water')->data($data)->where($con)->update();

		return $res;
	}

	/**
	* 更新某个宿舍的空桶剩余数量
	* @param a_id  销售商
	*/
	public function change_bucket($a_id, $school, $id, $num){
		$con = 'a_id='. $a_id .' and s_id = ' .$school. ' and id='.$id;
		
		$data = '`recyled_bucket` =`order_water` - `last_order_water` - '.$num.' , `wait_recyle` = '.$num;
		$res = $this->model->table('dormit_water')->data($data)->where($con)->update();

		return $res;
	}
}

?>