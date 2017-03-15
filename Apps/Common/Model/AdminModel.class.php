<?php
	namespace Common\Model;
	use Think\Model;

	class AdminModel extends Model
	{
		private $_db = '';

		/*
		 * 对数据admin模型进行实例化
		 * */
		public function __construct()
		{
			/*不需要加表前缀*/
			$this->_db = M ('admin');
		}

		public function getAdminByUsername($username)
		{
			//username='username'
			$data= $this->_db->where('username="'.$username.'"')->find();
			return $data;
		}
	}