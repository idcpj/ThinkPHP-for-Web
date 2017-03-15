<?php
	namespace Admin\Controller;
	use Think\Controller;

	/**
	 * Class 登录类
	 * @package Admin\Controller
	 */
	class LoginController extends Controller
	{
		public function index()
		{
			return $this->display('personal');
		}

		public function check()
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			if( ! trim($username)){
				return show(0, "账户不能为空");
			}
			if( ! trim($password)){
				return show(0, "密码不能为空");
			}
			$ret = D('Admin')->getAdminByUsername($username);
			if(!$ret){
				return show(0,$username."用户不存在");
			}
			if(getMd5Password($password) != $ret['password']){
				return show(0, "密码错误");
			}
			session('adminUser',$ret);
			return show(1,"登录成功");
		}
	}