<?php 

namespace Modules;

use Modules\MySQLi;

class OrganizerSp{

	public $db;

	public function __construct(){
		$this->db = MySQLi::getInstance()->getConnect();
	}

	public function getName(){
		$res=$this->db->query("SELECT * 
			FROM  `shop_cur` WHERE `cur_id`=1 ");
		$row=$res->fetch_assoc();
		return $row["cur_show"];
	}

	// public function 
}