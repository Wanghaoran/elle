<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
        //授权跳转
        $this->load->helper('url');
        if(empty($_GET['code'])){
            $token_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxa06d1604e750da71&redirect_uri=' . urlencode('http://elle.cnhtk.cn/') . '&response_type=code&scope=snsapi_userinfo&state=index#wechat_redirect';
            redirect($token_url);
        }

        //拉取token
        $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxa06d1604e750da71&secret=9a1454d6c2503d961e976fc12c1e8dd8&code=' . $_GET['code'] . '&grant_type=authorization_code';
        $result_json = file_get_contents($token_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('Authorization failure!' .  $result_arr['errmsg'] . '</h1>');
        }

        //获取信息
        $info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $result_arr['access_token'] . '&openid=' . $result_arr['openid'] . '&lang=zh_CN';

        $result_json = file_get_contents($info_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('Authorization failure!' .  $result_arr['errmsg'] . '</h1>');
        }

        echo '<pre>';
        var_dump($result_arr);
        echo '</pre>';
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */