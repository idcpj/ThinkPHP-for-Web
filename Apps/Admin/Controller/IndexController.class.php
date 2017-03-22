<?php
	namespace Admin\Controller;
	use Think\Controller;

	class IndexController extends Controller
	{
		public function index()
		{
			if(session('adminUser')){
				$this->display();
			}else{
				$this->redirect(U('Login/index'));
			}
		}




	}