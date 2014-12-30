<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gift_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> database();
    }

    //获得特定奖品数量
    public function getgiftnum($gift){
        $this -> db -> where('gift', $gift);
        $now = $this->db->count_all_results('gift');
        return $now;
    }

    //记录中奖信息
    public function writegift($gift, $uid){
        $data = array(
            'uid' => $uid,
            'gift' => $gift,
            'time' => date('Y-m-d H:i:s'),
        );

        $this -> db -> insert('gift', $data);

        return $this->db->insert_id();
    }

    //查询特定用户特定奖品是否中出
    public function getusergiftnum($uid, $gift){
        $query = $this -> db -> get_where('gift', array('uid' => $uid, 'gift' => $gift), 1);
        return $query -> result_array();
    }

    //获取中奖用户信息
    public function getallgiftuser(){
        $this->db->select('elle_gift.id as id,elle_gift.gift as gift, elle_gift.time as time,elle_user.nickname as nickname,elle_user.sex as sex,elle_user.language as language,elle_user.city as city,elle_user.province as province,elle_user.country as country,elle_user.headimgurl as headimgurl');
        $this->db->from('elle_gift');
        $this->db->join('elle_user', 'elle_gift.uid = elle_user.id');
        $this->db->order_by('time', 'asc');
        $query = $this->db->get();
        return $query -> result_array();
    }


}
