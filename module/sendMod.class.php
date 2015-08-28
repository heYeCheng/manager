<?php
// 处理所有与品牌有关的请求
require_once('./module/sql_sendMod.class.php');

class sendMod extends commonMod{
	public function index(){
		// 全部必须进行校验
		exit();
	}
	
	/**
	* 处理某品牌
	* @param type  若为 show, 表示获取该品牌信息；若为 del，表示删除该品牌的信息；若为 add，表示添加该品牌信息
	* @param g_id  若为 0， 表示获取所有产品，若为 其它表示获取某款产品的信息
	*/
	public function handleSend(){
		$sqlSend = new sql_sendMod();

		$type = $this->in_get('type', None, 2, 'True');
		$a_id = $this->in_cookie('aid', None, 1, 'True');

		switch ($type) {
			case 'show':
				$send_id = $this->in_get('id', None, 1, 'True');
				$send_info = $sqlSend->get_send_info($a_id, $send_id);
				echo json_encode($send_info);
				break;
			case 'add':
				$name = $this->in_get('name', None, 2, 'True');
				$res = $sqlSend->add_send($a_id, $name);
				if ($res) {
					$this->alert('添加成功', __ROOT__.'/index');
				}else{
					$this->alert('添加失败');
				}
				break;
			case 'del':
				$send_id = $this->in_get('id', None, 1, 'True');
				$res = $sqlSend->del_send($a_id, $send_id);
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
		$sqlSend = new sql_sendMod();

		$a_id = $this->in_cookie('aid', None, 1, 'True');
		$send_id = $this->in_get('id', None, 1, 'True');
		$s_id = $this->in_get('sid', None, 1, 'True');
		$c_id = $this->in_get('cid', None, 1, 'True');
		$addrs = $this->in_get('addrs', None, 2, 'True');

		$update_res = $sqlSend->set_send_info($a_id, $send_id, $s_id, $c_id, $addrs);

		if ($update_res) {
			echo('更新成功');
		}else{
			echo('更新失败');
		}
	}
	

	///////////////////////////////////////////////////////////// 以上这些全开放给经销商自己管理 


}

?>