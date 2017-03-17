<?php
	namespace Common\Model;
	class MenuModel extends \Think\Model
	{
		private $_db = '';

		public function __construct()
		{
			$this->_db = M('menu');
		}

		public function insert($data = array())
		{
			if( ! $data || is_array($data)){
				return 0;
			}
			else{
				$this->_db->add();
			}
 		}

	}
