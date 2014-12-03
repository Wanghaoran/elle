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
            die('<h1>Authorization failure!' .  $result_arr['errmsg'] . '</h1>');
        }

        //获取信息
        $info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $result_arr['access_token'] . '&openid=' . $result_arr['openid'] . '&lang=zh_CN';

        $result_json = file_get_contents($info_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure!' .  $result_arr['errmsg'] . '</h1>');
        }

        //查询是否有此用户纪录，没有的话数据库新建
        $this->load->helper('cookie');
        $this -> load -> model('user_model');
        if($this -> user_model -> queryhave($result_arr['openid'])){
            //将OPENID写入session
            $this->session->set_userdata('elle_wechat_openid', $result_arr['openid']);
        }else{
            //创建用户资料
            if(!$this -> user_model -> insertuser($result_arr['openid'], $result_arr['nickname'], $result_arr['sex'], $result_arr['language'], $result_arr['city'], $result_arr['province'], $result_arr['country'], $result_arr['headimgurl'])){
                die('<h1>Authorization failure! Insert User Error</h1>');
            }else{
                //将OPENID写入session
                $this->session->set_userdata('elle_wechat_openid', $result_arr['openid']);
            }
        }

        //加载首页
        $this->load->view('index');
    }

    public function testtttt(){
        //加载首页
        $this->load->view('index');
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */