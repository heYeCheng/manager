<?php
class sql_userMod extends commonMod{

	
	public function get_school(){
		$field = 's_id as id, name';
		$res = $this->model->table($this->config['school'])->field($field)->select();
		return $res;
	}

	public function get_user($url, $name = '', $schoolName = ''){
		$page = new Page();
		$listRows = 1;//产品每页显示的信息条数
		$field = 'name, addr, phone, s_name, point';
		
		// $url=__URL__.'?p={page}';//分页基准网址
		$cur_page = $page->getCurPage($url);
		$limit_start = ($cur_page-1)*$listRows;
		$limit=$limit_start.','.$listRows;

		$con = '';
		if (!empty($schoolName)) {
			$con = 's_id=\''.$schoolName.'\'';
		}
		if (!empty($name)) {
			if (empty($con)) {
				$con = 'name like \'%'.$name.'%\'';
			}else{
				$con .= ' and name like \'%'.$name.'%\'';
			}
		}

		if (empty($con)) {
			$count=$this->model->table($this->config['info_person'])->count();
			$sql=$this->model->table($this->config['info_person'])->field($field)->limit($limit)->select();
		}else{
			$count=$this->model->table($this->config['info_person'])->where($con)->count();
			$sql=$this->model->table($this->config['info_person'])->field($field)->where($con)->limit($limit)->select();
		}
		return array('data' => $sql, 'page' => $page->show($url,$count,$listRows));
	}

}