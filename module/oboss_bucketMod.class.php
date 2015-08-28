<?php
require_once('./module/sql_bucketMod.class.php');

class oboss_bucketMod extends commonMod{
	public function index(){
		$sqlBucket = new sql_bucketMod();

		$a_id = $this->in_cookie('aid', None, 1, 'True');
		$school = $this->in_get('sc', 0, 1);
		$cid = $this->in_get('cid', 0, 1);
		$addr = $this->in_get('addr', 0, 1);

		$url = preg_replace("/&p=\d+/", '', $_SERVER['REQUEST_URI']);
		$url .= '&p={page}';
		$url = str_replace('oboss_bucket&p', 'oboss_bucket?p', $url);
		
		$res = $sqlBucket->get_bucket($a_id, $url, $school, $cid, $addr);

		$this->assign('o_info', $res['info']);
		$this->assign('page', $res['page']);
		$this->display('bucket_boss');
	}

	public function export(){
		$sqlBucket = new sql_bucketMod();

		$a_id = $this->in_cookie('aid', None, 1, 'True');
		$school = $this->in_get('sc', 0, 1);
		$cid = $this->in_get('cid', 0, 1);
		$mark = $this->in_get('mark', 0, 1);
		$addr = $this->in_get('addr', 0, 1);

		$res = $sqlBucket->export_bucket($mark, $a_id, $school, $cid, $addr);
		
		if ($res == 'error') {
			$this->alert('有宿舍正在进行空桶回收，请完成后再执行新一轮回收工作以免带来不必要的麻烦');
		}else if ($res) {
			header("Content-Type: application/$file_type;charset=gbk");
			header("Content-Disposition: attachment; filename=1.xls");
			header("Pragma: no-cache");
			$title = "最近订水时间\t学校\t宿舍号\t剩余空桶数量\n";
			echo("$title");

			foreach ($res as $key => $value) {
				echo $value['update_time']. "\t".$value['s_name']. "\t".$value['addr']. "\t".$value['wait_recyle']. "\n";
			}
		}else{
			$this->alert('没有找到相关数据');
		}
	}
	
	// 将空桶标记为 已回收
	public function mark(){
		$sqlBucket = new sql_bucketMod();

		$a_id = $this->in_cookie('aid', None, 1, 'True');
		$school = $this->in_get('sc', 0, 1);
		$cid = $this->in_get('cid', 0, 1);
		$mark = $this->in_get('mark', 0, 1);
		$addr = $this->in_get('addr', 0, 1);

		$res = $sqlBucket->mark_bucket($a_id, $school, $cid, $addr);
		if ($res) {
			$this->alert('更新成功');
		}else{
			$this->alert('服务器出了点小问题');
		}
	}

	// 更新某个宿舍的空桶剩余数量
	public function change(){
		$sqlBucket = new sql_bucketMod();

		$a_id = $this->in_cookie('aid', None, 1, 'True');
		$school = $this->in_get('sc', 0, 1, 'True');
		$num = $this->in_get('num', 0, 1, 'True');
		$id = $this->in_get('id', 0, 1, 'True');

		$res = $sqlBucket->change_bucket($a_id, $school, $id, $num);
		if ($res) {
			echo 1;
		}else{
			echo 0;
		}
	}
}

?>