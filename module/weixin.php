<?php
/**
*  微信 api
*/
class Weixin
{	
	/**
	* 向微信申请永久/临时 二维码
	* @param id  二维码 id
	* @param type  二维码类型，1 为临时二维码，2为永久
	*/
	static function apply_qrcode($token, $type = 1, $id = 1){
		$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token;
		if ($type == 1) {
			$postData = '{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": '.$id.'}}}';
		}else{
			$postData = '{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "'.$id.'"}}}';
		}
		$data = self::https_request($url, $postData);
		$data = json_decode($data, True);
		if (isset($data['ticket'])) {
			return $data['ticket'];
		}else{
			return False;
		}
	}

	// 获取基础　token
	static function get_base_token(){
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.AppID.'&secret='.AppSecret;
		$data = self::https_request($url);
		$data = json_decode($data, True);
		if (isset($data['access_token'])) {
			return $data;
		}else{
			return False;
		}
	}

	// 验证用户是不是微信用户
	static function vali_weixin_user($code){
		$data['openid'] = 'opF2vsy01Q2OCBVZ-O4TBLBSz4Pw';
		return $data;
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.AppID.'&secret='.AppSecret.'&code='.$code.'&grant_type=authorization_code';
		$data = self::https_request($url);
		$data = json_decode($data, True);
		// dump($data);
		if (isset($data['openid'])) {
			return $data;
		}else{
			return False;
		}
	}

	// 生成带 code  的链接
	static function produce_code_link($url){
		$ex_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.AppID.'&redirect_uri=';
		$pr_url = '&response_type=code&scope=snsapi_base&state=#wechat_redirect';
		return $ex_url.$url.$pr_url;
	}

	// 获取用户信息， 此access_token为基础支持的access_token，需要读取后台来获取 token 数据
	static function get_user_info($access_token, $openid){
		$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
		$data = self::https_request($url);
		$data = json_decode($data, True);
		// dump($data);
		if (isset($data['openid'])) {
			return $data;
		}else{
			return False;
		}
	}

	// 获取用户信息， 此access_token与基础支持的access_token不同 
	static function get_user_info_web($access_token, $openid){
		$url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
		$data = self::https_request($url);
		$data = json_decode($data, True);
		// dump($data);
		if (isset($data['openid'])) {
			return $data;
		}else{
			return False;
		}
	}


	private function https_request($url, $data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
		    curl_setopt($curl, CURLOPT_POST, 1);
		    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
}

?>