<?php
	namespace Common\Model;
	class MenuModel extends \Think\Model
	{
		private $_db = '';

		public function __construct()
		{
			$this->_db = M('Menu');
		}

		/**
		 * 插入数据
		 *
		 * @param array $data
		 *
		 * @return int
		 */
		public function insert($data = array())
		{
			if($data || is_array($data)){
				return $this->_db->add($data);
			}
			else{
				return 0;
			}
		}

		/**
		 * 获取分页的数据
		 *
		 * @param     $data
		 * @param     $page
		 * @param int $pageSize
		 *
		 * @return mixed
		 */
		public function getMenus($data, $page, $pageSize = 10)
		{
			//删除状态为-1
			$data['status'] = array('neq', '-1');
			$offset = ($page - 1) * $pageSize;
			$list = $this->_db->where($data)->order('menu_id')->limit($offset, $pageSize)->select();

			return $list;
		}

		/**
		 * 获取分页总数
		 * @param $data
		 *
		 * @return mixed
		 */
		public function getMenusCount($data)
		{
			$data['status'] = array('neq', '-1');
			$count = $this->_db->where($data)->count();

			return $count;
		}


	}