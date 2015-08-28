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


	public function get_user_super($url, $school, $cid, $ex_d = '', $pr_d = ''){
		$con = 's_id='.$school. ' and c_id='.$cid;

		if (!empty($ex_d) and !empty($pr_d)) {
			$con .= ' and reg_time >=\'' .$ex_d. '\' and reg_time <=\''.$pr_d.'\'';
		}

		$page = new Page();
		$listRows = 15; //产品每页显示的信息条数
		// $url=__URL__.'?p={page}';//分页基准网址
		$cur_page = $page->getCurPage($url);
		$limit_start = ($cur_page-1)*$listRows;
		$limit = $limit_start.','.$listRows;

		$field1 = 'p_id';
		$count = $this->model->table($this->config['info_person'])->field($field1)->where($con)->count();
		$page = $page->show($url,$count,$listRows);

		$field = 'addr, name, phone, s_name, c_name, point, reg_time';
		$res = $this->model->table($this->config['info_person'])->field($field)->where($con)->limit($limit)->order('DATE_FORMAT(reg_time, \'%Y-%m-%d\') asc, addr asc')->select();

		return array('info'=>$res, 'page'=>$page);
	}


	/////////////////// 以下方法主要用于用户关注微信号
	/**
	* 根据 openid ，判断有没有这个用户，有就返回id
	* @param openid  微信id
	*/
	public function get_user_openid($openid){
		$field = 'p_id, sub_time';
		$con['openid'] = $openid;
		$res = $this->model->table($this->config['info_person'])->field($field)->where($con)->find();
		return $res;
	}

	public function set_user_subscribe($p_id, $sub_time){
		$con['p_id'] = $p_id;
		$data['sub_time'] = $sub_time;
		$data['if_sub'] = 1;
		$res = $this->model->table($this->config['info_person'])->where($con)->data($data)->update();
	}
	/**
	* 当用户第一次关注公众号的时候，进行数据库插入操作
	* @param id  二维码 id
	* @param type  二维码类型，1 为临时二维码，2为永久
	*/
	public function add_user_subscribe($wx_res, $referer, $sell_id){
		$data['name'] = $wx_res['nickname'];
		$data['openid'] = $wx_res['openid'];
		$data['pic'] = $wx_res['headimgurl'];
		$data['sex'] = $wx_res['sex'];
		$data['city'] = $wx_res['city'];
		$data['province'] = $wx_res['province'];
		$data['referer'] = $referer;
		$data['sell_id'] = intval($sell_id);
		$data['sub_time'] = 1;
		$data['if_sub'] = 1;
		$res = $this->model->table($this->config['info_person'])->data($data)->insert();
		return $res;
	}
}