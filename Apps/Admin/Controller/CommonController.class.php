<?php
	namespace Admin\Controller;
	use Think\Controller;

	/**每个页面都要保证在登录状态,
	 * Class CommonController
	 * @package Admin\Controller
	 */
	class CommonController extends Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->_init();

		}

		/**
		 * 未登录则跳转
		 */
		private function _init(){
			$isLogin = $this->isLogin();
			if(!$isLogin){
				$this->redirect('/admin.php?c=login');
			}
		}

		/**
		 * 获取登录用户信息
		 */
		public function getLoginUser(){
			return session('adminUser');
		}

		/**判断是否登录
		 */
		public function isLogin(){
			$user = $this->getLoginUser();
			if($user &&is_array($user)){
				return true;
			}
			return false;
		}


	}