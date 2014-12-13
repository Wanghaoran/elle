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
            die('<h1>Authorization failure1!' .  $result_arr['errmsg'] . '</h1>');
        }

        //获取信息
        $info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $result_arr['access_token'] . '&openid=' . $result_arr['openid'] . '&lang=zh_CN';

        $result_json = file_get_contents($info_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure2!' .  $result_arr['errmsg'] . '</h1>');
        }

        //查询是否有此用户纪录，没有的话数据库新建
        $this -> load -> model('user_model');
        if($query_result = $this -> user_model -> queryhave($result_arr['openid'])){
            //将ID写入session
            $this->session->set_userdata('elle_wechat_id', $query_result[0]['id']);
        }else{
            //创建用户资料
            if(!$insert_id = $this -> user_model -> insertuser($result_arr['openid'], $result_arr['nickname'], $result_arr['sex'], $result_arr['language'], $result_arr['city'], $result_arr['province'], $result_arr['country'], $result_arr['headimgurl'])){
                die('<h1>Authorization failure3! Insert User Error</h1>');
            }else{
                //将ID写入session
                $this->session->set_userdata('elle_wechat_id', $insert_id);
            }
        }

        //加载首页
        $this->load->view('index');
    }

    public function gift(){

        $data = array();

        $this -> load -> model('user_model');
        $this->load->helper('url');

        //elle_wechat_id通不过验证则返回首页
        if(!$this->session->userdata('elle_wechat_id') || !$this -> user_model -> queryhave2($this->session->userdata('elle_wechat_id'))){
            redirect('http://elle.cnhtk.cn');
        }

        //非移动设备跳转至首页
        $this->load->library('user_agent');
        if(!$this->agent->is_mobile()){
            redirect('http://elle.cnhtk.cn');
        }

        $this -> load -> model('detail_model');

        //验证今天是否还能刮
        if($this -> detail_model -> checknum($this->session->userdata('elle_wechat_id'))){
            //奖池
            $gift_arr = array(1,2,3,4,5,6);
            //随机生成奖品
            $data['gift_num'] = $gift_arr[array_rand($gift_arr)];

            //增加今天的刮奖次数
            $this -> detail_model -> insertdata($this->session->userdata('elle_wechat_id'));

        }else{
            $data['gift_num'] = 0;

        }


        $this->load->view('gift', $data);
    }

    //朋友点击
    public function friend(){
        //获取UID
        $uid = $this->input->get('uid');

        //授权跳转
        $this->load->helper('url');
        if(empty($_GET['code'])){
            $token_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxa06d1604e750da71&redirect_uri=' . urlencode('http://elle.cnhtk.cn/friend') . '&response_type=code&scope=snsapi_userinfo&state=' . $uid . '#wechat_redirect';
            redirect($token_url);
        }

        //获取UID

        $state_uid = $_GET['state'];

        //拉取token
        $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxa06d1604e750da71&secret=9a1454d6c2503d961e976fc12c1e8dd8&code=' . $_GET['code'] . '&grant_type=authorization_code';
        $result_json = file_get_contents($token_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure1!' .  $result_arr['errmsg'] . '</h1>');
        }

        //获取信息
        $info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $result_arr['access_token'] . '&openid=' . $result_arr['openid'] . '&lang=zh_CN';

        $result_json = file_get_contents($info_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure2!' .  $result_arr['errmsg'] . '</h1>');
        }


        //查询是否有此用户纪录，没有的话数据库新建
        $this -> load -> model('user_model');
        if($query_result = $this -> user_model -> queryhave($result_arr['openid'])){
            //将ID写入session
            $this->session->set_userdata('elle_wechat_id', $query_result[0]['id']);
            $fuid = $query_result[0]['id'];
        }else{
            //创建用户资料
            if(!$insert_id = $this -> user_model -> insertuser($result_arr['openid'], $result_arr['nickname'], $result_arr['sex'], $result_arr['language'], $result_arr['city'], $result_arr['province'], $result_arr['country'], $result_arr['headimgurl'])){
                die('<h1>Authorization failure3! Insert User Error</h1>');
            }else{
                //将ID写入session
                $this->session->set_userdata('elle_wechat_id', $insert_id);
                $fuid = $insert_id;
            }
        }

        //将朋友点击记录到数据库中
        $this -> load -> model('friend_model');
        $this -> friend_model -> insertdata($fuid, $state_uid, date('Y-m-d'));

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