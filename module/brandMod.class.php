<?php
// 处理所有与品牌有关的请求
require_once('./module/sql_goodMod.class.php');

class brandMod extends commonMod{
	public function index(){
		// 全部必须进行校验
		exit();
	}
	
	/**
	* 处理某品牌
	* @param type  若为 show, 表示获取该品牌信息；若为 del，表示删除该品牌的信息；若为 add，表示添加该品牌信息
	* @param g_id  若为 0， 表示获取所有产品，若为 其它表示获取某款产品的信息
	*/
	public function handleBrand(){
		$sqlGood = new sql_goodMod();

		$type = $this->in_get('type', None, 2, 'True');
		$a_id = $this->in_cookie('aid', None, 1, 'True');

		switch ($type) {
			case 'show':
				$g_id = $this->in_get('id', None, 1, 'True');
				$good_info = $sqlGood->get_brand($a_id, 2, $g_id);
				echo json_encode($good_info);
				break;
			case 'add':
				$name = $this->in_get('name', None, 2, 'True');
				$res = $sqlGood->add_brand($a_id, $name);
				if ($res) {
					$this->alert('添加成功', __ROOT__.'/index');
				}else{
					$this->alert('添加失败');
				}
				break;
			case 'del':
				$g_id = $this->in_get('id', None, 1, 'True');
				$res = $sqlGood->del_brand($a_id, $g_id);
				if ($res) {
					$this->alert('删除成功', __ROOT__.'/index');
				}else{
					$this->alert('删除失败');
				}
				break;
			default:
				# code...
				break;
		}
		
	}

	public function saveBasic(){
		$sqlGood = new sql_goodMod();

		$g_id = $this->in_get('id', None, 1, 'True');
		$money = $this->in_get('moneyBarrel', None, 2, 'True');
		$point = $this->in_get('pointBarrel', None, 1, 'True');
		$a_id = $this->in_cookie('aid', None, 1, 'True');

		$update_res = $sqlGood->set_brand_info_basic($a_id, $g_id, $money, $point);

		if ($update_res) {
			$this->alert('更新成功');
		}else{
			$this->alert('更新失败');
		}
	}

	public function saveBasic_Pic(){
		$sqlGood = new sql_goodMod();

		$g_id = $this->in_post('id', None, 1, 'True');
		$a_id = $this->in_cookie('aid', None, 1, 'True');

		$upload = new UploadFile();
		//设置上传文件大小
		$upload->maxSize=1024*1024*2;//最大2M
		//设置上传文件类型
		$upload->allowExts  = explode(',','jpg,gif,png');
	
		//设置附件上传目录
		$upload->savePath ='../public/image/';
		$upload->saveRule = cp_uniqid;

		if(!$upload->upload()){
			//捕获上传异常
			$error_res = $this->error($upload->getErrorMsg());
			dump($error_res);
		}else {
			//取得成功上传的文件信息
			$up_res = $upload->getUploadFileInfo();
		}

		$ex_path = 'image/';
		$update_res = $sqlGood->set_brand_info_pic($a_id, $g_id, $ex_path.$up_res[0]['savename']);

		if ($update_res) {
			$this->alert('更新成功');
		}else{
			$this->alert('更新失败');
		}
	}
	

	///////////////////////////////////////////////////////////// 以上这些全开放给经销商自己管理 

	///////////////////////////////////////////////////////////// 以下这些只面向管理员
	/**
	* 此块只能获取基本的销售商信息
	* @param a_id  销售员在本系统的 id 编号
	* @param g_id  若为 0， 表示获取所有产品，若为 其它表示获取某款产品的信息
	*/
	public function get_admin_info(){
		/////////// 必须验证管理员身份

		$field = 'a_id, sell_name';
		$con['power'] = 1;
		$res = $this->model->table($this->config['admin'])->field($field)->where($con)->select();
		
		$return_arr = array();
		foreach ($res as $value) {
			$return_arr[$value['a_id']] = $value['sell_name'];
		}
		echo json_encode($return_arr);
	}

	// 获取某个学校拥有的所有有机会上架的品牌
	public function get_school_brand(){
		$sqlGood = new sql_goodMod();
		$s_id = $this->in_get('id', None, 1, 'True');
		$res = $sqlGood->get_brand_manager($s_id);
		echo json_encode($res);
	}

	// 用于删除某个学校的某个品牌的水
	public function del_school_brand(){
		$sqlGood = new sql_goodMod();
		$s_id = $this->in_get('id', None, 1, 'True');
		$g_id = $this->in_get('gid', None, 1, 'True');
		$res = $sqlGood->del_good_manager($s_id, $g_id);
		echo "suss";
	}

	// 用于保存水品牌
	public function save_school_brand(){
		$sqlGood = new sql_goodMod();

		$json = $this->in_post('json', None, 2, 'True');
		$json = urldecode($json);
		$json = json_decode($json, True);
		$s_id = $this->in_post('id', None, 1, 'True');

		$oldObj = $json['oldO'];
		$newObj = $json['newO'];

		foreach ($newObj as $value) {
			$price = floatval($value[1]);
			$point = intval($value[2]);
			$f_id = intval($value[0]);

			$good_res = $sqlGood->get_good_manager($f_id);
			if ($good_res) {
				$data['t_id'] = 1;
				$data['f_id'] = $f_id;
				$data['s_id'] = $s_id;
				$data['a_id'] = $good_res['a_id'];
				$data['g_name'] = $good_res['g_name'];
				$data['pic'] = $good_res['pic'];
				$data['price'] = $price;
				$data['point'] = $point;

				$this->model->table($this->config['goods'])->data($data)->insert();
			}
		}

		foreach ($oldObj as $value) {
			$price = floatval($value[1]);
			$point = intval($value[2]);
			$g_id = intval($value[0]);

			$con['g_id'] = $g_id;
			$up_data['price'] = $price;
			$up_data['point'] = $point;

			$this->model->table($this->config['goods'])->data($up_data)->where($con)->update();
		}

		echo "suss";
	}

	// 用于删除某商品
	
}

?>