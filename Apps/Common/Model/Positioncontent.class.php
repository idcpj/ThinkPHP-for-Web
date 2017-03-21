<?php
	namespace Common\Model;

	use Think\Model;

	class PositioncontentModel extends Model{
		private $_db='';

		public function __construct()
		{
			$this->_db=M('Position_content');
		}

		public function insert($data){
			$res = $this->_db->add($data);
			if($res){
				return $res;
			}else{
				return false;
			}
		}

	}

