<?php
	namespace Admin\Controller;
	use Common\Model\MenuModel;
	use Think\Page;

	class MenuController extends CommonController
	{
		public function index()
		{

			$data = array();
			/**
			 * 分页数据
			 */
			$page = $_REQUEST['p']?$_REQUEST['p']:1;
			$pageSize = $_REQUEST['pageSize']?$_REQUEST['pageSize']:10;

			$menu = new MenuModel();
			$menus = $menu->getMenus($data,$page,$pageSize);
			$count = $menu->getMenusCount();

			$res = new Page($count,$pageSize);
			$pageRes = $res->show();
			$this->assign('pageRes',$pageRes);
			$this->assign('menus',$menus);

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
				//应为D('Menu')方法用不了,只能靠这个代替
				$menuId = (new MenuModel())->insert($_POST);
				if($menuId){
					return show(1, "插入成功", $menuId);
				}

				return show(0, "插入失败", $menuId);
			}
			else{
				$this->display();
			}
		}


		public function edit()
		{
			$this->display();
		}

	}