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
			$list = $this->_db->where($data)->order('listorder,menu_id ')->limit($offset, $pageSize)->select();

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


		/**
		 * 删除菜单通过id
		 * @param $id
		 *
		 * @return bool
		 */
		public function delMenusById($id,$status){
			if(!is_numeric($id) || !$id){
				return  show(0,"删除失败id值非法");
			}
			if(!is_numeric($status) || !$status){
				return  show(0,"删除失败status值非法");
			}
			$this->_db->status=$status;
			$res = $this->_db->where('menu_id='.$id)->save();
			return $res;

		}

		/**
		 * 通过id获取
		 * @param $id
		 *
		 * @return mixed
		 */
		public function getMenusById($id){
			return $this->_db->where('menu_id='.$id)->find();
		}

		/**
		 * 更新菜单
		 * @param $data
		 *
		 * @return bool
		 */
		public function updateMenus($data){
			$id = intval($data['menu_id']);
			unset($data['menu_id']);
			return $this->_db->where('menu_id='.$id)->setField($data);

		}

		/**
		 * 排序
		 * @param $id
		 * @param $value
		 *
		 * @return bool
		 */
		public function listOderById($id,$value){
			if(!is_numeric($id)){
				throw_exception("id非法");
			}
			$data =array(
				'listorder'=>intval($value)
			);
			return M('Menu')->where('menu_id='.$id)->save($data);

		}

		/**
		 * 后台菜单
		 */
		public function getAdminMenus(){
			$data = array(
				'status'=>array('neq',-1),
			    'type'=>1
			);

			return  $this->_db->where($data)->order('listorder,menu_id ')->select();

		}

	}