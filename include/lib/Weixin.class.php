<?php
class Weixin
{
	private $wx_appID;
	private $wx_appsecret;

	function __construct($wx_appID , $wx_appsecret)
	{
		$this->wx_appID = $wx_appID;
		$this->wx_appsecret = $wx_appsecret;
	}

	public function vali_weixin_user($code){
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->wx_appID.'&secret='.$this->wx_appsecret.'&code='.$code.'&grant_type=authorization_code';
		$data = $this->https_request($url);
		$data = json_decode($data);
		if (isset($data['openid'])) {
			return $data['openid'];
		}else{
			return '';
		}
	}

	public function produce_code_link($url){
		$ex_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->wx_appID.'&redirect_uri=';
		$pr_url = '&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
		return $ex_url.$url,$pr_url;
	}

	public function https_request($url, $data = null){
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