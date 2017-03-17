<?php
	namespace Admin\Controller;
	use Think\Controller;

	class MenuController extends CommonController
	{
		public function index()
		{
			$this->display();
		}

		public function add()
		{
			if($_POST){
				if( ! isset($_POST['name']) || ! $_POST['name']){
					return show(0, '菜单名不能为空');
				}
				elseif( ! isset($_POST['type']) || ! $_POST['type']){
					return show(0, '字段名不能为空');
				}
				elseif( ! isset($_POST['模块名']) || ! $_POST['模块名']){
					return show(0, '字段名不能为空');
				}
				elseif( ! isset($_POST['c']) || ! $_POST['c']){
					return show(0, '控制器名不能为空');
				}
				elseif( ! isset($_POST['f']) || ! $_POST['f']){
					return show(0, '方法名不能为空');
				}
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