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


}
