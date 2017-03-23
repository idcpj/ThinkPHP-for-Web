<?php
	namespace Admin\Controller;

	use Think\Model;

	class AdminController extends CommonController
	{
		public function index()
		{
			$admins = D('Admin')->getAll();
			$this->assign('admins',$admins);
			$this->display();
		}

		//添加
		public function add(){
			if($_POST){
				if(!$_POST['username']){
					return show(0,"用户名不能为空");
				}
				if(!$_POST['password']){
					return show(0,"密码不能为空");
				}
				if(!$_POST['username']){
					return show(0,"真实姓名不能为空");
				}
				$res = D('Admin')->insert($_POST);
				if(!$res){
					return show(0,"添加失败");
				}else{
					return show(1, '添加成功');
				}
			}else{
				$this->display();

			}
		}

		//删除
		public function del(){
			$data['url']='/admin.php?c=admin';
			if(!$_POST['id'] || $_POST['status']!=-1){
				return show(0, '删除失败,id不合法',$data);
			}
			$res = D('Admin')->del($_POST);
			if($res){
				return show(1, '删除成功',$data);
			}else{
				return show(0, '删除失败',$data);
			}
		}

		//个人中心
		public function personal(){
			$admin=session('adminUser');
			if($admin){
				$adminInfo = M('Admin')->find($admin['admin_id']);
				$this->assign('vo',$adminInfo);
			}
			$this->display();
		}

		//更 新信息
		public function save(){
			if(!$_POST['admin_id']){
				return show(0, "没有更新信息");
			}
			$res = D('Admin')->update($_POST);
			if(!$res){
				return show(0, '更新失败,请至少改变一个值');
			}
			return show(1, '更新成功');
		}
	}