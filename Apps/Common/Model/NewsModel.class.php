<?php
	namespace Common\Model;
	use Think\Model;

	class NewsModel extends Model
	{
		private $_db='';

		public function __construct()
		{
			$this->_db=M('News');
		}

		public function insert($data){
			$res= $this->_db->add($data);
			if($res ===false){
				return false;
			}else{
				return $res;
			}
		}
	}
