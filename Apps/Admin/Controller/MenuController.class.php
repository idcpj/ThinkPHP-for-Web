<?php
	namespace Admin\Controller;
	use Common\Model\MenuModel;
	use Think\Exception;
	use Think\Page;

	class MenuController extends CommonController
	{
		public function index()
		{
			$data = array();
			if(isset($_GET['type']) && in_array_case($_GET['type'], [0, 1])){
				$data['type'] = intval($_GET['type']);
				$this->assign('type', $data['type']);
			}
			else{
				$this->assign('type', -1);
			}
			/**
			 * 分页数据
			 */
			$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
			$pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
			$menu = D('Menu');
			$menus = $menu->getMenus($data, $page, $pageSize);
			$count = $menu->getMenusCount();
			$res = new Page($count, $pageSize);
			$pageRes = $res->show();
			$this->assign('pageRes', $pageRes);
			$this->assign('menus', $menus);
			$this->display();

		}

		/**
		 * 添加菜单
		 */
		public function add()
		{
			if($_POST){
				if( ! isset($_POST['name']) || ! $_POST['name']){
					return show(0, '菜单名不能为空');
				}
				elseif( ! isset($_POST['m']) || ! $_POST['m']){
					return show(0, '模块名不能为空');
				}
				elseif( ! isset($_POST['c']) || ! $_POST['c']){
					return show(0, '控制器名不能为空');
				}
				elseif( ! isset($_POST['f']) || ! $_POST['f']){
					return show(0, '方法名不能为空');
				}
				if($_POST['menu_id']){
					return $this->update($_POST);
				}
				$menuId = D('Menu')->insert($_POST);
				if($menuId){
					return show(1, "插入成功", $menuId);
				}

				return show(0, "插入失败", $menuId);
			}
			else{
				$this->display();
			}
		}

		/**
		 * 编辑
		 */
		public function edit()
		{
			$id = intval($_GET['id']);
			$menu = D('Menu')->getMenusById($id);
			$this->assign('menu', $menu);
			$this->display();
		}

		/**
		 * 删除菜单
		 * @return string|void
		 */
		public function del()
		{
			$id = $_POST['id'];
			$status = $_POST['status'];
			$res = D('Menu')->delMenusById($id, $status);
			if($res){
				return show(1, "删除成功");
			}
			else{
				return show(0, "删除失败");
			}

		}

		/**
		 * 更新菜单
		 */
		public function update()
		{

			$data['url']= $_SERVER['HTTP_REFERER'];
			$res = D('Menu')->updateMenus($_POST);
			if($res){
				return show(1, "更新成功",$data);
			}

			return show(0, '更新失败,数据不合法,或数据未改变');
		}

		/**
		 * 更新排序
		 */
		public function listorder()
		{
			$listorder = $_POST['listorder'];
			$jumpUrl = $_SERVER['HTTP_REFERER'];
			$errors = array();
			if($listorder){
				try{
					foreach($listorder as $menuId => $value){
						$res = D('Menu')->listOderById($menuId, $value);
						if($res == false){
							$errors[] = $menuId;
						}
					}
				} catch(Exception $e){
					return show(0, $e->getMessage());
				}
			}
			if( count($errors)<10){
				return show(1, "排序成功", ['jumpUrl' => $jumpUrl]);
			}
			else{
				return show(0, "排序失败排序值没有任何变化" , ['jumpUrl' => $jumpUrl]);
			}

		}


	}
