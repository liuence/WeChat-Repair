<?php


define("APPID", "wx0bb1e5f3113fdeb3");
define("APPSECRET", "8b73f13bf044d99b65b62bfddde77a15");

class class_weixin
{
    var $appid = APPID;
    var $appsecret = APPSECRET;

    //构造函数，获取Access Token
    public function __construct($appid = NULL, $appsecret = NULL)
    {
        if($appid && $appsecret){
            $this->appid = $appid;
            $this->appsecret = $appsecret;
        }
        if (empty($this->access_token)){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
            $res = $this->http_request($url);
            $result = json_decode($res, true);
            $this->access_token = $result["access_token"];           
        }
    }

	public function send($data){
	$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$this->access_token;
	$res=$this->http_request($url, $data);
	return json_decode($res,true);		
	}
	
    //HTTP请求（支持HTTP/HTTPS，支持GET/POST）
    protected function http_request($url, $data = null)
    {
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